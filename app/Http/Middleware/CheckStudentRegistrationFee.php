<?php

namespace App\Http\Middleware;

use App\RegistrationFee;
use App\RegistrationFeePayment;
use Closure;

class CheckStudentRegistrationFee
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
        $ss = auth()->user()->studentBaseClass()->first();
        if ($ss){
            $fee = RegistrationFee::query()->where('base_id',$ss->base_id)->first();
            if ($fee->status == 1){
                $payment = RegistrationFeePayment::query()->where('user_id',auth()->id())->latest()->first();
                if ($payment){
                    if ($payment->payment == 1){
                        return $next($request);
                    }
                }
                return redirect(route('student.registration.fee.show'));
            }
        }else{
            return redirect(route('student.panel.edit'))->with('warning', 'دانش آموز عزیز لطفا اطلاعات خود را کامل کنید!');
        }

        return $next($request);
    }
}
