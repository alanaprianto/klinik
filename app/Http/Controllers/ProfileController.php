<?php

namespace App\Http\Controllers;

use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('staff')->find(Auth::user()->id);
        if (Auth::user()->hasRole('admin')) {
            $role = 'admin';
        } elseif (Auth::user()->hasRole('loket')) {
            $role = 'loket';
        } elseif (Auth::user()->hasRole('kasir')) {
            $role = 'kasir';
        } elseif (Auth::user()->hasRole('apotek')) {
            $role = 'apotek';
        } else {
            $role = 'penata-jasa';
        }

        return view('Common::profile.index', compact(['user', 'role']));
    }

    public function postUpdate(Request $request)
    {
        $input = $request->except('_token');
        if (isset($input['file'])) {
            $file = $input['file'];
            $path = 'uploads/profile-user';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $file_name = 'profile-user-' . Auth::user()->id . '.png';
            $file->move($path, $file_name);
            $image = $path . '/' . $file_name;

            $img_crop = $input['picture'];
            $img_crop = substr($img_crop, strpos($img_crop, ",") + 1);
            $data = base64_decode($img_crop);
            file_put_contents($image, $data);

            $input['image_profile'] = $image;
        }
        unset($input['file']);
        unset($input['picture']);

        $staff = Staff::where('user_id', $input['user_id'])->first();
        if ($staff) {
            $staff->update($input);
        } else {
            Staff::create($input);
        }
        return redirect()->back()->with('status', 'Berhasil');
    }
}
