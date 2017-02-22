<?php

namespace App\Http\Controllers\loket;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LRedis;


class RegistrationController extends Controller
{
    public function getRegister(Request $request){
        $id = $request->query('id');
        if($id){
            $kiosk = Kiosk::find($id);
            $kiosk->update([
                'status' => 'close'
            ]);

            $redis = LRedis::connection();
            $redis->publish('message', $kiosk->queue_number.'_'.$kiosk->type);
        }

        return view('registration.create');
    }
}
