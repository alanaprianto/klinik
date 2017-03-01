<?php

namespace App\Http\Controllers\PenataJasa\PoliUmum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoliUmumController extends Controller
{
    public function index(){
        return view('poli-umum.index');
    }
}
