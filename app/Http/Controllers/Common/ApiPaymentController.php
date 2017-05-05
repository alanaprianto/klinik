<?php

namespace App\Http\Controllers\Common;

use App\Patient;
use App\Payment;
use App\Reference;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPaymentController extends Controller
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
            $registers = Register::with(['patient','references', 'paymentHistories' ,'references.poly', 'references.payments', 'references.payments.service', 'references.medicalRecords'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['registers' => $registers, 'recordsTotal' => count($registers)]];
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
    public function create(Request $request)
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
            $register = Register::with(['references', 'references.payments', 'paymentHistories'])->find($input['register_id']);
            $customer_payment = $input['payment'];
            foreach ($register->references as $reference){
                foreach ($reference->payments as $payment){
                    $dept_total = 0;
                    if($payment->status == 0){
                        $dept_total += $payment->total;
                    }
                    $customer_payment -= $dept_total;
                    if($customer_payment >= 0){
                        $payment->update([
                            'status' => 1
                        ]);
                    }
                }
            }

            foreach ($register->references as $reference){
                $reference_payment_status = 1;
                foreach ($reference->payments as $payment){
                    if($payment->status == 0){
                        $reference_payment_status = 0;
                        break;
                    }
                }
                $reference->update([
                    'payment_status' => $reference_payment_status
                ]);
            }

            $register_payment_status = 1;
            foreach ($register->references as $reference){
                if($reference->payment_status == 0){
                    $register_payment_status = 0;
                    break;
                }
            }
            $register->update([
                'payment_status' => $register_payment_status
            ]);

            $register->paymentHistories()->create([
                'payment' => $input['payment']
            ]);

            $register = Register::with(['references', 'references.payments', 'paymentHistories'])->find($input['register_id']);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['register' => $register]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
