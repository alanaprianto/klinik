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
        $batches = Batch::with(['inventory'])->get();
        $batches['recordsTotal'] = count($batches);
        return $batches;
    }

    protected function getBuyers(){
        $buyers = Buyer::with(['recipe'])->get();
        $buyers['recordsTotal'] = count($buyers);
        return $buyers;
    }

    protected function getDoctorServices(){
        $doctorServices = DoctorService::with(['doctor'])->get();
        $doctorServices['recordsTotal'] = count($doctorServices);
        return $doctorServices;
    }

    protected function getHospital(){
        $hospital = Hospital::with(['staffs', 'patients'])->first();
        return $hospital;
    }

    protected function getIcd10s(){
        $icd10s = Icd10::get();
        $icd10s['recordsTotal'] = count($icd10s);
        return $icd10s;
    }

    protected function getInventories(){
        $inventories = Inventory::with(['batches', 'pharmacySellers'])->get();
        $inventories['recordsTotal'] = count($inventories);
        return $inventories;
    }

    protected function getKiosks(){
        $kiosks = Kiosk::get();
        $kiosks['recordsTotal'] = count($kiosks);
        return $kiosks;
    }

    protected function getMedicalRecords(){
        $medicalRecords = MedicalRecord::with(['reference', 'patient', 'staff', 'service'])->get();
        $medicalRecords['recordsTotal'] = count($medicalRecords);
        return $medicalRecords;
    }

    protected function getPatients(){
        $patient = Patient::with(['hospital', 'registers'])->get();
        $patient['recordsTotal'] = count($patient);
        return $patient;
    }

    protected function getPayments(){
        $payment = Payment::with(['reference', 'register'])->get();
        $payment['recordsTotal'] = count($payment);
        return $payment;
    }

    protected function getPermissions(){
        $permissions = Permission::with(['roles'])->get();
        $permissions['recordsTotal'] = count($permissions);
        return $permissions;
    }

    protected function getPharmacySeller(){
        $pharmacySeller = PharmacySeller::with(['inventory', 'recipe'])->get();
        $pharmacySeller['recordsTotal'] = count($pharmacySeller);
        return $pharmacySeller;
    }

    protected function getPolies(){
        $polies = Poly::with(['references', 'doctors'])->get();
        $polies['recordsTotal'] = count($polies);
        return $polies;
    }

    protected function getRecipes(){
        $recipes = Recipe::with(['reference', 'pharmacySellers', 'staff', 'tuslahs', 'buyer'])->get();
        $recipes['recordsTotal'] = count($recipes);
        return $recipes;
    }

    protected function getReferences(){
        $references = Reference::with(['register', 'poly', 'doctor', 'medicalRecords', 'payments', 'recipe'])->get();
        $references['recordsTotal'] = count($references);
        return $references;
    }

    protected function getRegisters(){
        $registers = Register::with(['patient', 'staff', 'references', 'payments'])->get();
        $registers['recordsTotal'] = count($registers);
        return $registers;
    }

    protected function getRoles(){
        $roles = Role::with(['perms'])->get();
        $roles['recordsTotal'] = count($roles);
        return $roles;
    }

    protected function getServices(){
        $services = Service::with(['medicalRecords'])->get();
        $services['recordsTotal'] = count($services);
        return $services;
    }

    protected function getSettings(){
        $settings = Setting::get();
        $settings['recordsTotal'] = count($settings);
        return $settings;
    }

    protected function agetStaff(){
        $staff = Staff::with(['user', 'hospital', 'staffJob', 'staffPosition' , 'register', 'references', 'polies', 'medicalRecords', 'doctorService', 'recipes'])->get();
        $staff['recordsTotal'] = count($staff);
        return $staff;
    }

    protected function getStaffJobs(){
        $staffJobs = StaffJob::with(['staffs'])->get();
        $staffJobs['recordsTotal'] = count($staffJobs);
        return $staffJobs;
    }

    protected function getStaffPositions(){
        $staffPositions = StaffPosition::with(['staff'])->get();
        $staffPositions['recordsTotal'] = count($staffPositions);
        return $staffPositions;
    }

    protected function getTuslahs(){
        $tuslahs = Tuslah::with(['recipe'])->get();
        $tuslahs['recordsTotal'] = count($tuslahs);
        return $tuslahs;
    }

    protected function getUsers(){
        $user = User::with(['roles', 'staff'])->get();
        $user['recordsTotal'] = count($user);
        return $user;
    }

}
