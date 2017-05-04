<?php

namespace App\Http\Controllers\Common;

use App\City;
use App\Country;
use App\District;
use App\Http\Controllers\GeneralController;
use App\Icd10;
use App\Province;
use App\SubDistrict;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCommonController extends GeneralController
{
    public function info()
    {
        $response = [];
        try {
            $user = User::with(['staff', 'staff.staffJob', 'staff.staffPosition', 'roles', 'roles.perms'])->find(Auth::user()->id);
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
            $icd10s = Icd10::where('code', 'LIKE', '%' . $input['data'] . '%')
                ->orWhere('desc', 'LIKE', '%' . $input['data'] . '%')->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['icd10s' => $icd10s]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getCountries(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $country = Country::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['country' => $country]];
            } else {
                $countries = Country::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['countries' => $countries, 'recordsTotal' => count($countries)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getProvinces(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $province = Province::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['province' => $province]];
            } else {
                $provinces = Province::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['provinces' => $provinces, 'recordsTotal' => count($provinces)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getCities(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if (isset($input['code']) && $input['code']) {
                $city = City::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['city' => $city]];
            } else {
                $cities = City::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['cities' => $cities, 'recordsTotal' => count($cities)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getDistrict(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if(isset($input['code']) && $input['code']){
                $district = District::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['district' => $district]];
            } else{
                $districts = District::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['districts' => $districts, 'recordsTotal' => count($districts)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    public function getSubDistrict(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            if(isset($input['code']) && $input['code']){
                $subDistrict = SubDistrict::where('code', $input['code'])->first();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['subDistrict' => $subDistrict]];
            } else{
                $subDistrict = SubDistrict::get();
                $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['subDistricts' => $subDistrict, 'recordsTotal' => count($subDistrict)]];
            }
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
