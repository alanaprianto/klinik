<?php

namespace App\Http\Controllers;

use App\Kiosk;
use App\Reference;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
