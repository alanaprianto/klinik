<?php

namespace App\Http\Controllers\admin;

use App\StaffPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function postStaffjob(Request $request)
    {
        $input = $request->except(['_token']);


        if (isset($input['staffposition_id'])) {
            ;
            $staffposition = StaffPosition::find($input['staffposition_id']);
            $staffposition->update($input);
        } else {
            $staffjob = StaffJob::create($input);
        }
        return redirect('admin/staffjob')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $staffjob = StaffJob::get();
        $datatable = Datatables::of($staffjob);
        return $datatable->make(true);
    }

    public function deleteUser(Request $request)
    {
        $staffjob = StaffJob::find($request['id']);
        $staffjob->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
