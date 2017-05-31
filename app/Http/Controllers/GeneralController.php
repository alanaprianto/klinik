<?php

namespace App\Http\Controllers;

use App\Batch;
use App\City;
use App\Country;
use App\Distributor;
use App\District;
use App\DoctorService;
use App\Hospital;
use App\Icd10;
use App\Inventory;
use App\Kiosk;
use App\MedicalRecord;
use App\Patient;
use App\Payment;
use App\Permission;
use App\Poly;
use App\Province;
use App\Reference;
use App\Register;
use App\Role;
use App\Room;
use App\Service;
use App\Setting;
use App\Staff;
use App\StaffJob;
use App\StaffPosition;
use App\SubDistrict;
use App\Tuslah;
use App\User;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    protected function getKioskQueue($type, $reference_id)
    {
        $this_day = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $kiosk = Kiosk::where('type', $type)->whereDate('date', $this_day)->get()->last();
        $queue = sprintf('%03d', 1);
        if($kiosk){
            $queue = $kiosk->queue_number + 1;
            $queue = sprintf('%03d', $queue);
        }
        $input = [
            'queue_number' => $queue,
            'date' => $now,
            'status' => 1,
            'type' => $type,
            'reference_id' => $reference_id
        ];
        $addKiosk = Kiosk::create($input);
        return $addKiosk;
    }

    protected function addReference($input, $register){
        $poly = Poly::find($input['poly_id']);
        $reference = Reference::create([
            'number_reference' => 'REF_'.Carbon::now()->format('Ymdhis'),
            'register_id' => $register->id,
            'poly_id' => $poly->id,
            'staff_id' => $input['doctor_id'],
            'status' => 1
        ]);
        $final_reference = Reference::with(['poly'])->find($reference->id);
        $final_reference['kiosk'] = $this->getKioskQueue($poly->name, $final_reference->id);
        return $final_reference;
    }

    protected function addReferenceInpatient($input, $register){
        $reference = Reference::create([
            'number_reference' => 'REF_'.Carbon::now()->format('Ymdhis'),
            'register_id' => $register->id,
            'status' => 1,
            'staff_id' => Staff::where('user_id', Auth::user()->id)->first()->id,
            'class_room_id' => $input['class_room_id'],
            'room_id' => $input['room_id'],
            'bed_id' => $input['bed_id']
        ]);

        $patient = Patient::find($input['patient_id']);
        $room = Room::find($input['room_id']);
        $patient->update([
            'room_id' => $room->id
        ]);
        $bed = $room->beds()->find($input['bed_id']);
        $bed->update(['patient_id' => $patient->id]);

        return $reference;
    }

    /*get all Model*/
    protected function getBatches(){
        $response = [];
        try {
            $batches = Batch::with(['inventory'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['batches' => $batches, 'recordsTotal' => count($batches)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getDoctorServices(){
        $response = [];
        try {
            $doctorServices = DoctorService::with(['doctor'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['doctorServices' => $doctorServices, 'recordsTotal' => count($doctorServices)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getHospital(){
        $response = [];
        try {
            $hospital = Hospital::with(['staffs', 'patients'])->first();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['hospital' => $hospital]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getIcd10s(){
        $response = [];
        try {
            $icd10s = Icd10::get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['icd10s' => $icd10s, 'recordsTotal' => count($icd10s)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getInventories(){
        $response = [];
        try {
            $inventories = Inventory::with(['batches', 'depos'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventories' => $inventories, 'recordsTotal' => count($inventories)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getKiosks(){
        $response = [];
        try {
            $kiosks = Kiosk::get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosks' => $kiosks, 'recordsTotal' => count($kiosks)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getMedicalRecords(){
        $response = [];
        try {
            $medicalRecords = MedicalRecord::with(['reference', 'patient', 'staff', 'service'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['medicalRecords' => $medicalRecords, 'recordsTotal' => count($medicalRecords)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getPatients(){
        $response = [];
        try {
            $patient = Patient::with(['hospital', 'registers'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['patient' => $patient, 'recordsTotal' => count($patient )]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getPayments(){
        $response = [];
        try {
            $payment = Payment::with(['reference', 'register'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['paymen' => $payment, 'recordsTotal' => count($payment)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getPermissions(){
        $response = [];
        try {
            $permissions = Permission::with(['roles'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permissions' => $permissions, 'recordsTotal' => count($permissions)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getPolies(){
        $response = [];
        try {
            $polies = Poly::with(['references', 'doctors'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['polies' => $polies, 'recordsTotal' => count($polies)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getReferences(){
        $response = [];
        try {
            $references = Reference::with(['register', 'poly', 'doctor', 'medicalRecords', 'payments'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['references' => $references, 'recordsTotal' => count($references)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getRegisters(){
        $response = [];
        try {
            $registers = Register::with(['patient', 'staff', 'references', 'payments'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['registers' => $registers, 'recordsTotal' => count($registers)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getRoles(){
        $response = [];
        try {
            $roles = Role::with(['perms'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['roles' => $roles, 'recordsTotal' => count($roles)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getServices(){
        $response = [];
        try {
            $services = Service::with(['medicalRecords', 'inventories', 'categoryService'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['services' => $services, 'recordsTotal' => count($services)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getSettings(){
        $response = [];
        try {
            $settings = Setting::get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['settings' => $settings, 'recordsTotal' => count($settings)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getStaff(){
        $response = [];
        try {
            $staff = Staff::with(['user', 'hospital', 'staffJob', 'staffPosition' , 'register', 'references', 'polies', 'medicalRecords', 'doctorService'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff, 'recordsTotal' => count($staff)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getStaffJobs(){
        $response = [];
        try {
            $staffJobs = StaffJob::with(['staffs'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staffJobs' => $staffJobs, 'recordsTotal' => count($staffJobs)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getStaffPositions(){
        $response = [];
        try {
            $staffPositions = StaffPosition::with(['staff'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staffPositions' => $staffPositions, 'recordsTotal' => count($staffPositions)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getTuslahs(){
        $response = [];
        try {
            $tuslahs = Tuslah::with()->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['tuslahs' => $tuslahs, 'recordsTotal' => count($tuslahs)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getUsers(){
        $response = [];
        try {
            $users = User::with(['roles', 'staff'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['users' => $users, 'recordsTotal' => count($users)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getDoctors(){
        $response = [];
        try {
            $doctors = Staff::whereHas('staffJob', function ($q) {
                $q->where('name', 'Dokter');
            })->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['doctors' => $doctors, 'recordsTotal' => count($doctors)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getDistributors(){
        $response = [];
        try {
            $distributors = Distributor::get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['distributors' => $distributors, 'recordsTotal' => count($distributors)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getCountries(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $country = Country::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['country' => $country]];
            } else {
                $countries = Country::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['countries' => $countries, 'recordsTotal' => count($countries)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getProvinces(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $province = Province::where('sub_code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['province' => $province]];
            } else {
                $provinces = Province::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['provinces' => $provinces, 'recordsTotal' => count($provinces)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getCities(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $city = City::where('sub_code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['city' => $city]];
            } else {
                $cities = City::get();
                    $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['cities' => $cities, 'recordsTotal' => count($cities)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getDistrict(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if(isset($input['code']) && $input['code']){
                $district = District::where('sub_code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['district' => $district]];
            } else{
                $districts = District::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['districts' => $districts, 'recordsTotal' => count($districts)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getSubDistrict(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if(isset($input['code']) && $input['code']){
                $subDistrict = SubDistrict::where('sub_code', $input['code'])->get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['subDistricts' => $subDistrict]];
            } else{
                $subDistrict = SubDistrict::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['subDistricts' => $subDistrict, 'recordsTotal' => count($subDistrict)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
