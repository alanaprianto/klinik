<?php

namespace App\Http\Controllers\PenataJasa;

use App\Reference;
use App\Service;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckUpController extends Controller
{
    public function getCreate($id){
        $reference = Reference::with(['register', 'register.patient' ,'poly', 'poly.doctors' ,'doctor'])->find($id);
        $services = Service::get();
        return view('checkUp.create', compact(['reference', 'services']));
    }

    public function getService(Request $request){
        $respone = [];
        try{
            $service = Service::find($request->id);
            $respone = ['is_success' => true, 'message' => 'service ada', 'data' => $service];
        }catch (\Exception $e)
        {
            $respone = ['is_success' => false, 'message' => $e->getMessage(), 'data' => null];
        }
        return collect($respone);
    }

    public function postCreate(Request $request){
        dd($request->all());
    }
}
