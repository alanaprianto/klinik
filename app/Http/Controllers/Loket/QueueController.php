<?php

namespace App\Http\Controllers\Loket;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class QueueController extends Controller
{

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

    private function getType($type)
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
                $type_sound = '-';
                break;
        }
        return $type_sound;
    }

    public function index()
    {
        return view('queue.index');
    }

    public function getList(Request $request)
    {
        switch ($request->query('type')) {
            case 'bpjs':
                $kiosks = Kiosk::where('type', 'bpjs')->where('status', 'open')->get();
                break;
            case 'umum':
                $kiosks = Kiosk::where('type', 'umum')->where('status', 'open')->get();
                break;
            case 'contractor' :
                $kiosks = Kiosk::where('type', 'contractor')->where('status', 'open')->get();
                break;
            default:
                $kiosks = Kiosk::get();
                break;
        }

        foreach ($kiosks as $index => $kiosk) {
            if ($kiosk->status == 'open') {

                $location = $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
                $numbers = $this->getNumber($kiosk->queue_number);
                $type = file_get_contents($this->getType($kiosk->type));
                $nomor_antrian = file_get_contents('sounds/c-no-antrian.mp3');
                $zero = file_get_contents('sounds/0.mp3');


                if (count($numbers) == 1) {
                    $first = file_get_contents($numbers[0]);
                    file_put_contents('sounds/temp/' . $location, $nomor_antrian . $zero . $zero . $first . $type);
                } elseif (count($numbers) == 2) {
                    $first = file_get_contents($numbers[0]);
                    $second = file_get_contents($numbers[1]);
                    file_put_contents('sounds/temp/' . $location, $nomor_antrian . $zero . $first . $second . $type);
                } elseif (count($numbers) == 3) {
                    $first = file_get_contents($numbers[0]);
                    $second = file_get_contents($numbers[1]);
                    $third = file_get_contents($numbers[2]);
                    file_put_contents('sounds/temp/' . $location, $nomor_antrian . $zero . $first . $second . $third . $type);
                }
                $kiosks[$index]->location = $location;
            }
        }
        $datatable = Datatables::of($kiosks);
        return $datatable->make(true);
    }
}
