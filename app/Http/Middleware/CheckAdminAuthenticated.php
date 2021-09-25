<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminAuthenticated
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
            if (auth()->user()->isAdmin()){
                return $next($request);
            }
        }
        //return redirect(route('http.code.404'))->with('success','کاربر گرامی صفحه مورد نظر یافت نشد یا دسترسی ندارید!');
        return redirect('/');
    }
}
