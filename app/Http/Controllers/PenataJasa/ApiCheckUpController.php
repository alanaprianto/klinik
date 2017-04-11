<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\Patient;
use App\Poly;
use App\Reference;
use App\Service;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;

class ApiCheckUpController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            if ($reference) {
                foreach ($reference->medicalRecords->where('type', Auth::user()->roles()->first()->name) as $medicalRecord) {
                    $total_payment += $medicalRecord->quantity * $medicalRecord->cost;
                }
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosk' => $kiosk, 'reference' => $reference, 'services' => $this->getServices(), 'polies' => $this->getPolies(), 'icd10s' => $this->getIcd10s()]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }


    public function selectService(Request $request){
        $response = [];
        try{
            $service = Service::find($request['service_id']);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['service' => $service]];
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
