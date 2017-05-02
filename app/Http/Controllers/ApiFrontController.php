<?php

namespace App\Http\Controllers;

use App\Kiosk;
use Illuminate\Http\Request;

// Controller utk proses yg tidak butuh login
class ApiFrontController extends GeneralController
{
    public function welcome(){
        $response = [];
        try {
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);

    }

    public function getDisplay(){
        $response = [];
        try {
            $kiosks = Kiosk::whereIn('type', ['bpjs', 'umum', 'contractor'])->get();
            $umum = $kiosks->where('type', 'umum')->where('status', 2)->last();
            $bpjs = $kiosks->where('type', 'bpjs')->where('status', 2)->last();
            $contractor = $kiosks->where('type', 'contractor')->where('status', 2)->last();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosks' => $kiosks, 'umum' => $umum, 'bpjs' => $bpjs, 'contractor' => $contractor]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function postKiosk(Request $request){
        $response = [];
        try {
            $input = $request->all();
            $addKiosk =  $this->getKioskQueue($input['type'], null);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosk' => $addKiosk]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
