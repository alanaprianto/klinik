<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Icd10;
use App\Idc10;
use App\Kiosk;
use App\MedicalRecord;
use App\Patient;
use App\Payment;
use App\Poly;
use App\Reference;
use App\Service;
use App\Staff;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use LRedis;

class CheckUpController extends GeneralController
{
    protected $LRedis;

    public function __construct(LRedis $lredis)
    {
        $this->LRedis = $lredis::connection();
    }

    public function getCreate($id)
    {
        $kiosk = Kiosk::where('reference_id', $id)->first();
        if ($kiosk) {
            $kiosk->update([
                'status' => 2,
                'staff_id' => Auth::user()->id
            ]);

            $redis = $this->LRedis;
            $redis->publish('message', $kiosk->type);
            $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            if (file_exists($filename)) {
                File::delete($filename);
            }

        }
        $reference = Reference::with(['register', 'register.patient', 'poly', 'poly.doctors', 'doctor', 'medicalRecords'])->find($id);
        $services = Service::get();
        $polies = Poly::get();
        $icd10s = Icd10::get();
        $total_payment = 0;
        foreach ($reference->medicalRecords->where('type', Auth::user()->roles()->first()->name) as $medicalRecord) {
            $total_payment += $medicalRecord->quantity * $medicalRecord->cost;
        }
        return view('checkUp.create', compact(['reference', 'services', 'total_payment', 'polies', 'id', 'icd10s']));
    }

    public function getService(Request $request)
    {
        $respone = [];
        try {
            $service = Service::find($request->id);
            $respone = ['is_success' => true, 'message' => 'service ada', 'data' => $service];
        } catch (\Exception $e) {
            $respone = ['is_success' => false, 'message' => $e->getMessage(), 'data' => null];
        }
        return collect($respone);
    }

    private function updateReference($reference, $note, $is_checked, $final_result)
    {
        switch ($final_result) {
            case 'Dirujuk':
                $status = 2;
                break;
            case 'Dirawat':
                $status = 3;
                break;
            case 'Selesai Diperiksa':
                $status = 4;
                break;
            default :
                $status = 4;
        }
        $reference->update([
            'status' => $status,
            'notes' => $note,
            'is_checked' => $is_checked,
            'final_result' => $final_result,
        ]);
    }

    public function postCreate(Request $request)
    {
        /*remove file anda kiosk queue*/
        $kiosk = Kiosk::where('reference_id', $request['kiosk_id'])->first();
        if ($kiosk) {
            $kiosk->update([
                'status' => 3,
                'staff_id' => Auth::user()->id
            ]);

            $redis = $this->LRedis;
            $redis->publish('message', $kiosk->type);
            $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            if (file_exists($filename)) {
                File::delete($filename);
            }

        }

        $input = $request->except('_token');
        $reference = Reference::with(['register', 'register.patient', 'register.payments', 'doctor', 'doctor.doctorService', 'medicalRecords'])->find($input['reference_id']);
        $services = Service::get();
        $medical_record = MedicalRecord::get();

        /*remove medical record*/
        if ($input['remove_ids']) {
            $ids = explode(',', $input['remove_ids']);
            $mr_remove = DB::table('medical_records')->whereIn('id', $ids)->delete();
        }
        /*-------------------------------*/

        /*update payment doctor if doctor change*/
        $reference->update([
            'staff_id' => $input['doctor']
        ]);
        $doctor = Staff::with(['doctorService'])->find($input['doctor']);
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

        return redirect('/penata-jasa/antrian')->with('status', 'Berhasil / Success');
    }

    public function postAjax(Request $request){
        $message = [];
        try{
            $input = $request->except('_token');
            $input['type'] = 'medical_record';
            $input['icd10'] = json_encode($input['icd10'], true);
            $reference = Reference::find($input['reference_id']);
            $reference->medicalRecords()->create($input);
            $message = ['isSuccess' => true, 'message' => 'Berhasil Menambah medical record'];
        } catch (Exception $e){
            $message = ['isSuccess' => false, 'message' => $e->getMessage()];
        }

        return $message;
    }

    public function printLetter(Request $request){
        $query = $request->query();
        $sum_day = (strtotime($query['until']) - strtotime($query['from'])) / (60 * 60 * 24);
        $patient = Patient::with('hospital')->find($query['patient_id']);
        $now = Carbon::now()->format('d/m/Y');
        $doctor = Staff::where('user_id', Auth::user()->id)->first();
        return view('checkUp.print', compact('query', 'patient', 'now', 'sum_day', 'doctor'));
    }
}
