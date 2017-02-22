<?php

namespace App\Http\Controllers\Loket;

use App\Kiosk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class QueueController extends Controller
{
    public function index(){
        return view('queue.index');
    }

    public function getList(){
        $kiosk = Kiosk::where('status', 'open')->get();
        $datatable = Datatables::of($kiosk);
        return $datatable->make(true);
    }
}
