<?php

namespace App\Http\Controllers\Loket;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use File;
use LRedis;

class QueueController extends GeneralController
{
    protected $LRedis;
    public function __construct(LRedis $lredis)
    {
        $this->LRedis = $lredis::connection();
    }

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
                $kiosks = Kiosk::where('type', 'bpjs')->whereIn('status', [1,2,3])->get();
                break;
            case 'umum':
                $kiosks = Kiosk::where('type', 'umum')->whereIn('status', [1,2,3])->get();
                break;
            case 'contractor' :
                $kiosks = Kiosk::where('type', 'contractor')->whereIn('status', [1,2,3])->get();
                break;
            default:
                $kiosks = Kiosk::get();
                break;
        }

        $kiosk_final = $this->eachKiosK($kiosks, 'register');
        $datatable = Datatables::of($kiosk_final);
        return $datatable->make(true);
    }


    public function updateStatus(Request $request){
        $message = [];
        try{
            $kiosk = Kiosk::find($request['id']);
            if($kiosk->status != 2){
                $kiosk->update([
                    'status' => 2
                ]);

/*                $redis = $this->LRedis;
                $redis->publish('message', $kiosk->type);
                $redis->publish('update-front', json_encode([sprintf('%03d', $kiosk->queue_number), $kiosk->type, 'calling'], true));*/
            }

        } catch (\Exception $e){
            $message = ['isSuccess' => false, 'message' => $e->getMessage()];
        }
        return $message;
    }

}
