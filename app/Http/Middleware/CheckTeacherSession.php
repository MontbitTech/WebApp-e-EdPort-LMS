<?php

namespace App\Http\Middleware;

use Closure;

class CheckTeacherSession
{

    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('teacher_session')) {
            // user value cannot be found in session
            return redirect('/');
        }

        return $next($request);
    }

}