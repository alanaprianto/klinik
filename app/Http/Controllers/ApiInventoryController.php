<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiInventoryController extends Controller
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
            if ($request['type'] && ($request['type'] == 'medicine')) {
                $inventories = Inventory::with(['batches'])->where('category', 'medicine')->get();
            } elseif ($request['type'] && ($request['type'] == 'non_medicine')) {
                $inventories = Inventory::with(['batches'])->where('category', 'non_medicine')->get();
            } else {
                $inventories = Inventory::get();
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventories' => $inventories, 'recordsTotal' => count($inventories)]];
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
            $inventory = Inventory::create($input);
            if($input['category'] == 'medicine'){
                $inventory->batches()->create([
                    'code' => $input['batch_code'],
                    'expired_date' => $input['expired_date'],
                    'stock' => $input['stock']
                ]);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventory' => $inventory]];
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
            $inventory = Inventory::with('batches')->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventory' => $inventory]];
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
            $inventory = Inventory::with('batches')->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventory' => $inventory]];
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
            $inventory = Inventory::find($id);
            $inventory->update($input);
            if($input['category'] == 'medicine'){
                $inventory->batches()->create([
                    'code' => $input['batch_code'],
                    'expired_date' => $input['expired_date'],
                    'stock' => $input['total']
                ]);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventory' => $inventory]];
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
            $inventory = Inventory::find($id);
            $inventory->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);

    }
}
