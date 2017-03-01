<?php

namespace App\Http\Controllers\admin;

use App\StaffJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffjobController extends Controller
{
    public function index()
    {
        return view('staffjob.index');
    }
    public function getStaffjob(Request $request, $param)
    {
        $staffjob = '';
        $query = $request->query();

        if (($param == 'edit') && $query['id']) {

            $staffjob =StaffJob::find($query['id']);

        }
        return view('staffjob.createEdit', compact(['staffjob']));
    }

    public function postStaffjob(Request $request)
    {
        $input = $request->except(['_token']);


        if (isset($input['staffjob_id'])) {
            ;
            $staffjob = StaffJob::find($input['staffjob_id']);
            $staffjob->update($input);
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
