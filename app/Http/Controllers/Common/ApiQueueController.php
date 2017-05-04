<?php

namespace App\Http\Controllers\Common;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = [];
        try {
            /*
             * 1 = open
             * 2 = calling
             * 3 = on process
             * 4 = finish*/
            if(isset($request['type'])){
                $kiosks = Kiosk::with(['reference', 'reference.register', 'reference.medicalRecords' , 'reference.register.patient'])->where('type', $request['type'])->whereIn('status', [1, 2, 3])->get();
            } else{
                $kiosks = Kiosk::with(['reference', 'reference.register', 'reference.medicalRecords' ,'reference.register.patient'])->whereIn('status', [1, 2, 3])->get();
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosks' => $kiosks, 'recordsTotal' => count($kiosks)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            $kiosk = Kiosk::find($input['id']);
            if ($kiosk->status != 2) {
                $kiosk->update([
                    'status' => 2
                ]);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosk' => $kiosk]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
