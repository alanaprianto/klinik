<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\MedicalRecord;
use App\Patient;
use App\Reference;
use App\Service;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ApiCheckUpController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try{

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e){
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
            $input = $request->all();
            $kiosk = Kiosk::where('reference_id', $request['reference_id'])->first();
            if ($kiosk) {
                $kiosk->update([
                    'status' => 3,
                    'staff_id' => Auth::user()->id
                ]);

                $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
                if (file_exists($filename)) {
                    File::delete($filename);
                }

            }


            $reference = Reference::with(['register', 'register.patient', 'poly', 'poly.doctors', 'doctor', 'medicalRecords'])->find($input['reference_id']);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosk' => $kiosk, 'reference' => $reference]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $response = [];
        try{
            $input = $request->all();
            $reference = Reference::with(['register', 'register.patient', 'register.payments', 'doctor', 'doctor.doctorService', 'medicalRecords'])->find($input['reference_id']);

            /*if docter change*/
            if($input['doctor_id']){
                $doctor = Staff::with(['doctorService'])->find($input['doctor_id']);
                $doctor_service = $reference->register->payments->where('type', 'doctor_service')->first();
                $doctor_service->update([
                    'cost' => $doctor->doctorService->cost
                ]);
            }

            /*main logic*/
            foreach ($input['service_ids'] as $index_service => $service_id){
                $amount = $input['service_amounts'][$index_service];
                $service = Service::find($service_id);
                $reference->medicalRecords()->create([
                    'type' => 'action',
                    'service_id' => $service_id,
                    'quantity' => $amount
                ]);
                $total_payments = $service->cost * $amount;
                $reference->payments()->create([
                    'total' => $total_payments,
                    'type' => 'action',
                    'status' => 1
                ]);
            }

            /*status
            1 = belum diperiksa
            2 = pulang
            3 = dirujuk
            4 = dirawat*/

            $reference->update([
                'status' => $input['status'],
                'notes' => $input['notes']
            ]);

            switch ($input['status']){
                case '3':
                    /*tambah rujukan*/
                    $this->addReference($input, $reference->register, 'create');
                    break;
                case '4':
                    /*case buat dirawat*/
                    break;
                default:
                    /*default 1*/
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $reference]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);

    }

    public function postDoctor(Request $request){
        try{
            $input = $request->all();
            $reference = Reference::with(['register', 'register.payments'])->find($input['reference_id']);
            $doctor = Staff::with(['doctorService'])->find($input['doctor_id']);
            $payment_doctor = $reference->register->payments->where('type', 'doctor_service')->first();
            $reference->update([
               'staff_id' => $input['doctor_id']
            ]);
            $payment_doctor->update([
                'cost' => $doctor->doctorService->cost
            ]);


            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $reference]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function postMedicalRecord(Request $request){
        $response = [];
        try{
            $input = $request->all();
            $input['type'] = 'medical_record';
            $input['icd10'] = json_encode($input['icd10'], true);
            $reference = Reference::with(['medicalRecords'])->find($input['reference_id']);
            $reference->medicalRecords()->create($input);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $reference]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }

        return response()->json($response);
    }

    public function printLetter(Request $request){
        $response = [];
        try {
            $sum_day = (strtotime($request['until']) - strtotime($request['from'])) / (60 * 60 * 24);
            $patient = Patient::with('hospital')->find($request['patient_id']);
            $now = Carbon::now()->format('d/m/Y');
            $doctor = Staff::where('user_id', Auth::user()->id)->first();

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['sum_day' => $sum_day, 'patient' => $patient, 'now' => $now, 'doctor' => $doctor]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

}
