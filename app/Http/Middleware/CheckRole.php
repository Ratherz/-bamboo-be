<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleId)
    {
        if (Auth::user()->hasRole($roleId)) {
            return $next($request);
        }
        return abort(403, 'คุณไม่ได้รับอณุญาติ');
    }
}
