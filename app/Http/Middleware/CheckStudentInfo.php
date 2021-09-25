<?php

namespace App\Http\Middleware;

use App\Traits\OptionTrait;
use Closure;

class CheckStudentInfo
{
    use OptionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $check = $this->checkStudentInfo($user);
        $BC = auth()->user()->studentBaseClass()->first();
        if (!$BC){
            return redirect(route('student.register.select'))
                ->with('warning', 'دانش آموز عزیز لطفا اطلاعات خود را کامل کنید!');
        }
        if ($check == true) {
            return redirect(route('student.panel.edit'))->with('warning', 'دانش آموز عزیز لطفا اطلاعات خود را کامل کنید!');
        }

        return $next($request);
    }
}
