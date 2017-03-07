<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class VisitorController extends Controller
{
    public function index()
    {
        return view('Common::visitor.index');
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
        foreach ($patient->registers as $register){
            $counts +=  count($register->references);
        }
        return view('Common::visitor.detail', compact('patient', 'counts'));
    }
}
