<?php

namespace App\Http\Controllers\loket;

use App\Kiosk;
use App\Poly;
use App\Staff;
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

    public function getCreateEdit(Request $request)
    {
        $kiosk_id = $request->query('id');
        $polies = Poly::get();
        $doctors = Staff::whereHas('staffJob', function ($q){
            $q->where('name', 'Dokter');
        })->get();

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
        return view('registration.createEdit', compact(['polies', 'doctors']));
    }

    public function postCreateEdit(Request $request)
    {
        $input = $request->except('_token');
        dd($input);
    }
}
