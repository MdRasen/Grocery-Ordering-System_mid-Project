<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('id')){
            return $next($request);
        }
        return redirect()->route('public.login');
    }
}
