<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
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
            $role = Role::with(['perms'])->find($query['id']);
        }
        $permissions = Permission::get();
        return view('role.createEdit', compact(['role', 'permissions']));
    }

    public function postRole(Request $request){
        $input = $request->except('_token');
        if(isset($input['role_id'])){
            $this->validate($request, [
                'name' => 'required|max:255',
                'display_name' => 'required|max:255',
            ]);
        } else{
            $this->validate($request, [
                'name' => 'required|max:255|unique:roles',
                'display_name' => 'required|max:255|unique:roles',
            ]);
        }

        if(isset($input['role_id'])){
            $role = Role::find($input['role_id']);
            $role->update($input);
            $role->attachPermissions($input['permissions']);
        }else{
            $role = Role::create($input);
            $role->attachPermissions($input['permissions']);
        }

        return redirect('/admin/roles')->with('status', 'Berhasil / Sukses');
    }


}
