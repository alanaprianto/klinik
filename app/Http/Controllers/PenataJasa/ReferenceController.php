<?php

namespace App\Http\Controllers\PenataJasa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenceController extends Controller
{
    public function index(){
        return view('reference.index');
    }
}
