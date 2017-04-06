<?php

namespace App\Http\Controllers\Loket;

use App\Hospital;
use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\Patient;
use App\Poly;
use App\Register;
use App\Staff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Auth;

class ApiRegistrationController extends GeneralController
{
    public function index()
    {

    }

    public function CreateEdit(Request $request)
    {
        $response = [];
        try {
            $kiosk_id = $request->query('kiosk_id');
            $polies = Poly::get();
            $polies['totalRecord'] = count($polies);
            $doctors = Staff::whereHas('staffJob', function ($q) {
                $q->where('name', 'Dokter');
            })->get();
            $doctors['totalRecord'] = count($doctors);
            $hospital = Hospital::first();

            $kiosk = null;
            if ($kiosk_id) {
                $kiosk = Kiosk::find($kiosk_id);
                $kiosk->update([
                    'status' => 3,
                    'staff_id' => Auth::user()->id
                ]);
                $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
                File::delete($filename);
            }
            $staff_login = Staff::where('user_id', Auth::user()->id)->first();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['polies' => $polies, 'doctors' => $doctors, 'hospital' => $hospital, 'kiosk' => $kiosk, 'staff' => $staff_login]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $response = [];
        try {
            /*create new patient*/
            $input = $request->except('_token');
            if ($input['kiosk_id']) {
                $kiosk = Kiosk::find($input['kiosk_id']);
                $kiosk->update(['status' => 4]);
            }

            $hospital = Hospital::first();
            $input['hospital_id'] = $hospital->id;
            if ($input['patient_number_id']) {
                $patient = Patient::find($input['patient_number_id']);
            } else {
                $patient = Patient::create($input);
            }

            $user =  User::with('staff')->whereHas('tokens', function ($q)use($request){
                $q->where('id', '=' ,$request['token']);
            })->first();

            $input['register_number'] = Carbon::now()->format('Ymdhis');
            $input['staff_id'] = $user->staff->id;
            $input['patient_id'] = $patient->id;
            $input['status'] = 1;

            /*create type registration*/
            $register = Register::create($input);


            /*add reference /  tambah rujukan*/
            $reference = $this->addReference($input, $register, 'create');
            $doctor = Staff::with('doctorService')->find($input['doctor']);
            $register->payments()->create([
                'status' => 1,
                'total' => $doctor->doctorService->cost,
                'type' => 'doctor_service',
            ]);

            /*add kiosk queue*/
            $poly = Poly::find($request['poly']);
            $kiosk = $this->getKioskQueue($poly->name, $reference->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['patient' => $patient, 'reference' => $reference, 'poly' => $poly, 'kiosk' => $kiosk, 'register' => $register, 'doctor' => $doctor]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function test(Request $request){
        return response()->json($request->all());
    }
}
