<?php

namespace App\Http\Controllers\admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }
    public function getSetting(Request $request)
    {
        $settings = Setting::get();
        return view('setting.createEdit', compact(['settings']));
    }
    public function postSetting(Request $request)
    {
        $inputs = $request->except('_token');
        $total_setting = count($inputs) / 3;
        Setting::truncate();

        for($i=1; $i<=$total_setting; $i++){
            $array = [];
            foreach ($inputs['name_'.$i] as $index => $name){
                $array[$name] = $inputs['value_'.$i][$index];
            }
            Setting::create([
                'name' => $inputs['setting_name_'.$i],
                'name_value' => json_encode($array, true)
            ]);
        }
        return redirect('admin/setting')->with('status', 'Success / Berhasil');
    }
}
