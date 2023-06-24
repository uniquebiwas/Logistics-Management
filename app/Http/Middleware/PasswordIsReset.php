<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordIsReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if (Auth::check() && Auth::user()->password_reset_at == null) {
            return redirect()->route('profiledetail');
        }

        return $next($request);
    }
}
