<?php

namespace App\Http\Controllers\admin;

use App\Staff;
use App\StaffJob;
use App\StaffPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff.index');
    }
    public function getStaff(Request $request, $param)
    {
        $staff = '';
        $query = $request->query();

        $staffjobs = StaffJob::get();
        $staffpositions = StaffPosition::get();

        if (($param == 'edit') && $query['id']) {

            $staff =Staff::with('staffjobs','staffposition')->find($query['id']);

        }
        return view('staff.createEdit', compact(['staff']));
    }

    public function postStaff(Request $request)
    {
        $input = $request->except(['_token']);

        $staffjob = StaffJob::find($input['staffjob']);
        $staffposition = StaffPosition::find($input['staffposition']);

        if (isset($input['staff_id'])) {
            ;
            $staff = Staff::find($input['staff_id']);
            $staff->update($input);
        } else {
            $staff = Staff::create($input);
        }
        return redirect('admin/staff')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $staff = Staff::get();
        $datatable = Datatables::of($staff);
        return $datatable->make(true);
    }

    public function deleteUser(Request $request)
    {
        $staff = Staff::find($request['id']);
        $staff->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }

}
