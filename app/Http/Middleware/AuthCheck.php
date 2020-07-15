<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle ($request, Closure $next)
    {
        if ( $request->session()->exists('admin_session') )
            return redirect('/admin/dashboard');
        if ( $request->session()->exists('teacher_session') )
            return redirect('/teacher/home');

        return $next($request);
    }
}
