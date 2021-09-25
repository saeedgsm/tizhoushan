<?php

namespace App\Http\Controllers\Site;

use App\Azmoon;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function guestStartAzmoon($azmoon_code)
    {

        $azmoon = Azmoon::query()->where('azmoon_code',$azmoon_code)->first();
        if (! $azmoon){
            return redirect(route('site.index'))->with('error','کد آزمون اشتباه است! لطفا بررسی کنید!');
        }

       /* if (auth()->check()){
            if (auth()->user()->level != 'student'){
                $azmoonDate['start'] = $this->convertNumbers(new Verta($azmoon->azmoon_start));
                $azmoonDate['end'] = $this->convertNumbers(new Verta($azmoon->azmoon_end));
                if ($azmoon->azmoon_for== 'exam'){
                    return view('site.azmoons.show',compact('azmoon','azmoonDate'));
                }else{
                    $survey=$azmoon;
                    return view('site.surveys.show',compact('survey','azmoonDate'));
                }

            }
        }*/
        if ($azmoon->azmoon_for== 'exam'){
           // return view('site.azmoons.show',compact('azmoon','azmoonDate'));
            return redirect(route('student.azmoons.show',$azmoon))->with('success','برای شروع آزمون لطفا دکمه شروع کلیک کنید!');
        }else{
            $survey=$azmoon;
            return redirect(route('student.surveys.show',$survey))->with('success','برای شروع نظرسنجی لطفا دکمه شروع کلیک کنید!');
          //  return view('site.surveys.show',compact('survey','azmoonDate'));
        }
       // return redirect(route('student.azmoons.show',$azmoon))->with('success','برای شروع آزمون لطفا دکمه شروع کلیک کنید!');
    }

    function convertNumbers($srting, $toPersian = true)
    {
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        if ($toPersian) return str_replace($en_num, $fa_num, $srting);
        else return str_replace($fa_num, $en_num, $srting);
    }


}
