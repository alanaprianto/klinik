<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class QueueController extends GeneralController
{
    public function index(){
        return view('queue.index');
    }

    public function getList(){
        $user = Auth::user();
        if($user->hasRole('poli_umum')){
            $kiosks = Kiosk::where('type', 'Poli Umum')->whereNotNull('reference_id')->whereIn('status', [1,2])->get();
        } elseif ($user->hasRole('poli_anak')){
            $kiosks = Kiosk::where('type', 'Poli Anak')->whereNotNull('reference_id')->whereIn('status', [1,2])->get();
        }
        $kiosk_final = $this->eachKiosK($kiosks, 'checkup');
        $datatable = Datatables::of($kiosk_final);
        return $datatable->make(true);
    }
}
