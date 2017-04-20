<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Buyer;
use App\DoctorService;
use App\Hospital;
use App\Icd10;
use App\Inventory;
use App\Kiosk;
use App\MedicalRecord;
use App\Patient;
use App\Payment;
use App\Permission;
use App\PharmacySeller;
use App\Poly;
use App\Recipe;
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
use Illuminate\Http\Request;
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

    protected function addReference($input, $register, $type){
        if($type == 'create'){
            $register_id = $register->id;
        }else{
            $register_id = $input['register_id'];
        }
        $reference = Reference::create([
            'number_reference' => Carbon::now()->format('Ymdhis'),
            'register_id' => $register_id,
            'poly_id' => $input['poly_id'],
            'staff_id' => $input['doctor_id'],
            'status' => 1
        ]);
        return $reference;
    }

    private function getNumber($number)
    {
        $split_string = str_split($number, 1);
        $array = [];

        foreach ($split_string as $string_number) {
            switch ($string_number) {
                case '0':
                    $number = 'sounds/0.mp3';
                    array_push($array, $number);
                    break;
                case '1':
                    $number = 'sounds/1.mp3';
                    array_push($array, $number);
                    break;
                case '2':
                    $number = 'sounds/2.mp3';
                    array_push($array, $number);
                    break;
                case '3':
                    $number = 'sounds/3.mp3';
                    array_push($array, $number);
                    break;
                case '4':
                    $number = 'sounds/4.mp3';
                    array_push($array, $number);
                    break;
                case '5':
                    $number = 'sounds/5.mp3';
                    array_push($array, $number);
                    break;
                case '6':
                    $number = 'sounds/6.mp3';
                    array_push($array, $number);
                    break;
                case '7':
                    $number = 'sounds/7.mp3';
                    array_push($array, $number);
                    break;
                case '8':
                    $number = 'sounds/8.mp3';
                    array_push($array, $number);
                    break;
                case '9':
                    $number = 'sounds/9.mp3';
                    array_push($array, $number);
                    break;
            }
        }

        return $array;
    }

    private function getTypeRegister($type)
    {
        switch ($type) {
            case 'bpjs':
                $type_sound = 'sounds/c1.mp3';
                break;
            case 'umum':
                $type_sound = 'sounds/c4.mp3';
                break;
            case 'contractor':
                $type_sound = 'sounds/c5.mp3';
                break;
            default :
                $type_sound = 'sounds/c4.mp3';
                break;
        }
        return $type_sound;
    }

    private function getTypeCheckUp($type)
    {
        switch ($type) {
            case 'Poli Umum':
                $type_sound = 'sounds/d4.mp3';
                break;
            default :
                $type_sound = 'sounds/d4.mp3';
                break;
        }
        return $type_sound;
    }

    protected function eachKiosK($kiosks, $type_record){
        $path = 'sounds/temp/';
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        foreach ($kiosks as $index => $kiosk) {
            $name = $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            if ($kiosk->status == 1) {
                if (!File::exists($path.$name)) {
                    $numbers = $this->getNumber($kiosk->queue_number);
                    if($type_record == 'register'){
                        $type = file_get_contents($this->getTypeRegister($kiosk->type));
                    } else{
                        $type = file_get_contents($this->getTypeCheckUp($kiosk->type));

                    }
                    $nomor_antrian = file_get_contents('sounds/c-no-antrian.mp3');
                    $zero = file_get_contents('sounds/0.mp3');

                    if (count($numbers) == 1) {
                        $first = file_get_contents($numbers[0]);
                        file_put_contents($path . $name, $nomor_antrian . $zero . $zero . $first . $type);
                    } elseif (count($numbers) == 2) {
                        $first = file_get_contents($numbers[0]);
                        $second = file_get_contents($numbers[1]);
                        file_put_contents($path . $name, $nomor_antrian . $zero . $first . $second . $type);
                    } elseif (count($numbers) == 3) {
                        $first = file_get_contents($numbers[0]);
                        $second = file_get_contents($numbers[1]);
                        $third = file_get_contents($numbers[2]);
                        file_put_contents($path . $name, $nomor_antrian . $first . $second . $third . $type);
                    }
                }
            }
            if($kiosk->status == 1 || $kiosk->status == 2){
                $kiosks[$index]->location = $name;
            }
        }

        return $kiosks;
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

    protected function getBuyers(){
        $response = [];
        try {
            $buyers = Buyer::with(['recipe'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['buyers' => $buyers, 'recordsTotal' => count($buyers)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
    }

    protected function getDoctorServices(){
        $response = [];
        try {
            $doctorServices = DoctorService::with(['doctor'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['doctorServices' => $doctorServices, 'recordsTotal' => count($doctorServices)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
    }

    protected function getHospital(){
        $hospital = Hospital::with(['staffs', 'patients'])->first();
        return $hospital;
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
            $inventories = Inventory::with(['batches', 'pharmacySellers'])->get();
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

    protected function getPharmacySeller(){
        $response = [];
        try {
            $pharmacySeller = PharmacySeller::with(['inventory', 'recipe'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['pharmacySeller' => $pharmacySeller, 'recordsTotal' => count($pharmacySeller)]];
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

    protected function getRecipes(){
        $response = [];
        try {
            $recipes = Recipe::with(['reference', 'pharmacySellers', 'staff', 'tuslahs', 'buyer'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['recipes' => $recipes, 'recordsTotal' => count()]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    protected function getReferences(){
        $response = [];
        try {
            $references = Reference::with(['register', 'poly', 'doctor', 'medicalRecords', 'payments', 'recipe'])->get();
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
            $services = Service::with(['medicalRecords'])->get();
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
            $staff = Staff::with(['user', 'hospital', 'staffJob', 'staffPosition' , 'register', 'references', 'polies', 'medicalRecords', 'doctorService', 'recipes'])->get();
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
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staffJobs', 'recordsTotal' => count($staffJobs)]];
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
            $tuslahs = Tuslah::with(['recipe'])->get();
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

}
