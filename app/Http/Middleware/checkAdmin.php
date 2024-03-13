<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
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
        if (auth()->user()->role == 'admin') {
            return $next($request);
        } else {
            if (auth()->check()) {
                auth()->logout();
                session()->flash('error', 'You are logged out. Admin Credentials only');
                return redirect()->route('laravel');
            } else {
                session()->flash('error', 'You have to login as Admin');
                return redirect()->route('laravel');
            }
        }
    }
}
