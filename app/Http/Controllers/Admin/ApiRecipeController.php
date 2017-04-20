<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GeneralController;
use App\Inventory;
use App\Recipe;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiRecipeController extends GeneralController
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
            $recipes = Recipe::with(['reference', 'reference.poly', 'reference.register', 'reference.register.patient', 'pharmacySellers', 'staff', 'buyer'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['recipes' => $recipes]];

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
            $inventories = $this->getInventories();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['inventories' => $inventories]];
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
            $recipe = '';
            if ($input['reference_id']) {
                $recipe = Recipe::create([
                    'reference_id' => $input['reference_id'],
                    'number_recipe' => Carbon::now()->format('YmdHis'),
                    'staff_id' => Auth::user()->staff->id
                ]);
                foreach ($input['name_tuslah'] as $index => $name) {
                    $recipe->tuslahs()->create([
                        'name' => $name,
                        'amount' => $input['tuslah_amount'][$index],
                        'price' => $input['price'][$index]
                    ]);
                }
            } else {
                $recipe = Recipe::create([
                    'number_recipe' => Carbon::now()->format('YmdHis'),
                    'staff_id' => Auth::user()->staff->id
                ]);
                $recipe->buyer()->create($input);
            }

            foreach ($input['inventory'] as $index_inventory => $item_inventory) {
                $inventory = Inventory::find($item_inventory);
                $total = $inventory->price * $input['amount'][$index_inventory];
                $recipe->pharmacySellers()->create([
                    'inventory_id' => $inventory->id,
                    'amount' => $input['amount'][$index_inventory],
                    'total_payment' => $total,
                    'staff_id' => Auth::user()->staff->id,
                    'status' => 1
                ]);
                $inventory->total = $inventory->total - $input['amount'][$index_inventory];
                $inventory->save();
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['recipe' => $recipe]];
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

            $recipe = Recipe::with(['reference', 'reference.register', 'reference.register.patient', 'staff', 'pharmacySellers', 'pharmacySellers.inventory', 'tuslahs'])->find($id);
            $total_payment = 0;
            $total_tuslah = 0;
            foreach ($recipe->pharmacySellers as $pharmacySeller) {
                $total_payment += $pharmacySeller->total_payment;
            }
            foreach ($recipe->tuslahs as $tuslah) {
                $total_tuslah += ($tuslah->amount * $tuslah->price);
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['recipe' => $recipe, 'total_payment' => $total_payment, 'total_tuslah' => $total_tuslah]];
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
