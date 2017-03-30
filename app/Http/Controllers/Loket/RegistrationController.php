<?php

namespace App\Http\Controllers\loket;

use App\Hospital;
use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\Patient;
use App\Poly;
use App\Register;
use App\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LRedis;
use File;
use Yajra\Datatables\Facades\Datatables;


class RegistrationController extends GeneralController
{
    protected $LRedis;

    public function __construct(LRedis $lredis)
    {
        $this->LRedis = $lredis::connection();
    }

    public function index()
    {
        return view('registration.index');
    }

    public function getCreateEdit(Request $request)
    {
        $kiosk_id = $request->query('id');
        $polies = Poly::get();
        $doctors = Staff::whereHas('staffJob', function ($q) {
            $q->where('name', 'Dokter');
        })->get();

        if ($kiosk_id) {
            $kiosk = Kiosk::find($kiosk_id);
            $kiosk->update([
                'status' => 3,
                'staff_id' => Auth::user()->id
            ]);

/*            $redis = $this->LRedis;
            $redis->publish('message', $kiosk->type);*/
            $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            File::delete($filename);
        }
        return view('registration.createEdit', compact(['polies', 'doctors', 'kiosk_id']));
    }

    public function store(Request $request)
    {
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

        $input['register_number'] = Carbon::now()->format('Ymdhis');
        $input['staff_id'] = Auth::user()->id;
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
        $this->getKioskQueue($poly->name, $reference->id);

/*        $redis = $this->LRedis;
        $redis->publish('message', 'registration');

        $redis = $this->LRedis;
        $redis->publish('message', 'polies');*/

        return redirect('/loket/pendaftaran')->with('status', 'Berhasil menambkan / mengubah data pasien');
    }

    public function getList()
    {
        $user = Auth::user();
        $registers = Register::with(['patient', 'staff'])->get();
        $datatable = Datatables::of($registers);

        return $datatable->make(true);
    }

    public function getReference($id)
    {
        $polies = Poly::get();
        $doctors = Staff::whereHas('staffJob', function ($q) {
            $q->where('name', 'Dokter');
        })->get();
        $register = Register::with(['patient', 'references', 'references.poly', 'references.doctor'])->find($id);
        return view('registration.addReference', compact(['register', 'polies', 'doctors']));
    }

    public function postReference(Request $request)
    {
        $input = $request->except('_token');
        $reference = $this->addReference($input, '', 'add');
        $poly = Poly::find($input['poly']);
        $this->getKioskQueue($poly->name, $reference->id);
        return redirect('/loket/pendaftaran')->with('status', 'berhasil menambahkan rujukan');
    }

    public function getInfoMedicalReport(Request $request)
    {
        $respone = array();
        try {
            $patient = Patient::where('number_medical_record', $request['number_mr'])->first();
            $message = 'Pasien Tidak ada';
            if ($patient) {
                $message = 'Pasien ada';
            }
            $respone = array('is_success' => true, 'message' => $message, 'data' => $patient);
        } catch (\Exception $e) {
            $respone = array('is_success' => false, 'message' => $e->getMessage());
        }
        return $respone;
    }

    public function selectPoly(Request $request)
    {
        $respone = array();
        try {
            $poly = Poly::with(['doctors'])->find($request['id']);
            $respone = ['is_success' => true, 'message' => 'poli ada', 'data' => $poly->toJson()];
        } catch (\Exception $e) {
            $respone = ['is_success' => false, 'message' => $e->getMessage(), 'data' => null];
        }
        return collect($respone);
    }
}
