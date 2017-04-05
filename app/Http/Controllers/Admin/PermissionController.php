<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class PermissionController extends Controller
{
    public function index(){
        return view('permission.index');
    }

    public function getList(){
        $permissions = Permission::get();
        $datatable = Datatables::of($permissions);
        return $datatable->make(true);
    }

    public function getCreateEdit(Request $request, $param){
        $permission = '';
        $query = $request->query();
        if (($param == 'edit') && $query['id']) {
            $permission = Permission::find($query['id']);
        }
        return view('permission.createEdit', compact('permission'));
    }

    public function postModify(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|unique:roles',
            'display_name' => 'required|max:255|unique:roles',
        ]);
        $input = $request->except('_token');
        if(isset($input['permission_id'])){
            $role = Permission::find($input['permission_id']);
            $role->update($input);
        }else{
            Permission::create($input);
        }

        return redirect('/admin/permissions')->with('status', 'Berhasil / Sukses');
    }
}
