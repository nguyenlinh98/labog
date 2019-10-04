<?php

namespace App\Http\Middleware;


use Closure;
use Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class UserAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$guards)
    {
        if ( $this->authenticated($guards) )
        {
            return $next($request);
        }
        return redirect()->route('login');
    }

    /*Xác nhận tài khoản $guards đă đăng nhập*/
    public function authenticated(array $guards)
    {
        foreach($guards as $guard)
        {
            if( Auth::guard($guard)->check() )
            {
                return true;
            }
        }
    }
}
