<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    // public function handle($request, Closure $next)
    // {
    //     if (Auth::check() && Auth::user()->user_type !== 'admin') {
    //         return redirect()->route('admin.login');
    //     }

    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
    if (Auth::guard('admin')->check() && Auth::user()->user_type === 'admin') {
        return $next($request);
    }

    return redirect()->route('admin.login');
    }

}
