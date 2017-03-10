<?php

namespace App\Http\Controllers\Loket;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use File;

class QueueController extends GeneralController
{
    public function index()
    {
        return view('queue.index');
    }

    public function getList(Request $request)
    {
        /*
         * 1 = open
         * 2 = on process
         * 3 = close
         * */
        switch ($request->query('type')) {
            case 'bpjs':
                $kiosks = Kiosk::where('type', 'bpjs')->whereIn('status', [1,2])->get();
                break;
            case 'umum':
                $kiosks = Kiosk::where('type', 'umum')->whereIn('status', [1,2])->get();
                break;
            case 'contractor' :
                $kiosks = Kiosk::where('type', 'contractor')->whereIn('status', [1,2])->get();
                break;
            default:
                $kiosks = Kiosk::get();
                break;
        }

        $kiosk_final = $this->eachKiosK($kiosks, 'register');
        $datatable = Datatables::of($kiosk_final);
        return $datatable->make(true);
    }
}
