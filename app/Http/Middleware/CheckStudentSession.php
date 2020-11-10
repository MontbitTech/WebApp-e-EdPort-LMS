<?php

namespace App\Http\Middleware;

use Closure;

class CheckStudentSession
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
        if (!$request->session()->exists('student_session')) {
            // user value cannot be found in session
            return redirect('/');
        }
        
        return $next($request);
    }
}
