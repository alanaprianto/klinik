<?php

namespace App\Http\Controllers\admin;

use App\Hospital;
use App\Staff;
use App\StaffJob;
use App\StaffPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        $staffpositions = StaffPosition::has('staff', '<', 1)->get();

        if (($param == 'edit') && $query['id']) {


            $staff = Staff::with(['staffJob', 'staffposition'])->find($query['id']);
        }
        return view('staff.createEdit', compact(['staff', 'staffjobs', 'staffpositions']));
    }

    public function postStaff(Request $request)
    {
        $input = $request->except(['_token']);

        $hospital = DB::table('hospitals')->Where('name', 'Rumah Sakit A')->first();
        $staffjob = StaffJob::find($input['staffjob']);
        $staffposition = StaffPosition::find($input['staffposition']);
        $input['hospital_id'] = $hospital->id;
        $input['staff_job_id'] = $staffjob->id;

        if (isset($input['staff_id'])) {


            if ($input['staff_id']) {

                $staff = Staff::find($input['staff_id']);

                $staff->update($input);

            } else {


                $staff = Staff::create($input);
                $staff->attachStaffjob($staffjob);
                $staff->attachStaffposition($staffposition);
            }

            return redirect('admin/staff')->with('status', 'Success / Berhasil');
        }
    }

    public
    function getList()
    {
        $staff = Staff::with(['staffJob', 'staffPosition'])->get();
        $datatable = Datatables::of($staff);
        return $datatable->make(true);
    }

    public
    function deleteStaff(Request $request)
    {
        $staff = Staff::find($request['id']);
        $staff->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
