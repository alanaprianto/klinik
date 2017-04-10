<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class ApiQueueController extends GeneralController
{
    public function index()
    {
        $response = [];
        try {
            $user = Auth::user();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['user' => $user]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getList()
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
            $datatable = Datatables::of($kiosk_final);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => $datatable->make(true)];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function updateStatus(Request $request)
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
