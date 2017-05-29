<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Inventory;
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
            $kiosk = Kiosk::find($input['kiosk_id']);

            /*update kiosk*/
            if ($kiosk) {
                $kiosk->update([
                    'status' => 4,
                    'staff_id' => Auth::user()->id
                ]);
            }
            $reference = Reference::with(['register', 'register.patient','payments' ,'doctor', 'doctor.doctorService', 'medicalRecords'])->find($input['reference_id']);

            /*main logic*/
            $doctor = Staff::with(['doctorService'])->find($input['doctor_id']);
            $reference->payments()->create([
                'total' => $doctor->doctorService->cost,
                'type' => 'doctor_service',
                'status' => 0,
                'quantity' => 1,
            ]);

            if($doctor){
                $grand_total_payment = $doctor->doctorService->cost;
            }else{
                $grand_total_payment = $reference->doctor->doctorService->cost;
            }


            foreach ($input['data_service'] as $data){
/*                $data = json_decode($data, true);*/
                $service = Service::find($data['service_id']);
                $total_payments = $service->cost * $data['amount'];
                /*create medical record*/
                $reference->medicalRecords()->create([
                    'type' => 'medical_record_service',
                    'service_id' => $data['service_id'],
                    'quantity' => $data['amount']
                ]);
                /*create payment*/
                $reference->payments()->create([
                    'total' => $total_payments,
                    'type' => 'medical_record_service',
                    'status' => 0,
                    'service_id' => $data['service_id'],
                    'quantity' => $data['amount']
                ]);
                $grand_total_payment += $total_payments;
            }

            foreach ($input['data_medicine'] as $data){
/*                $data = json_decode($data, true);*/
                $inventory = Inventory::find($data['inventory_id']);
                $total_payments = $inventory->purchase_price * $data['amount'];
                $reference->medicalRecords()->create([
                    'type' => 'medical_record_medicine',
                    'inventory_id' => $data['inventory_id'],
                    'quantity' => $data['amount']
                ]);
                /*create payment*/
                $reference->payments()->create([
                    'total' => $total_payments,
                    'type' => 'medical_record_medicine',
                    'status' => 0,
                    'inventory_id' => $data['inventory_id'],
                    'quantity' => $data['amount']
                ]);
                $grand_total_payment += $total_payments;
            }


            $new_reference = '';
            switch ($input['status']){
                case '2':
                    /*selesai di periksa*/
                    break;
                case '3':
                    $new_reference = $this->addReference($input, $reference->register);
                    /*dirujuk*/
                    break;
                case '4':
                    /*dirawat*/
                    break;
                default:
                    /*default 1 => belum di periksa*/
            }

            /*status
            1 = belum diperiksa
            2 = pulang
            3 = dirujuk
            4 = dirawat
            */

            $reference->update([
                'reference_total_payment' => $grand_total_payment,
                'status' => $input['status'],
                'notes' => $input['notes'],
                'payment_status' => 0
            ]);
            $reference->register()->update([
                'payment_status' => 0
            ]);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $reference, 'new_reference' => $new_reference]];
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
            $reference->update([
               'staff_id' => $input['doctor_id']
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
