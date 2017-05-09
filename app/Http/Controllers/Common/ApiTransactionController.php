<?php

namespace App\Http\Controllers\Common;

use App\Depo;
use App\Inventory;
use App\Staff;
use App\Stock;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiTransactionController extends Controller
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
            if ($request['type']) {
                $transactions = Transaction::where('type', $request['type'])->paginate(25);
            } else {
                $transactions = Transaction::paginate(25);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['transactions' => $transactions, 'recordsTotal' => count($transactions)]];
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
        //
    }

    private function createTransactionRecord($input)
    {
        $staff = Staff::where('user_id', Auth::user()->id)->first();
        $input['staff_id'] = $staff->id;
        $transaction = Transaction::create($input);
        $new_transaction = Transaction::with(['staff', 'from', 'to', 'distributor', 'patient'])->find($transaction->id);
        return $new_transaction;
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
            $transactions = [];
            switch ($input['type']) {
                case 1 :
                    /*case ketika beli dari distributor*/
                    foreach ($input['inventory_id'] as $index => $inventory_id) {
                        $inventory = Inventory::with(['depos'])->find($inventory_id);
                        $depo =  $inventory->depos()->where('name', 'primary_depo')->first();
                        $stock = Stock::where('inventory_id', $inventory->id)->first();
                        if($stock){
                            $stock->update([
                                'stock' => $stock->stock + $input['amount'][$index],
                                'price' => $input['price'][$index]
                            ]);
                        }else{
                            $inventory->stocks()->create([
                                'stock' => $input['amount'][$index],
                                'price' => $input['price'][$index],
                                'depo_id' => $depo->id
                            ]);
                        }
                        $input['to_depo_id'] = $depo->id;
                        $for_input = [
                            'distributor_id' => $input['distributor_id'],
                            'type' => $input['type'],
                            'amount' => $input['amount'][$index],
                            'status' => 1,
                            'to_depo_id' => $depo->id
                        ];
                        array_push($transactions, $this->createTransactionRecord($for_input));
                    }
                    break;
                case 2 :
                    /*case buat transfer stock */
                    $from_depo = Depo::with(['inventories', 'stocks'])->find($input['from_depo_id']);
                    $to_depo = Depo::with(['inventories', 'stocks'])->find($input['to_depo_id']);
                    foreach ($input['inventory_id'] as $index => $inventory_id ){
                        $to_depo->inventories()->sync([$inventory_id]);
                        $to_depo = Depo::with(['inventories', 'stocks'])->find($input['to_depo_id']);
                        $stock = Stock::where('inventory_id', $inventory_id)->where('depo_id', $to_depo->id)->first();
                        if($stock){
                            $stock->update([
                                'stock' => $stock->stock + $input['amount'][$index],
                                'price' => $input['price'][$index],
                            ]);
                        }else{
                            $to_depo->stocks()->create([
                                'stock' => $input['amount'][$index],
                                'inventory_id' => $inventory_id,
                                'price' => $input['price'][$index],
                            ]);
                        }

                        $for_input = [
                            'type' => $input['type'],
                            'amount' => $input['amount'][$index],
                            'status' => 1,
                            'price' => $input['price'][$index],
                            'from_depo_id' => $from_depo->id,
                            'to_depo_id' => $to_depo->id
                        ];

                        $transactions = $this->createTransactionRecord($for_input);
                    }

                    break;
                case 3 :

                    break;
                default :
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['transactions' => $transactions]];
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
        //
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
