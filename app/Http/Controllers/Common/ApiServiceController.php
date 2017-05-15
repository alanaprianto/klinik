<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Service;
use Illuminate\Http\Request;

class ApiServiceController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if(isset($input['category_service_id']) && $input['category_service_id']){
                $services = Service::with(['medicalRecords', 'inventories', 'categoryService'])
                    ->whereHas('categoryService', function ($q)use($input){
                        $q->where('id', $input['category_service_id']);
                    })->get();
            }else{
                $services = Service::with(['medicalRecords', 'inventories', 'categoryService'])->get();
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['services' => $services, 'recordsTotal' => count($services)]];
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
            $service = '';
            if(isset($input['service_id']) && $input['service_id']){
                $service = Service::update($input);
            }else{
                $service = Service::create($input);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['service' => $service]];
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
            $service = Service::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['service' => $service]];
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
            $service = Service::find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['service' => $service]];
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
            $service = Service::find($id);
            $service->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
