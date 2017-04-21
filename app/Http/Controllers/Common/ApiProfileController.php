<?php

namespace App\Http\Controllers\Common;

use App\Staff;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiProfileController extends Controller
{
    public function postProfile(Request $request){
        $response = [];
        try {
            $input = $request->all();
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
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
