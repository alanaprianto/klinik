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

                    $input['status'] = 1;
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
                    $for_input = [
                        'type' => 2,
                        'status' => 1,
                        'from_depo_id' => $from_depo->id,
                        'to_depo_id' => $to_depo->id,
                        'number_transaction' => 'TRF_'.Carbon::now()->format('YmdHis'),
                    ];

                    $transaction = $this->createTransactionRecord($for_input);

                    foreach ($input['data'] as $data){
/*                        $data = json_decode($data, true);*/
                        $stock_from_depo = Stock::where('depo_id', $from_depo->id)->where('inventory_id', $data['inventory_id'])->first();
                        $stock_from_depo->update([
                            'stock' => $stock_from_depo->stock - $data['amount']
                        ]);
                        $stock_to_depo = Stock::where('depo_id', $to_depo->id)->where('inventory_id', $data['inventory_id'])->first();
                        if($stock_to_depo){
                            $stock_to_depo->update([
                                'stock' => $stock_to_depo + $data['amount']
                            ]);
                        }else{
                            Stock::create([
                                'stock' => $data['amount'],
                                'inventory_id' => $data['inventory_id'],
                                'depo_id' => $to_depo->id
                            ]);
                        }
                        $transaction->itemOrders()->create($data);
                    }

                    $transactions = Transaction::with(['itemOrders'])->find($transaction->id);
                    break;
                case 3 :
                    /*case POS*/
                    if(isset($input['patient_id']) && $input['patient_id']){
                        $patient = Patient::find($input['patient_id']);
                        if($patient){
                            $input['patient_id'] = $patient->id;
                        }
                    }else{
                        $data_user = [
                            'name' => isset($input['name']) && $input['name'] ? $input['name'] : null,
                            'number_phone' => isset($input['number_phone']) && $input['number_phone'] ? $input['number_phone'] : null
                        ];
                        return $data_user;
                        $input['other'] = json_encode($data_user, true);
                    }

                    foreach ($input['data'] as $data){

                    }
/*                    foreach ($input['inventory_id'] as $index => $inventory_id){
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
                    }*/

                    break;
                case 4:
                    /*case receive order*/
                    $transaction = Transaction::where('number_transaction', $input['number_transaction'])->first();
                    $transaction->update(['status' => 3]);
                    $parent_depo = Depo::where('name', 'primary_depo')->first();
                    $input['to_depo_id'] = $parent_depo->id;
                    $input['staff_id'] = Staff::where('user_id', Auth::user()->id)->first()->id;
                    $ro_transaction = $transaction->childs()->create($input);
                    foreach ($input['data'] as $data){
/*                        $data = json_decode($data, true);*/
                        $ro_transaction->itemOrders()->create($data);

                        $inventory = Inventory::find($data['inventory_id']);
                        $inventory->update([
                            'purchase_price' => $data['price']
                        ]);

                        $stock = Stock::where('inventory_id', $data['inventory_id'])->where('depo_id', $parent_depo->id)->first();
                        if($stock){
                            $stock->update([
                                'stock' => $stock->stock + $data['amount'],
                                'total_stock' => $stock->total_stock + + $data['amount']
                            ]);
                        }else{
                            $inventory->stocks()->create([
                                'stock' => $data['amount'],
                                'depo_id' => $parent_depo->id
                            ]);
                        }
                    }
                    $transactions = Transaction::with(['childs'])->where('number_transaction', $input['number_transaction'])->first();
                    break;
                default :
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['transactions' => $transactions]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
