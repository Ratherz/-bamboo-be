<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $requestData = $request->all();
        $this->validate($request, User::REGISTER_VALIDATION);
        $requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
        $requestData['activate'] = 1;
        $user = User::create($requestData);
        if ($user && $request->roles) {
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
            return redirect('/login')->with('success', 'ลงทะเบียนสำเร็จแล้วเข้าสู่ระบบได้เลย');
        }
        $message = "ไม่สามารถลงทะเบียนได้ กรุณาตรวจสอบความถูกต้องของข้อมูลก่อนลงทะเบียน";
        return view('auth.register', compact('requestData', 'message'));
    }
}
