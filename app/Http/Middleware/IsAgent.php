<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAgent
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
        $user = Auth::user();
        if($user->userCategory && $user->userCategory->userrole && in_array($user->userCategory->userrole->title,['Agent'])){
        //   dd('dsfjsdlfjsdlf');
            return $next($request);
            
        }else {
            return redirect()->route('login');
        }
    }
}
