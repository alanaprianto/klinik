<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LRedis;

class ChatController extends Controller
{
    public function getChat(Request $request){
        $users = User::with(['staff'])->get();

        $redis = LRedis::connection();
        $redis->set('users_ids', Auth::user()->id);

        return view('Common::chat.index', compact('users'));
    }
}
