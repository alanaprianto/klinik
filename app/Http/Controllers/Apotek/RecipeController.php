<?php

namespace App\Http\Controllers\Apotek;

use App\Inventory;
use App\Recipe;
use App\Reference;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class RecipeController extends Controller
{
    public function index()
    {
        return view('recipe.index');
    }

    public function getCreateEdit(Request $request, $param)
    {
        $id = $request->query('id');
        $input = $request->except('_token');

        $record_apotek = '';
        if ($id && ($param == 'edit')) {
            $record_apotek = Pharmacy::find($id);
            $record_apotek->update($input);
        }

        $inventories = Inventory::get();
        return view('recipe.createEdit', compact(['record_apotek', 'inventories']));
    }

    public function getList(){
        $recipes = Recipe::with(['reference', 'reference.poly', 'reference.register', 'reference.register.patient' ,'pharmacySellers', 'staff'])->get();
        $datatable = Datatables::of($recipes);
        return $datatable->make(true);
    }

    public function getInventory(Request $request)
    {
        $respone = [];
        try {
            $input = $request->except('_token');
            $inventory = Inventory::find($input['id']);
            if ($inventory) {
                $respone = ['isSuccess' => true, 'message' => 'Data Ada', 'data' => $inventory];
            } else {
                $respone = ['isSuccess' => true, 'message' => null, 'data' => $inventory];
            }
        } catch (\Exception $exception) {
            $respone = ['isSuccess' => true, 'message' => $exception->getMessage(), 'data' => null];
        }

        return collect($respone);
    }

    public function postAjaxReference(Request $request)
    {
        $respone = [];
        try {
            $input = $request->except('_token');
            $reference = Reference::with(['register', 'register.patient'])->where('number_reference', $input['number_reference'])->first();
            if ($reference) {
                $respone = ['isSuccess' => true, 'message' => 'Data Ada', 'data' => $reference];
            } else {
                $respone = ['isSuccess' => true, 'message' => 'Data tidak ada', 'data' => $reference];
            }
        } catch (\Exception $e) {
            $respone = ['isSuccess' => false, 'message' => $e->getMessage(), 'data' => null];
        }

        return collect($respone);
    }

    public function postCreate(Request $request)
    {
        $input = $request->except('_token');
        if ($input['reference_id']) {
            $recipe = Recipe::create([
                'reference_id' => $input['reference_id'],
                'number_recipe' => Carbon::now()->format('YmdHis'),
                'staff_id' => Auth::user()->staff->id
            ]);


            foreach ($input['name_tuslah'] as $index => $name){
                $recipe->tuslahs()->create([
                    'name' => $name,
                    'amount' => $input['tuslah'][$index],
                    'price' => $input['price'][$index]
                ]);
            }


            foreach ($input['inventory'] as $index => $item) {
                $inventory = Inventory::find($item);
                $total = $inventory->price * $input['amount'][$index];
                $recipe->pharmacySellers()->create([
                    'inventory_id' => $inventory->id,
                    'amount' => $input['amount'][$index],
                    'total_payment' => $total,
                    'staff_id' => Auth::user()->staff->id,
                    'status' => 1
                ]);
                $inventory->total = $inventory->total - $input['amount'][$index];
                $inventory->save();
            }
        } else {

        }

        return redirect('/apotek/resep')->with('status', 'Berhasil / Success');
    }

    public function getDetail($id){
        $recipe = Recipe::with(['reference', 'reference.register', 'reference.register.patient', 'staff', 'pharmacySellers', 'pharmacySellers.inventory', 'tuslahs'])->find($id);
        $total_payment = 0;
        $total_tuslah = 0;
        foreach ($recipe->pharmacySellers as $pharmacySeller){
            $total_payment += $pharmacySeller->total_payment;
        }

        foreach ($recipe->tuslahs as $tuslah){
            $total_tuslah += ($tuslah->amount * $tuslah->price);
        }
        return view('recipe.detail', compact(['recipe', 'total_payment', 'total_tuslah']));
    }

    public function getPrice(){
        $setting = Setting::where('name','racik')->orWhere('id', 1)->first();
        return $setting->name_value['price'];
    }
}
