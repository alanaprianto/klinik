<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class RoleController extends Controller
{
    public function index(){
        return view('role.index');
    }

    public function getList(){
        $roles = Role::get();
        $datatable = Datatables::of($roles);
        return $datatable->make(true);
    }

    public function getRole(Request $request, $param){
        $role = '';
        $query = $request->query();
        if (($param == 'edit') && $query['id']) {
            $role = Role::find($query['id']);
        }
        return view('role.createEdit', compact(['role']));
    }

    public function postRole(Request $request){
        $input = $request->except('_toke');
        if(isset($input['role_id'])){
            $role = Role::find($input['role_id']);
            $role->update($input);
        }else{
            Role::create($input);
        }

        return redirect('/admin/roles')->with('status', 'Berhasil / Sukses');
    }


    public function deleteRole(){}

}
