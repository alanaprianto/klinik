<?php

namespace App\Http\Controllers\PenataJasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function index(){
        return view('queue.index');
    }

    public function getList(Request $request){
        $type = $request->query('type');
        switch ($type){
            case '':
                break;
            case 'poly':
                break;
            case '':
                break;
            case '':
                break;
            case '':
                break;
            case '':
                break;
            case '':
                break;
            case '':
                break;
        }

    }
}
