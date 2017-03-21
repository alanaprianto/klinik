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
        $total_setting = count($inputs) / 2;
        Setting::truncate();

        $array = [11 => 11, 12 => 12];

        for($i=1; $i<=$total_setting; $i++){
            $array_setting = [];
            foreach ($inputs['setting_'.$i.'_name'] as $index => $name){
                $array = [$name => $inputs['setting_'.$i.'_value'][$index]];
                array_push($array_setting, $array);
            }
            Setting::create([
                'name_value' => json_encode($array_setting, true)
            ]);

        }
        return redirect('admin/setting')->with('status', 'Success / Berhasil');
    }
}
