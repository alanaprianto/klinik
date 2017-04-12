<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class VisitorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = 'admin';
        if ($user->hasRole('admin')) {
            $role = 'admin';
        } elseif ($user->hasRole('loket')) {
            $role = 'loket';
        } elseif ($user->hasRole('kasir')){
            $role = 'kasir';
        } elseif ($user->hasRole('apotek')){
            $role = 'apotek';
        } else{
            $role = 'penata-jasa';
        }


        return view('Common::visitor.index', compact('role'));
    }

    public function getList()
    {
        $patient = Patient::with(['registers', 'registers.patient', 'registers.staff', 'registers.references'])->get();
        $datatable = Datatables::of($patient);
        return $datatable->make(true);
    }

    public function getDetail($id)
    {
        $patient = Patient::with(['registers', 'registers.patient', 'registers.staff', 'registers.references', 'registers.references.doctor', 'registers.references.poly'])->find($id);
        $counts = 0;
        foreach ($patient->registers as $register) {
            $counts += count($register->references);
        }

        $user = Auth::user();
        $role = 'admin';
        if ($user->hasRole('admin')) {
            $role = 'admin';
        } elseif ($user->hasRole('loket')) {
            $role = 'loket';
        } elseif ($user->hasRole('kasir')){
            $role = 'kasir';
        } elseif ($user->hasRole('apotek')){
            $role = 'apotek';
        } else{
            $role = 'penata-jasa';
        }
        return view('Common::visitor.detail', compact('patient', 'counts', 'role'));
    }
}
