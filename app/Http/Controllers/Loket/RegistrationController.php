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

    public function create(Request $request){
        $id = $request->query('id');
        if ($id) {
            $kiosk = Kiosk::find($id);
            $kiosk->update([
                'status' => 'close'
            ]);

            $redis = LRedis::connection();
            $redis->publish('message', $kiosk->queue_number . '_' . $kiosk->type);
            $filename = 'sounds/temp/' . $kiosk->queue_number . '_' . $kiosk->type . '.mp3';
            File::delete($filename);
        }

        return view('registration.create');
    }
}
