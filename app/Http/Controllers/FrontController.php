<?php

namespace App\Http\Controllers;

use App\Kiosk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends GeneralController
{
    public function getKiosk(){
        return view('kiosk.index');
    }

    public function postKiosk(Request $request){
        $respone = array();
        try{
            $addKiosk =  $this->getKioskQueue($request->type, null);
            $respone = array('is_success' => true, 'message'  => $addKiosk);
        }catch (\Exception $e){
            $respone = array('is_success' => false, 'message' => $e->getMessage());
        }

        return collect($respone);
    }

}
