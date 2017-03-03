<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\MedicalRecord;
use App\Poly;
use App\Reference;
use App\Service;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $total_payment = 0;
        foreach ($reference->medicalRecords as $medicalRecord) {
            $total_payment += $medicalRecord->quantity * $medicalRecord->cost;
        }
        return view('checkUp.create', compact(['reference', 'services', 'total_payment', 'polies']));
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

    public function postCreate(Request $request)
    {
        $input = $request->except('_token');
        /*remove*/
        if ($input['remove_ids']) {
            $ids = explode(',', $input['remove_ids']);
            $mr_remove = DB::table('medical_records')->whereIn('id', $ids)->delete();
        }

        $reference = Reference::with(['register', 'register.patient'])->find($input['reference_id']);
        $reference->update([
            'staff_id' => $input['doctor']
        ]);

        $services = Service::get();
        $medical_record = MedicalRecord::get();

        /*kalau di rujuk tanpa chek kesini*/
        if(($input['service'] ==  array(null)) && $input['condition'] == 'Dirujuk' && isset($input['poly'])){
            /*add reference dan antrian kiosk*/
            $input['doctor'] = null;
            $reference = $this->addReference($input, $reference->register, 'create');
            $poly = Poly::find($input['poly']);
            $this->getKioskQueue($poly->name, $reference->id);

            $reference->update([
                'status' => 2,
                'notes'=> 'Dirujuk ke '.$poly->name
            ]);

        }else{
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
                                'is_checked' => true,
                                'final_result' => $input['final_result']
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
                            'total_sum' => $total_bill
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('status', 'Berhasil / Success');
    }
}
