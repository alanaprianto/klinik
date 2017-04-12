<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KasirController extends Controller
{
    public function index(){
        return view('/home');
    }
}
