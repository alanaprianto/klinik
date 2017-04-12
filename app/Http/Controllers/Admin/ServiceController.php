<?php

namespace App\Http\Controllers\admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('tindakan.index');
    }
    public function getService(Request $request, $param)
    {
        $service = '';
        $query = $request->query();

        if (($param == 'edit') && $query['id']) {

            $service = Service::find($query['id']);

        }
        return view('tindakan.createEdit', compact(['service']));
    }

    public function postService(Request $request)
    {


        $input = $request->except(['_token']);
        $this->validate($request, [
            'name' => 'required|max:255|unique:services',
            'cost' => 'required|max:255|unique:services',
        ]);
        if (isset($input['service_id'])) {
            ;
            $service = Service::find($input['service_id']);
            $service->update($input);
        } else {
            $service = Service::create($input);


        }
        return redirect('admin/tindakan')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $service = Service::get();
        $datatable = Datatables::of($service);
        return $datatable->make(true);
    }

    public function deleteService(Request $request)
    {
        $service = Service::find($request['id']);
        $service->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
