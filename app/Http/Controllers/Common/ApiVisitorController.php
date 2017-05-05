<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Patient;
use Illuminate\Http\Request;

class ApiVisitorController extends GeneralController
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
            $input = $request->all();
            $patients = '';
            if(isset($input['poly_id']) && $input['poly_id']){
                $patients = Patient::with(['registers', 'registers.patient', 'registers.staff' ,'registers.references', 'registers.references.medicalRecords' ,'registers.references.doctor', 'registers.references.poly', 'registers.references.medicalRecords'])
                    ->whereHas('registers', function ($query) use($input){
                        $query->whereHas('references', function ($query2) use ($input){
                            $query2->whereHas('poly', function ($query3) use ($input){
                                $query3->where('id', $input['poly_id']);
                            });
                        });
                    })
                    ->get();
            }else{
                $patients = Patient::with(['registers', 'registers.patient', 'registers.staff' ,'registers.references', 'registers.references.doctor', 'registers.references.poly', 'registers.references.medicalRecords'])->get();
            }
            foreach ($patients as $index => $patient){
                $patients[$index]['registersTotal'] = count($patient->registers);
                $reference_total = 0;
                foreach ($patient->registers as $register){
                    $reference_total += count($register->references);
                }
                $patients[$index]['referencesTotal'] = $reference_total;
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['patients' => $patients, 'recordsTotal' => count($patients)]];
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        try {
            $patient = Patient::with(['registers', 'registers.patient', 'registers.staff', 'registers.payments' , 'registers.references', 'registers.references.doctor', 'registers.references.poly'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['patient' => $patient]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
