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

    public function getKiosk(){
        return view('kiosk.index');
    }

    public function postKiosk(Request $request){
        $respone = array();
        try{
            $addKiosk =  $this->getKioskQueue($request->type, null);
            $respone = array('is_success' => true, 'message'  => $addKiosk);
            $redis = $this->LRedis;
            $redis->publish('message', $request->type);
        }catch (\Exception $e){
            $respone = array('is_success' => false, 'message' => $e->getMessage());
        }

        return collect($respone);
    }

}
