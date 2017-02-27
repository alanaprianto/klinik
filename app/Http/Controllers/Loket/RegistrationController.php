<?php

namespace App\Http\Controllers\loket;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LRedis;
use File;


class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }

    public function getCreateEdit(Request $request){
        $kiosk_id = $request->query('id');
        if ($kiosk_id) {
            $kiosk = Kiosk::find($kiosk_id);
            $kiosk->update([
                'status' => 'close'
            ]);

            $redis = LRedis::connection();
            $redis->publish('message', $kiosk->queue_number . '_' . $kiosk->type);
            $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            File::delete($filename);
        }


        return view('registration.createEdit');
    }

    public function postCreateEdit(Request $request){
        dd($request);
    }
}
