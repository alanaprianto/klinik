<?php

namespace App\Http\Controllers\Common;

use App\Inventory;
use App\Reference;
use App\Register;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCheckupInpatientController extends Controller
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
            $registers = Register::with(['patient','references', 'references.classRoom', 'references.room', 'references.bed'])->where('type', 1)->get();
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
    public function create()
    {
        //
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
            $reference = Reference::find($input['reference_id']);
            $grand_total_payment = 0;
            foreach ($input['data_service'] as $data) {
                $data = json_decode($data, true);
                $service = Service::find($data['service_id']);
                $total_payments = $service->cost * $data['amount'];
                /*create medical record*/
                $medical_record = $reference->medicalRecords()->create([
                    'type' => 'medical_record_service',
                    'service_id' => $data['service_id'],
                    'quantity' => $data['amount']
                ]);

                $medical_record->staff()->sync([$data['staff_id']]);

                /*create payment*/
                $reference->payments()->create([
                    'total' => $total_payments,
                    'type' => 'medical_record_service',
                    'status' => 0,
                    'service_id' => $data['service_id'],
                    'quantity' => $data['amount']
                ]);
                $grand_total_payment += $total_payments;
            }

            foreach ($input['data_medicine'] as $data) {
                $data = json_decode($data, true);
                $inventory = Inventory::find($data['inventory_id']);
                $total_payments = $inventory->purchase_price * $data['amount'];
                $medical_record = $reference->medicalRecords()->create([
                    'type' => 'medical_record_medicine',
                    'inventory_id' => $data['inventory_id'],
                    'quantity' => $data['amount']
                ]);

                $medical_record->staff()->sync([$data['staff_id']]);
                /*create payment*/
                $reference->payments()->create([
                    'total' => $total_payments,
                    'type' => 'medical_record_medicine',
                    'status' => 0,
                    'inventory_id' => $data['inventory_id'],
                    'quantity' => $data['amount']
                ]);
                $grand_total_payment += $total_payments;
            }

            $reference = Reference::with(['register', 'medicalRecords', 'classRoom', 'room', 'bed'])->find($reference->id);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['reference' => $reference]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }


    public function transferPatient(Request $request){
        $response = [];
        try {
            $input = $request->all();
            $reference = Reference::find($input['reference_id']);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
