<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        if (Auth::user() &&  Auth::user()->role == 'super admin') {
            return $next($request);
        }elseif (Auth::user() &&  Auth::user()->role == 'manager') {
            return $next($request);
        }elseif(Auth::user() &&  Auth::user()->role == 'admisi') {
            return $next($request);
        }elseif (Auth::user() &&  Auth::user()->role == 'purchasing') {
            return $next($request);
        }elseif (Auth::user() &&  Auth::user()->role == 'controlling') {
            return $next($request);
        }else{
            return $next($request);
        }
        abort(403, 'Anda Tidak Berhak Mengakses Halaman Berikut ');
    }
}
