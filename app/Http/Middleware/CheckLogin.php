<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{//dd(auth()->guard('marketings')->check());
    if (auth()->check() || auth()->guard('marketings')->check()) {
        return $next($request);
    } 
    else{
        return redirect()->route('login')->with('error', 'Please login to access.');
    }

    return $next($request);
}


    
   
}
