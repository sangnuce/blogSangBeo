<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin() || $user->isMod()) {
                return $next($request);
            } else {
                return redirect()->route('home')->withErrors('Bạn phải đăng nhập bằng tài khoản có quyền quản trị');
            }
        }
        return redirect()->route('login')->withErrors('Bạn chưa đăng nhập');
    }
}
