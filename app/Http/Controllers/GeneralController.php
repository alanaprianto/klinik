<?php

namespace App\Http\Controllers;

use App\Batch;
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
use App\Reference;
use App\Register;
use App\Role;
use App\Service;
use App\Setting;
use App\Staff;
use App\StaffJob;
use App\StaffPosition;
use App\Tuslah;
use App\User;
use Carbon\Carbon;
use File;

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
            'number_reference' => Carbon::now()->format('Ymdhis'),
            'register_id' => $register->id,
            'poly_id' => $poly->id,
            'staff_id' => $input['doctor_id'],
            'status' => 1
        ]);
        $final_reference = Reference::with(['poly'])->find($reference->id);
        $final_reference['kiosk'] = $this->getKioskQueue($poly->name, $final_reference->id);
        return $final_reference;
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
            $services = Service::with(['medicalRecords', 'inventories'])->get();
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
}
