<?php

namespace App\Http\Controllers;

use App\Kiosk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LRedis;

class FrontController extends GeneralController
{
    protected $LRedis;

    public function __construct(LRedis $lredis)
    {
        $this->LRedis = $lredis::connection();
    }

    public function welcome(){
        return view('welcome');
    }

    public function getDisplay(){
        $kiosks = Kiosk::whereIn('type', ['bpjs', 'umum', 'contractor'])->get();
        $umum = $kiosks->where('type', 'umum')->where('status', 2)->last();
        $bpjs = $kiosks->where('type', 'bpjs')->where('status', 2)->last();
        $contractor = $kiosks->where('type', 'contractor')->where('status', 2)->last();
        return view('display', compact(['kiosks', 'umum', 'bpjs', 'contractor']));
    }

    public function getKiosk(){
        return view('kiosk.index');
    }

    public function postKiosk(Request $request){
        $respone = array();
        try{
            $addKiosk =  $this->getKioskQueue($request->type, null);
            $respone = array('is_success' => true, 'message'  => $addKiosk);
            $redis = $this->LRedis;
            /*push to loket table*/
/*            $redis->publish('message', $request->type);*/

            /*push to front*/
/*            $count = count(Kiosk::where('type', $request->type)->get());
            $redis->publish('update-front', json_encode([$count, $request->type, 'total'], true));*/
        }catch (\Exception $e){
            $respone = array('is_success' => false, 'message' => $e->getMessage());
        }

        return collect($respone);
    }

}
