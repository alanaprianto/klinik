<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Icd10;
use App\Kiosk;
use App\Poly;
use App\Reference;
use App\Service;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;

class ApiCheckUpController extends GeneralController
{
    public function getCreate(Request $request){
        $response = [];
        try{
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
            $reference = Reference::with(['register', 'register.patient', 'poly', 'poly.doctors', 'doctor', 'medicalRecords'])->find($request['reference_id']);
            $total_payment = 0;
            if($reference){
                foreach ($reference->medicalRecords->where('type', Auth::user()->roles()->first()->name) as $medicalRecord) {
                    $total_payment += $medicalRecord->quantity * $medicalRecord->cost;
                }
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosk' => $kiosk,'reference' => $reference, 'services' => $this->getServices(), 'polies' => $this->getPolies(), 'icd10s' => $this->getIcd10s()]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function postCreate(Request $request)
    {
        $response = [];
        try{
            /*remove file anda kiosk queue*/
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

            $input = $request->except('_token');
            $reference = Reference::with(['register', 'register.patient', 'register.payments', 'doctor', 'doctor.doctorService', 'medicalRecords'])->find($input['reference_id']);

            $services = $this->getServices();
            $medical_record = $this->getMedicalRecords();

            /*remove medical record*/
            if ($input['remove_ids']) {
                $ids = explode(',', $input['remove_ids']);
                $mr_remove = DB::table('medical_records')->whereIn('id', $ids)->delete();
            }
            /*-------------------------------*/

            /*update payment doctor if doctor change*/
            $reference->update([
                'staff_id' => $input['doctor_id']
            ]);
            $doctor = Staff::with(['doctorService'])->find($input['doctor_id']);
            $payment_doctor = $reference->register->payments->where('type', 'doctor_service')->first();
            $payment_doctor->update([
                'cost' => $doctor->doctorService->cost
            ]);
            /*-------------------------------*/

            /*main logic*/
            if (($input['service'] == array(null)) && $input['final_result'] == 'Dirujuk' && isset($input['poly'])) {
                /*dirujuk tanpa ada tidakan*/
                $poly = Poly::find($input['poly']);
                /*doktor di null kan*/
                $input['doctor'] = null;
                /*update referensi yang sedang dipakai*/
                $this->updateReference($reference, $input['notes'], false, $input['final_result']);
                /*tambah referensi ketika dirujuk kembali*/
                $this->addReference($input, $reference->register, 'create');
                /*tambah antrian di poly yang di rujuk*/
                $this->getKioskQueue($poly->name, $reference->id);

            } else {
                /*foreach medical record*/
                foreach ($input['service'] as $index => $item) {
                    if ($item) {
                        $service = $services->find($item);
                        $total_bill = $service->cost * $input['quantity'][$index];

                        if ($input['mr_id'][$index]) {
                            /*if id exist update*/
                            $mr = $medical_record->find($input['mr_id'][$index]);
                            if ($mr) {
                                $mr->update([
                                    'patient_id' => $reference->register->patient->id,
                                    'service_id' => $service->id,
                                    'quantity' => $input['quantity'][$index],
                                    'cost' => $service->cost,
                                    'subsidy' => null,
                                    'total_sum' => $total_bill,
                                    'type' => Auth::user()->roles()->first()->name
                                ]);
                            }
                        } else {
                            /*if id doesnt exist create*/
                            $reference->medicalRecords()->create([
                                'patient_id' => $reference->register->patient->id,
                                'service_id' => $service->id,
                                'quantity' => $input['quantity'][$index],
                                'cost' => $service->cost,
                                'subsidy' => null,
                                'total_sum' => $total_bill,
                                'type' => Auth::user()->roles()->first()->name
                            ]);
                        }
                    }
                }

                /*update referensi*/
                if (($input['service'] != array(null))) {
                    $this->updateReference($reference, $input['notes'], true, $input['final_result']);
                } else {
                    $this->updateReference($reference, $input['notes'], false, $input['final_result']);
                }

                /*add reference kalau dirujuk   */
                if ($input['final_result'] == 'Dirujuk') {
                    $poly = Poly::find($input['poly']);
                    /*tambah referensi ketika dirujuk kembali*/
                    $this->addReference($input, $reference->register, 'create');
                    /*tambah antrian di poly yang di rujuk*/
                    $this->getKioskQueue($poly->name, $reference->id);
                }

            }

            $reference_exist = Reference::with(['medicalRecords'])->find($reference->id);
            /*create payment*/
            $total_payment = 0;
            foreach ($reference_exist->medicalRecords->where('type', Auth::user()->roles()->first()->name) as $medicalRecord) {
                $total_payment += $medicalRecord->total_sum;
            }
            $reference_exist->payments()->create([
                'status' => 1,
                'total' => $total_payment,
                'type' => 'medical_record',
                'register_id' => $reference->register->id
            ]);
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }

        return response()->json($response);
    }

    public function selectService(Request $request){
        $response = [];
        try{
            $service = Service::find($request->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['service' => $service]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
