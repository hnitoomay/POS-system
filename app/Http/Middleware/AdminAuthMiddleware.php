<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
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
        //dd(route('admin#change'));
        //dd(url()->current());

        //this is about if user has login, he cannot browse login or register page on url bar until he logout
        if(!empty(Auth::user())){
            if(url()->current() == route('auth#login') || (url()->current() == route('auth#register'))){
                return back();
            }

        //this happen after login
        //this is about user cannot access the admin pages. intead of showing abort, it will return back to your current admin page
        if(Auth::user()->role == 'user'){
            return back();
        }
        }

        return $next($request);
    }
}
