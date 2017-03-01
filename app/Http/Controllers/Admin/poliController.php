<?php

namespace App\Http\Controllers\admin;

use App\Poly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class poliController extends Controller
{
    public function index()
    {
        return view('poli.index');
    }

    public function getPoli(Request $request, $param)
    {
        $poli = '';
        $query = $request->query();

        if (($param == 'edit') && $query['id']) {

            $poli =Poly::find($query['id']);

        }
        return view('poli.createEdit', compact(['poli']));
    }

    public function postPoli(Request $request)
    {
        $input = $request->except(['_token']);


        if (isset($input['poli_id'])) {
            ;
            $poli = Poly::find($input['poli_id']);
            $poli->update($input);
        } else {
            $poli = Poly::create($input);
        }
        return redirect('admin/poli')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $poli = Poly::get();
        $datatable = Datatables::of($poli);
        return $datatable->make(true);
    }

    public function deletePoli(Request $request)
    {
        $poli = Poly::find($request['id']);
        $poli->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
