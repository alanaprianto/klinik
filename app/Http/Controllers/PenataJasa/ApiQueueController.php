<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiQueueController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try {
            $user = Auth::user();
            if ($user->hasRole('poli_umum') || $user->hasRole('admin_poli_umum')) {
                $kiosks = Kiosk::where('type', 'Poli Umum')->whereNotNull('reference_id')->whereIn('status', [1, 2, 3])->get();
            } elseif ($user->hasRole('poli_anak')) {
                $kiosks = Kiosk::where('type', 'Poli Anak')->whereNotNull('reference_id')->whereIn('status', [1, 2, 3])->get();
            }
            $kiosk_final = $this->eachKiosK($kiosks, 'checkup');

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['kiosks' => $kiosk_final, 'recordsTotal' => count($kiosk_final)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = [];
        try {
            $kiosk = Kiosk::find($request['id']);
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
