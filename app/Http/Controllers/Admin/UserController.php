<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function getUser(Request $request, $param)
    {
        $user = '';
        $query = $request->query();
        $roles = Role::get();
        if (($param == 'edit') && $query['id']) {

            $user = User::with('roles')->find($query['id']);

        }
        return view('user.createEdit', compact(['user', 'roles']));
    }

    public function postUser(Request $request)
    {
        $input = $request->except(['_token']);
        if (isset($input['user_id'])) {
            $this->validate($request, [
                'username' => 'required|max:255|',
                'email' => 'required|email|max:255',
            ]);
        } else {
            $this->validate($request, [
                'username' => 'required|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
            $input['password'] = bcrypt($input['password']);

        }

        if (isset($input['user_id'])) {
            $user = User::find($input['user_id']);
            $user->update($input);
            $user->attachRoles($input['roles']);
            $user->roles()->sync($input['roles']);
        } else {
            $user = user::create($input);
            $user->staff()->create([]);
            $user->attachRoles($input['roles']);
        }
        return redirect('admin/user')->with('status', 'Success / Berhasil');
    }

    public function getList()
    {
        $user = User::with('roles')->get();
        $datatable = Datatables::of($user);
        return $datatable->make(true);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request['id']);
        $user->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}

