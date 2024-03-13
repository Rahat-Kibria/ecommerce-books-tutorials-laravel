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
        if (!empty(auth()->user()->role) && auth()->user()->role == 'auth_user') {
            return $next($request);
        } elseif (!empty(auth()->user()->role) && auth()->user()->role == 'guest') {
            session()->flash('error', 'Authenticated User Credentials needed');
            return redirect()->route('botu.login.registration.page');
        } else {
            session()->flash('error', 'Authenticated User Credentials needed');
            return redirect()->route('botu.login.registration.page');
        }
    }
}
