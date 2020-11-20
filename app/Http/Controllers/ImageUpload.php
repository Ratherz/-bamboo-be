<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImageUpload extends Controller
{
    public static function uploadImage(Request $request, $file_name)
    {
        $image = $request->file($file_name);
        $input['imagename'] = time() . Auth::user()->id . '.' . $image->extension();

        $destinationPath = public_path("/storage" . '/' . Auth::user()->id);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $img = Image::make($image->path());
        $img->resize(1500, 1500, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['imagename']);

        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        return Auth::user()->id . '/' . $input['imagename'];
    }
}
