<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if(!$request->uid){
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email', $email)->first();
            if ($user && password_verify($password, $user->password)) {
                if ($user->activate != 0) {
                    Auth::login($user);
                    return redirect('/');
                } else {
                    return redirect()->back()->withErrors(['email' => 'บัญชียังไม่ได้รับการยืนยันจากผู้ดูแลระบบ']);
                }
            }
        }else{
            $user = User::where('email',$request->email)->first();
            if($user){
                if ($user->activate != 0) {
                    Auth::login($user);
                    return redirect('/');
                } else {
                    return redirect()->back()->withErrors(['email' => 'บัญชียังไม่ได้รับการยืนยันจากผู้ดูแลระบบ']);
                }
            }else{
                $user = new User();
                $user->first_name = '';
                $user->last_name = '';
                $user->uid = $request->uid;
                $user->activate = 1;
                $user->email = $request->email;
                if($user->save()){
                    Auth::login($user);
                    return redirect('/');
                }
            }
        }
        return redirect()->back()->withErrors(['email' => 'ไม่พบบัญชีดังกล่าว', 'password' => 'ไม่พบบัญชีดังกล่าว']);
    }
}
