<?php

namespace App\Http\Controllers\Apotek;

use App\Inventory;
use App\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenditureController extends Controller
{
    public function index(){
        return view('expenditure.index');
    }

    public function getCreateEdit(Request $request, $param){
        $id = $request->query('id');
        $input = $request->except('_token');

        $record_apotek = '';
        if($id && ($param == 'edit')){
            $record_apotek = Pharmacy::find($id);
            $record_apotek->update($input);
        }

        $inventories = Inventory::get();
        return view('expenditure.createEdit', compact(['record_apotek', 'inventories']));
    }
}
