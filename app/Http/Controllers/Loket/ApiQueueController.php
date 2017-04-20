<?php

namespace App\Http\Controllers\Loket;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiQueueController extends GeneralController
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
            switch ($request['type']) {
                case 'bpjs':
                    $kiosks = Kiosk::where('type', 'bpjs')->whereIn('status', [1, 2, 3])->get();
                    break;
                case 'umum':
                    $kiosks = Kiosk::where('type', 'umum')->whereIn('status', [1, 2, 3])->get();
                    break;
                case 'contractor' :
                    $kiosks = Kiosk::where('type', 'contractor')->whereIn('status', [1, 2, 3])->get();
                    break;
                default:
                    $kiosks = Kiosk::get();
                    break;
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
    public function update(Request $request, $id)
    {
        $response = [];
        try {
            $kiosk = Kiosk::find($id);
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
