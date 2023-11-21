<?php

namespace App\Http\Middleware;
use Session;
use Closure;
use Illuminate\Http\Request;

class CustomAuth
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
         $path=$request->path();
         if(($path == 'Login' || $path == 'Register') && Session::get('userstoken')){
            return redirect('/');
         } else if(($path != 'Login' && !Session::get('userstoken')) && ($path != 'Register' && !Session::get('userstoken')) && ($path != 'post-login' && !Session::get('userstoken')) && ($path != 'Checkotp' && !Session::get('userstoken')) && ($path != 'updatePassword' && !Session::get('userstoken')) && ($path != 'forgotPassword' && !Session::get('userstoken')) ){
            return redirect('/Login');
         }
        
        return $next($request);
    }
}
