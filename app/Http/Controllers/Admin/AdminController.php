<?php

namespace App\Http\Controllers\Admin;

use App\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('/home');
    }

    public function getProfile(){
        $hospital = Hospital::first();
        return view('profile', compact('hospital'));
    }

    public function postProfile(Request $request){
        $input = $request->except('_token');
        $hospital = Hospital::first();

        if(isset($input['file'])){
            $file = $input['file'];
            $path = 'uploads/profile';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $file_name = 'profile-rs.png';
            $file->move($path, $file_name);
            $image = $path.'/'.$file_name;

            $img_crop = $input['picture'];
            $img_crop = substr($img_crop, strpos($img_crop, ",")+1);
            $data = base64_decode($img_crop);
            file_put_contents($image, $data);

            $input['image_header'] = $image;
        }
        unset($input['file']);
        unset($input['picture']);

        $hospital->update($input);
        return redirect()->back()->with('status', 'Berhasil update Profil Rumah Sakit');
    }
}
