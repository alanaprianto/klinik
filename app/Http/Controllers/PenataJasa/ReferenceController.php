<?php

namespace App\Http\Controllers\PenataJasa;

use App\Poly;
use App\Reference;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class ReferenceController extends Controller
{
    public function index(){
        return view('reference.index');
    }

    public function getList(){
        $user = User::find(Auth::user()->id);
        $poly_umum  = Poly::where('name', 'Poli Umum')->first();
        $poly_anak  = Poly::where('name', 'Poli Anak')->first();
        if($user->hasRole('poli_umum')){
            $references = Reference::with(['register', 'register.patient'])->where('poly_id', $poly_umum->id)->whereNotIn('status', [1])->get();
        }elseif ($user->hasRole('poli_anak')){
            $references = Reference::with(['register', 'register.patient'])->where('poly_id', $poly_anak->id)->get();
        }

        $datatable = Datatables::of($references);
        return $datatable->make(true);
    }

    public function getDetail($id){
        $reference = Reference::with(['register', 'register.patient', 'poly', 'doctor', 'medicalRecords', 'medicalRecords.service'])->find($id);
        return view('reference.detail', compact(['reference']));
    }
}
