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
    public function getSetting(Request $request, $param)
    {
        $setting = '';
        $query = $request->query();

        if (($param == 'edit') && $query['id']) {

            $setting = Setting::find($query['id']);

        }
        return view('setting.createEdit', compact(['setting']));
    }
    public function postSetting(Request $request)
    {


        $input = $request->except(['_token']);

        if (isset($input['setting_id'])) {
            ;
            $setting = Setting::find($input['setting_id']);
            $setting->update($input);
        } else {
            $setting = Setting::create($input);


        }
        return redirect('admin/setting')->with('status', 'Success / Berhasil');
    }

    public function getList(){
        $setting = Setting::get();
        $datatable = Datatables::of($setting);
        return $datatable->make(true);
    }

    public function deleteService(Request $request)
    {
        $setting = Setting::find($request['id']);
        $setting->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus service');
    }
}
