<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

            $setting = Settinggi::find($query['id']);

        }
        return view('tindakan.createEdit', compact(['service']));
    }
}
