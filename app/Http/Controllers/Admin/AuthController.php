<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageUpload;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function setting()
    {
        return view('admin.auth.setting');
    }

    public function profileUpdate(Request $request)
    {

        $requestData = $request->all();
        // dd($request->all());
        if($request->hasFile('file_image')){
            $upload = new ImageUpload();
            // dd($upload->uploadImage($request,'file_image'));
            $requestData['file_image'] = $upload->uploadImage($request,'file_image');
        }
        // dd($requestData);
        // dd(\Auth::user()->id);
        $user = \App\Models\User::findOrFail(\Auth::user()->id);
        // dd($user);
        $user->update($requestData);
        if (!empty($request->Roles)) {
            $roles = $request->Roles;
            $user->clearRoles();
            foreach ($roles as $role) {
                $user->assignRole($role);
            }
        }
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
