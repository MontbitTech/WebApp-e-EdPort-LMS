<?php

namespace App\Http\Middleware;
use Closure;
use App\Teacher;


class CheckUserToken
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
		$has_token = $request->header('hasToken');
		$user = Teacher::where('hasToken',$has_token)->get()->toArray();
		
		//dd($has_token);
		 if (count($user) > 0) {
            return $next($request);
        }
		$response = [
            'status'=> 'error',
            'message' => "Teacher not authenticated!",
        ];
       return response()->json($response,404);
    }
}