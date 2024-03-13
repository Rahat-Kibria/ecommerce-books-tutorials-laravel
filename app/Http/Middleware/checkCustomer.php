<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkCustomer
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
        if (auth()->guest()) {
            return $next($request);
        } else if (auth()->user()->role == 'guest') {
            return $next($request);
        } else if (auth()->user()->role == 'auth_user') {
            return $next($request);
        } else {
            Auth::logout();
            session()->flash('error', 'You are logged out. Cannot use Admin credentials');
            return redirect()->route('laravel');
        }
    }
}
