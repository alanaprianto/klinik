<?php

namespace App\Http\Controllers\PenataJasa;

use App\Http\Controllers\GeneralController;
use App\Kiosk;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use LRedis;

class QueueController extends GeneralController
{
    protected $LRedis;
    public function __construct(LRedis $lredis)
    {
        $this->LRedis = $lredis::connection();
    }
    public function index(){
        return view('queue.index');
    }

    public function getList(){
        $user = Auth::user();
        if($user->hasRole('poli_umum')){
            $kiosks = Kiosk::where('type', 'Poli Umum')->whereNotNull('reference_id')->whereIn('status', [1,2,3])->get();
        } elseif ($user->hasRole('poli_anak')){
            $kiosks = Kiosk::where('type', 'Poli Anak')->whereNotNull('reference_id')->whereIn('status', [1,2,3])->get();
        }
        $kiosk_final = $this->eachKiosK($kiosks, 'checkup');
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

                $redis = $this->LRedis;
                $redis->publish('message', $kiosk->type);
                /*update front*/
                $redis->publish('update-front', json_encode([sprintf('%03d', $kiosk->queue_number), $kiosk->type, 'calling'], true));
            }

        } catch (\Exception $e){
            $message = ['isSuccess' => false, 'message' => $e->getMessage()];
        }
        return $message;
    }
}
