<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return redirect('setting');
        if(Auth::user()->first_name && Auth::user()->last_name && Auth::user()->phone && Auth::user()->address && Auth::user()->address_no && Auth::user()->zoi && Auth::user()->road && Auth::user()->district && Auth::user()->amphure && Auth::user()->province && Auth::user()->zip){
            return $next($request);
        }else{
             return redirect('setting')->with('error','กรุณาอัปเดทข้อมูล');
        }
    }

}
