<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class InventoryController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        return view('Common::inventory.index', compact('role'));
    }

    public function indexMedicine(){
        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        return view('Common::inventory.indexMedicine', compact('role'));
    }

    public function getList(Request $request){
        if($request->query('type') == 'medis'){
            $inventory = Inventory::with(['batches'])->where('category', 'Medis')->get();
        } elseif ($request->query('type') == 'non_medis'){
            $inventory = Inventory::with(['batches'])->where('category', 'Non Medis')->get();
        } else{
            $inventory = Inventory::with(['batches'])->get();
        }
        $datatable = Datatables::of($inventory);

        return $datatable->make(true);
    }

    public function getCreateEdit(Request $request, $param){
        $id = $request->query('id');
        $inventory = '';
        if(($param == 'edit') && $id){
            $inventory = Inventory::find($id);
        }
        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        return view('Common::inventory.createEdit', compact('inventory','role'));
    }

    public function getCreateEditMedicine(Request $request, $param){
        $id = $request->query('id');
        $inventory = '';
        if(($param == 'edit') && $id){
            $inventory = Inventory::find($id);
        }
        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        return view('Common::inventory.createEditMedicine', compact('inventory','role'));
    }

    public function store(Request $request){
        $input = $request->except(['_token']);
        if($input['inventory_id']){
            $inventory = Inventory::find($input['inventory_id']);
            $inventory->update($input);
        }else{
            $inventory = Inventory::create($input);
            if($input['category'] == 'Medis'){
                $inventory->batches()->create([
                    'code' => $input['batch_code'],
                    'expired_date' => $input['expired_date'],
                    'stock' => $input['total']
                ]);
            }
        }

        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        $redirect = 'obat';
        if($input['category'] == 'Non Medis'){
            $redirect = 'inventory';
        }

        return redirect('/'.$role.'/'.$redirect)->with('status', 'Berhasil / Success');
    }

    public function delete(Request $request){
        $id = $request['id'];
        $inventory = Inventory::find($id);
        $inventory->delete();

        $user = Auth::user();
        $role = 'admin';
        if($user->hasRole('apotek')){
            $role = 'apotek';
        }
        return redirect('/'.$role.'/inventory')->with('status', 'Behasil / Success');
    }
}
