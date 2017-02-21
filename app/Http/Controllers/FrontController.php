<?php

namespace App\Http\Controllers;

use App\Kiosk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getKiosk(){
        return view('kiosk.index');
    }

    public function postKiosk(Request $request){
        $respone = array();
        try{
            $now = Carbon::now();
            $kiosk = Kiosk::where('type', $request['type'])->get()->last();
            $queue = 1;
            if($kiosk){
                $queue = $kiosk->queue_number + 1;
            }
            $input = [
                'queue_number' => $queue,
                'date' => $now,
                'status' => 'open',
                'registration_number' => $now->format('Ymdhis'),
                'type' => $request->type,
            ];
            $addKiosk = Kiosk::create($input);

            $respone = array('is_success' => true, 'message'  => $addKiosk);
        }catch (\Exception $e){
            $respone = array('is_success' => false, 'message' => $e->getMessage());
        }

        return collect($respone);

    }
}
