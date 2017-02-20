<?php

namespace App\Http\Controllers\Loket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoketController extends Controller
{
    public function index(){
        return view('/home');
    }
}
