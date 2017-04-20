<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCommonController extends GeneralController
{
    public function info()
    {
        $response = [];
        try {
            $user = User::with(['staff', 'staff.staffJob', 'staff.staffPosition' ,'roles'])->find(Auth::user()->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['user' => $user]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
