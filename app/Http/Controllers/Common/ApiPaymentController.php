<?php

namespace App\Http\Controllers\Common;

use App\Patient;
use App\Payment;
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
            $registers = Register::with(['payments', 'payments.register' , 'payments.reference', 'payments.reference.medicalRecords', 'payments.reference.medicalRecords.service', 'patient'])->has('payments')->get();
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
            $payments = Payment::with(['reference', 'reference.medicalRecords', 'reference.medicalRecords.service', 'reference.poly', 'register', 'register.patient'])->where('register_id', $request['register_id'])->get();
            $patient = Patient::whereHas('registers', function ($q) use ($request) {
                $q->where('id', $request['register_id']);
            })->first();
            $total_payment = 0;
            $remaining = 0;

            foreach ($payments as $payment) {
                if ($payment->status == 1) {
                    $remaining += $payment->total;
                }
                $total_payment += $payment->total;
            }

            $payments['recordsTotal'] = count($payments);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['payments' => $payments, 'patient' => $patient, 'total_payment' => $total_payment, 'remaining' => $remaining]];
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
            $inputs = $request->all();
            $payment = '';
            foreach ($inputs as $index => $input){
                $payment = Payment::find($index);
                $payment->update([
                    'status' => 2
                ]);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['payment' => $payment]];

        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
