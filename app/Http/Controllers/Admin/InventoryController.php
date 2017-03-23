<?php

namespace App\Http\Controllers\Admin;

use App\Batch;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class InventoryController extends Controller
{
    public function index(){
        return view('inventory.index');
    }

    public function getList(){
        $inventory = Inventory::with(['batches'])->get();
        $datatable = Datatables::of($inventory);
        return $datatable->make(true);
    }

    public function getCreateEdit(Request $request, $param){
        $id = $request->query('id');
        $inventory = '';
        $batches = Batch::get();
        if(($param == 'edit') && $id){
            $inventory = Inventory::find($id);
        }

        return view('inventory.createEdit', compact('inventory','batches'));
    }

    public function store(Request $request){
        $input = $request->except(['_token']);
        if($input['inventory_id']){
            $inventory = Inventory::find($input['inventory_id']);
            $inventory->update($input);
        }else{
            $inventory = Inventory::create($input);
        }

        return redirect('/admin/inventory')->with('status', 'Berhasil / Success');
    }

    public function delete(Request $request){
        $id = $request['id'];
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect('/admin/inventory')->with('status', 'Behasil / Success');
    }
}
