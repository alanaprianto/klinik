<?php

namespace App\Http\Controllers\Apotek;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApotekController extends Controller
{
    public function index(){
        return view('home');
    }
}
