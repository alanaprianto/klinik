<?php

namespace App\Http\Controllers\Common;

use App\Depo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiDepoController extends Controller
{
    public function getDepo($id){
        $response = [];
        try {
            $depo = Depo::with(['inventories'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['depo' => $depo]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
