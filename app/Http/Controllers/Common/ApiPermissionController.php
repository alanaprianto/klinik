<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Permission;
use Illuminate\Http\Request;

class ApiPermissionController extends GeneralController
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
            $permissions = $this->getPermissions();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permissions' => $permissions]];
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
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
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
            $permission = Permission::create($input);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permission' => $permission]];
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
            $permission = Permission::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permission' => $permission]];
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
            $permission = Permission::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permission' => $permission]];
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
            $permission = Permission::find($id);
            $permission->update($input);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['permission' => $permission]];
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
            $permission = Permission::find($id);
            $permission->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
    }
}
