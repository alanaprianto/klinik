<?php

namespace App\Http\Controllers\admin;

use App\StaffPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class StaffpositionController extends Controller
{
    public function index()
    {
        return view('staffposition.index');
    }
    public function getStaffposition(Request $request, $param)
    {
        $staffposition = '';
        $query = $request->query();

        if (($param == 'edit') && $query['id']) {

            $staffposition =StaffPosition::find($query['id']);

        }
        return view('staffposition.createEdit', compact(['staffposition']));
    }

    public function postStaffposition(Request $request)
    {
        $input = $request->except(['_token']);


        if (isset($input['staffposition_id'])) {
            ;
            $staffposition = StaffPosition::find($input['staffposition_id']);
            $staffposition->update($input);
        } else {
            $staffposition= StaffPosition::create($input);
        }
        return redirect('admin/staffposition')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $staffposition = StaffPosition::get();
        $datatable = Datatables::of($staffposition);
        return $datatable->make(true);
    }

    public function deleteStaffposition(Request $request)
    {
        $staffposition = StaffPosition::find($request['id']);
        $staffposition->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
