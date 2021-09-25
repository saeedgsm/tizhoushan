<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckStudentAuthenticated
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
        if (auth()->check())
        {
            if (auth()->user()->isStudent()){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
