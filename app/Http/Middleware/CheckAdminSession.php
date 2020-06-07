<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminSession
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('admin_session')) {
            // user value cannot be found in session
            return redirect('/');
        }

        return $next($request);
    }

}