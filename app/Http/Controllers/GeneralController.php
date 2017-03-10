<?php

namespace App\Http\Controllers;

use App\Kiosk;
use App\Reference;
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
        $queue = 1;
        if($kiosk){
            $queue = $kiosk->queue_number + 1;
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
            'register_id' => $register_id,
            'poly_id' => $input['poly'],
            'staff_id' => $input['doctor'],
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
            if ($kiosk->status == 1) {
                $name = $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
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
                $kiosks[$index]->location = $name;
            }
        }

        return $kiosks;
    }
}
