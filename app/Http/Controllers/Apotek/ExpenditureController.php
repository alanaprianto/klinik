<?php

namespace App\Http\Controllers\Apotek;

use App\Inventory;
use App\Patient;
use App\Pharmacy;
use App\Recipe;
use App\Reference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller
{
    public function index()
    {
        return view('expenditure.index');
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
        return view('expenditure.createEdit', compact(['record_apotek', 'inventories']));
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
            }
        } else {

        }

        return redirect('/apotek/pengeluaran')->with('status', 'Berhasil / Success');
    }
}
