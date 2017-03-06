<?php

namespace App\Http\Controllers\PenataJasa;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class QueueController extends Controller
{
    public function index(){
        return view('queue.index');
    }

    public function getList(){
        $user = Auth::user();
        if($user->hasRole('poli_umum')){
            $kiosk = Kiosk::where('type', 'Poli Umum')->whereNotNull('reference_id')->whereIn('status', [1,2])->get();
        } elseif ($user->hasRole('poli_anak')){
            $kiosk = Kiosk::where('type', 'Poli Anak')->whereNotNull('reference_id')->whereIn('status', [1,2])->get();
        }
        $datatable = Datatables::of($kiosk);
        return $datatable->make(true);
    }
}
