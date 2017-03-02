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
        $kiosk = Kiosk::whereNotNull('reference_id')->get();
        $datatable = Datatables::of($kiosk);
        return $datatable->make(true);
    }
}
