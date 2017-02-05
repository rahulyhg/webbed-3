<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Log;
use Sangria\JSONResponse;

class checkSession
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
        $roll_no = Session::get('roll_no');
        if($roll_no)
            return $next($request);
        else {
            $status_code = 401; //unauthorized
            $message = "Session expired. Please login again.";
            Log::info('Logged out');
            //for post routes, throw a 401
            if($request->isMethod('post')) {
                return JSONResponse::response($status_code, $message);
            }
            //for get routes, redirect to login page
            return redirect('/login');
        }
    }
}
