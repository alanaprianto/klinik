<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\GeneralController;
use App\Icd10;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCommonController extends GeneralController
{
    public function info()
    {
        $response = [];
        try {
            $user = User::with(['staff', 'staff.staffJob', 'staff.staffPosition', 'roles', 'roles.perms' , 'roles.perms.parent' ,'roles.perms.childs', 'roles.perms.childs.parent'])->find(Auth::user()->id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['user' => $user]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getIcd10(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if($input['limit']){
                $icd10s = Icd10::where('code', 'LIKE', '%' . $input['data'] . '%')
                    ->orWhere('desc', 'LIKE', '%' . $input['data'] . '%')->paginate($input['limit']);
            } else{
                $icd10s = Icd10::where('code', 'LIKE', '%' . $input['data'] . '%')
                    ->orWhere('desc', 'LIKE', '%' . $input['data'] . '%')->get();
            }

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['icd10s' => $icd10s]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
