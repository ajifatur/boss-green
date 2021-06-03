<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && $request->user()->role == 'admin' && $request->path() == 'admin/login') {
            return redirect('/admin/dashboard');
        }
        if (Auth::guard($guard)->check() && $request->user()->role == 'kurir' && $request->path() == 'kurir/login') {
            return redirect('/kurir/dashboard');
        }
        if (Auth::guard($guard)->check() && $request->user()->role == 'member' && $request->path() == 'member/login') {
            return redirect('/');
        }

        return $next($request);
    }
}
