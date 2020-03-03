<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('staff_id') && Session::get('staff_name') && Session::get('user_type')){
            return redirect('/dashboard');
        }else{
            session()->flash('color', 'red');
            session()->flash('message', 'Please Login with Your Valid Email & Password');
            return $next($request);
        }
    }
}
