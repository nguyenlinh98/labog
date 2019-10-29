<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyActivatedUse
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
        if(Auth::check() && Auth::user()->active){
             return $next($request);
        }

        Auth::logout();
        return redirect()
            ->route('login')
            ->withErrors([
                'email' => ['chỉ có tài khoản đã kích hoạt mới có quyền truy cập.'],
            ]);

    }
}
