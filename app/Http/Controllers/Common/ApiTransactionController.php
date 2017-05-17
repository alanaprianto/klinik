<?php

namespace App\Http\Controllers\Common;

use App\Depo;
use App\Distributor;
use App\Inventory;
use App\Patient;
use App\Staff;
use App\Stock;
use App\Transaction;
use Carbon\Carbon;
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
                $transactions = Transaction::with(['staff', 'distributor', 'itemOrders'])->where('type', $request['type'])->paginate(25);
            } else {
                $transactions = Transaction::with(['staff', 'distributor', 'itemOrders'])->paginate(25);
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
        $new_transaction = Transaction::with(['staff', 'from', 'to', 'distributor', 'patient', 'itemOrders'])->find($transaction->id);
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
                    $parent_depo = Depo::where('name', 'primary_depo')->first();
                    $input['status'] = 1;
                    $input['to_depo_id'] = $parent_depo->id;
                    $input['number_transaction'] = 'PO_'.Carbon::now()->format('YmdHis');
                    $transaction = $this->createTransactionRecord($input);
                    $new_input = $request->all();
                    foreach ($new_input['data'] as $data){
                        $transaction->itemOrders()->create($data);
                    }

                    $transactions = Transaction::with(['itemOrders'])->find($transaction->id);
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

                        array_push($transactions, $this->createTransactionRecord($for_input));
                    }

                    break;
                case 3 :
                    if($input['patient_id']){
                        $patient = Patient::find($input['patient_id']);
                        if($patient){
                            $input['patient_id'] = $patient->id;
                        }
                    }else{
                        $data_user = [
                            'name' => $input['name'] ? $input['name'] : null,
                            'number_phone' => $input['number_phone'] ? $input['number_phone'] : null
                        ];
                        $input['other'] = json_encode($data_user, true);
                    }

                    foreach ($input['inventory_id'] as $index => $inventory_id){
                        $inventory = Inventory::find($inventory_id);
                        $stock = Stock::where('inventory_id', $inventory_id)->first();
                        $stock->update([
                            'stock' => $stock->stock - $input['amount'][$index]
                        ]);

                        $depo = Depo::with([
                            'inventories' => function($q) use($inventory_id){
                            $q->where('inventories_id', $inventory_id);
                        }, 'stocks' => function($q) use($inventory_id){
                            $q->where('inventory_id', $inventory_id);
                        }
                        ])->whereHas('inventories', function ($q1) use ($inventory_id){
                           $q1->where('inventories_id', $inventory_id);
                        })->first();

                        $for_input = [
                            'patient_id' => $input['patient_id'],
                            'type' => $input['type'],
                            'amount' => $input['amount'][$index],
                            'status' => 1,
                            'price' => $input['amount'][$index] * $stock->price,
                            'from_depo_id' => $depo->id,
                            'other' => $input['other']
                        ];
                        array_push($transactions, $this->createTransactionRecord($for_input));
                    }

                    break;
                default :
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['transactions' => $transactions]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function receiveOrder(Request $request){
        $response = [];
        try {
            $input = $request->all();
            $transaction = Transaction::where('number_transaction', $input['number_transaction'])->first();
            $test = $transaction->childs()->create($input);
            return $test;

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
