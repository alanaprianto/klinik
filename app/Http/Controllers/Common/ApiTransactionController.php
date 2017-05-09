<?php

namespace App\Http\Controllers\Common;

use App\Depo;
use App\Inventory;
use App\Staff;
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
            $transaction = '';
            switch ($input['type']) {
                case 1 :
                    /*case ketika beli dari distributor*/
                    $inventory = Inventory::with(['depos', 'stock'])->find($input['inventory_id']);
                    if ($inventory) {
                        if ($inventory->stock) {
                            $inventory->stock()->update([
                                'amount' => $inventory->stock->amount + $input['amount']
                            ]);
                        } else {
                            $inventory->stock()->create([
                                'amount' => $input['amount']
                            ]);
                        }
                    } else {
                        $inventory = Inventory::create($input);
                        $inventory->depos()->sync($input['to_depo_id']);
                        $inventory->stock()->create($input);
                    }
                    $input['status'] = 1;
                    $input['to_depo_id'] = Depo::where('name', 'primary_depo')->first()->id;
                    $transaction = $this->createTransactionRecord($input);
                    break;
                case 2 :
                    /*case buat transfer stock */
                    $from_depo = Depo::with(['inventories', 'inventories.stock'])->find($input['from_depo_id']);
                    $to_depo = Depo::with(['inventories', 'inventories.stock'])->find($input['to_depo_id']);
                    $form_depo_inventory = $from_depo->inventories()->find($input['inventory_id']);
                    $form_depo_inventory->stock->update([
                        'amount' => $form_depo_inventory->stock->amount - $input['amount']
                    ]);

                    $to_depo_inventory = $to_depo->inventories()->where('parent_id', $input['inventory_id'])->first();
                    if ($to_depo_inventory) {
                        $inventory_selected = Inventory::with('stock')->find($to_depo_inventory->id);
                        if($inventory_selected->stock){
                            $inventory_selected->stock()->update([
                                'amount' => $inventory_selected->stock->amount + $input['amount']
                            ]);
                        }else{
                            $inventory_selected->stock()->create([
                                'amount' => $input['amount']
                            ]);
                        }
                    } else {
                        $form_depo_inventory = $form_depo_inventory->toArray();
                        $form_depo_inventory['parent_id'] = $form_depo_inventory['id'];
                        $to_depo->inventories()->create($form_depo_inventory);
                        $to_depo = Depo::with(['inventories', 'inventories.stock'])->find($input['to_depo_id']);
                        $to_depo_inventory = $to_depo->inventories()->where('parent_id', $input['inventory_id'])->first();
                        if($to_depo_inventory){
                            $inventory_selected = Inventory::with('stock')->find($to_depo_inventory->id);
                            if($inventory_selected->stock){
                                $inventory_selected->stock()->update([
                                    'amount' => $inventory_selected->stock->amount + $input['amount']
                                ]);
                            }else{
                                $inventory_selected->stock()->create([
                                    'amount' => $input['amount']
                                ]);
                            }
                        }
                    }

                    $for_input = [
                        'type' => $input['type'],
                        'amount' => $input['amount'],
                        'status' => 1,
                        'from_depo_id' => $input['from_depo_id'],
                        'to_depo_id' => $input['to_depo_id']
                    ];
                    $transaction = $this->createTransactionRecord($for_input);
                    break;
                case 3 :
                    return $input;
                    break;
                default :
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['transaction' => $transaction]];
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
