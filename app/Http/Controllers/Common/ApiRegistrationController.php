<?php

namespace App\Http\Controllers\Common;

use App\Hospital;
use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\Patient;
use App\Poly;
use App\Reference;
use App\Register;
use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ApiRegistrationController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try {
            $registers = Register::with(['patient', 'staff', 'references', 'references.poly', 'references.doctor'])->orderBy('created_at', 'desc')->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['registers' => $registers, 'recordsTotal' => count($registers)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = [];
        try {
            /*update kiosk to status on process*/
            $kiosk_id = $request['kiosk_id'];
            $kiosk = null;
            if ($kiosk_id) {
                $kiosk = Kiosk::find($kiosk_id);
                $kiosk->update([
                    'status' => 3, /*1:open, 2:calling, 3:on process, 4:finished*/
                    'staff_id' => Auth::user()->id
                ]);
            }

            /*get polies*/
            $polies = $this->getPolies();

            /*get staff where staffjob doctor*/
            $doctors = Staff::whereHas('staffJob', function ($q) {
                $q->where('name', 'Dokter');
            })->get();
            $doctors['recordsTotal'] = count($doctors);

            /*get hospital*/
            $hospital = Hospital::first();

            /*get staff role loket who is logged on*/
            $staff = Staff::where('user_id', Auth::user()->id)->first();

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['polies' => $polies, 'doctors' => $doctors, 'hospital' => $hospital, 'kiosk' => $kiosk, 'staff' => $staff]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        try{
            $register = Register::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['register' => $register]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }

        return response()->json($response);
    }

    public function edit($id)
    {
        $response = [];
        try {
            $register = Register::with(['patient', 'references'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['register' => $register]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }


    public function createReference($request)
    {
        $response = [];
        try{
            $input = $request->all();
            Reference::create([
                'number_reference' => Carbon::now()->format('Ymdhis'),
                'register_id' => $request['register_id'],
                'poly_id' => $input['poly_id'],
                'staff_id' => $input['doctor_id'],
                'status' => 1
            ]);

            $register = Register::with(['references', 'patient', 'staff'])->find($request['register_id']);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['register' => $register]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();

            if(isset($input['register_id'])){
                return $this->createReference($request);
            }

            /*update kiosk status to finished*/
            if (isset($input['kiosk_id'])) {
                $kiosk = Kiosk::find($input['kiosk_id']);
                if ($kiosk) {
                    $kiosk->update(['status' => 4]);
                }
            }

            /*add hospoital id to input for create patient*/
            $hospital = Hospital::first();
            $input['hospital_id'] = $hospital->id;

            /*select patient from database or create new*/
            if (isset($input['patient_id'])) {
                $patient = Patient::find($input['patient_id']);
            } else {
                $patient = Patient::create($input);
            }

            /*define user logged*/
            $user = User::with('staff')->find(Auth::user()->id);

            /*add input data for create new register */
            $input['register_number'] = Carbon::now()->format('Ymdhis');
            $input['staff_id'] = $user->staff->id;
            $input['patient_id'] = $patient->id;
            $input['status'] = 1;

            /*create type registration*/
            $register = Register::create($input);

            /*add reference to poly*/
            $reference = $this->addReference($input, $register);

            /*assign payment for doctor / create payment for doctor*/
/*            $doctor = Staff::with('doctorService')->find($input['doctor_id']);
            $register->payments()->create([
                'status' => 1,
                'total' => $doctor->doctorService->cost,
                'type' => 'doctor_service',
            ]);*/

            /*add kiosk queue in poly*/
            $poly = Poly::find($request['poly_id']);
            $kiosk = $this->getKioskQueue($poly->name, $reference->id);
            $full_reference = Reference::with(['register', 'register.patient' ,'poly', 'doctor'])->find($reference->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $full_reference, 'kiosk' => $kiosk]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function selectPatient(Request $request){
        $response = [];
        try{
            $patient = Patient::where('full_name', 'LIKE', '%' . $request['data'] . '%')
                ->orWhere('number_medical_record', 'LIKE', '%' . $request['data'] . '%')->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['patient' => $patient]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }

        return response()->json($response);
    }

}
