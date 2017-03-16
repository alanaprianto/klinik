<?php

namespace App\Http\Controllers\Admin;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class DoctorServiceController extends Controller
{
    public function index(){
        return view('doctorService.index');
    }

    public function getList(){
        $doctors = Staff::whereHas('staffJob', function ($q){
            $q->where('name', 'Dokter');
        })->get();
        $datatables = Datatables::of($doctors);
        return $datatables->make(true);
    }

    public function getEdit($id){
        $doctor = Staff::with(['staffJob', 'staffPosition', 'doctorService'])->find($id);
        return view('doctorService.edit', compact('doctor'));
    }

    public function postEdit(Request $request){
        $input = $request->except('_token');
        $doctor = Staff::with(['doctorService'])->find($input['staff_id']);
        $doctor->doctorService()->updateOrCreate($input);
        return redirect('/admin/jasa-dokter')->with('status', 'Berhasil mengubah data');
    }
}
