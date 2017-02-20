<?php

namespace App\Http\Controllers\PenataJasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenataJasaController extends Controller
{
    public function index(){
        return view('/home');
    }
}
