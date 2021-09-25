<?php

namespace App\Http\Middleware;

use App\TariffBase;
use App\TariffBasePayment;
use Closure;

class CheckStudentTariffBases
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $BC = auth()->user()->studentBaseClass()->first();
        $check = false;
        if ($BC) {
            if ($BC->base_id == 0 || $BC->base_id == null || $BC->class_id == 0 || $BC->class_id == null) {
                return redirect(route('student.register.select'))
                    ->with('warning', 'دانش آموز عزیز لطفا اطلاعات خود را کامل کنید!');
            }
            $tariffs = TariffBase::query()->where('tariff_active', 1)->get();

            if ($tariffs->isNotEmpty()) {
                foreach ($tariffs as $tariff) {
                    $baseIds = explode(",", $tariff->tariff_bases);
                    foreach ($baseIds as $baseId) {
                        if ($baseId == $BC->base_id) {
                            $payment = TariffBasePayment::query()->where('user_id', auth()->id())->latest()->first();
                            if ($payment) {
                                if ($payment->payment == 1) {
                                    return $next($request);
                                }else{
                                    $check = true;
                                }
                            }
                        } else {
                            $check = false;
                        }
                    }
                }
                if ($check == true) {
                    return redirect(route('student.tariff.bases.show'));
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
                //return redirect(route('student.tariff.bases.show'));
            }
        } else {
            return redirect(route('student.register.select'))->with('warning', 'دانش آموز عزیز لطفا اطلاعات خود را کامل کنید!');
        }
    }
}
