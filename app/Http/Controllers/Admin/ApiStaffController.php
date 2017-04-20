<?php

namespace App\Http\Controllers\Admin;

use App\Hospital;
use App\Http\Controllers\GeneralController;
use App\Staff;
use App\StaffJob;
use App\StaffPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiStaffController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try {
            $staff = Staff::get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff, 'recordsTotal' => count($staff)]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = [];
        try {
            $staffjobs = $this->getStaffJobs();
            $staffpositions = StaffPosition::has('staff', '<', 1)->get();
            $staffpositions['recordsTotal'] = count($staffpositions);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staffjobs' => $staffjobs, 'staffpositions' => $staffpositions]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();

            $input['hospital_id'] = $this->getHospital()->id;
            $staffjob = StaffJob::find($input['staff_job_id']);
            $staffposition = StaffPosition::find($input['staff_position_id']);

            $staff = Staff::create($input);
            $staff->attachStaffjob($staffjob);
            $staff->attachStaffposition($staffposition);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        try {
            $staff = Staff::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = [];
        try {
            $staff = Staff::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = [];
        try {
            $input = $request->all();

            $input['hospital_id'] = $this->getHospital()->id;
            $staffjob = StaffJob::find($input['staff_job_id']);
            $staffposition = StaffPosition::find($input['staff_position_id']);

            $staff = Staff::find($id);
            $staff->attachStaffjob($staffjob);
            $staff->attachStaffposition($staffposition);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['staff' => $staff]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = [];
        try {
            $staff = Staff::find($id);
            $staff->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
