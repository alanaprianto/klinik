<?php

namespace App\Http\Controllers\Kasir;

use App\Patient;
use App\Payment;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function getList()
    {
        $registers = Register::with(['payments', 'patient'])->get();
        foreach ($registers as $register){
            $register['full_payment_status'] = 2;
            foreach ($register->payments as $payment){
                if($payment->status == 1){
                    $register['full_payment_status'] = 1;
                    break;
                }
            }
        }
        $datatable = Datatables::of($registers);
        return $datatable->make(true);
    }

    public function getPayment($id)
    {
        $payments = Payment::with(['reference', 'reference.medicalRecords','reference.medicalRecords.service' ,'reference.poly', 'register', 'register.patient'])->where('register_id', $id)->get();
        $patient = Patient::whereHas('registers', function ($q) use ($id) {
            $q->where('id', $id);
        })->first();
        $total_payment = 0;
        $remaining = 0;
        foreach ($payments as $payment) {
            if ($payment->status == 1) {
                $remaining += $payment->total;
            }
            $total_payment += $payment->total;
        }
        return view('payment.payment', compact(['payments', 'patient', 'total_payment', 'id', 'remaining']));
    }

    public function postPayment(Request $request){
        $inputs = $request->except(['_token']);
        foreach ($inputs as $index => $input){
            $payment = Payment::find($index);
            $payment->update([
                'status' => 2
            ]);
        }
        return redirect('/kasir/pembayaran')->with('status', 'Berhasil memperbarui pembayaran');
    }
}
