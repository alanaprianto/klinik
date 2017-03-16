<?php

namespace App\Http\Controllers;

use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = User::with('staff')->find(Auth::user()->id);
        return view('Common::profile.index', compact('user'));
    }

    public function postUpdate(Request $request){
        $input = $request->except('_token');
        $user = User::find($input['user_id']);
        $staff = Staff::where('user_id', $user->id)->first();
        $staff->update($input);
        return redirect()->back()->with('status', 'Berhasil');
    }
}
