<?php

namespace App\Http\Controllers\Loket;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class ApiQueueController extends GeneralController
{
    public function index(){
        $response = [];
        try{
            $user = User::find(Auth::user()->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['user' => $user]];
        } catch (\Exception $e){
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getList(Request $request)
    {
        $response = [];
        try {
            /*
             * 1 = open
             * 2 = calling
             * 3 = on process
             * 4 = finish*/
            switch ($request->query('type')) {
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

            $kiosk_final = $this->eachKiosK($kiosks, 'register');
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
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => $kiosk];

        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
