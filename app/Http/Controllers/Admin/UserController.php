<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        return view('');
    }

    public function createEdit(Request $request,$param){
        return view('user.createEdit');
    }
}
