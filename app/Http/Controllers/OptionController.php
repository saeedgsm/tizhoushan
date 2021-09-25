<?php

namespace App\Http\Controllers;

use App\Azmoon;
use App\EducationalBase;
use App\EducationalClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OptionController extends Controller
{
    public function getStateList()
    {
        $states = DB::table('states')->orderBy('name', 'asc')->get();
        return response($states);
    }

    public function getCityList($stateId)
    {
        $cities = DB::table('cities')->where('state_id', $stateId)->orderBy('name', 'asc')->get();
        return response($cities);
    }

    // upload image
    public function uploadImage($file, $type)
    {
        $mimeTypes=['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        if(in_array($file, $mimeTypes) ){
            list($width, $height) = getimagesize($file);
            $name = Str::random(8). '_' . $width . 'x' . $height . '.' .$file->getClientOriginalExtension();
        }else{
            $name = Str::random(8). '.' .$file->getClientOriginalExtension();
        }
        $url = 'upload/'. $type . '/'. $year . '/' . $month .'/';
        $file->move($url,$name);
        return $url . $name;
    }

    public function azmoonCountSoal($azmoonId)
    {
        $azmoon = Azmoon::query()->where('id',$azmoonId)->first();
        $azmonSoal = $azmoon->soal;
        if ($azmoon->azmoon_type == 'normal'){
            return 'normal';
        }elseif ($azmoon->azmoon_type == 'advanced'){
            if ($azmonSoal->type == 'porseshnameh'){
                $porseshnamehs = $azmoon->advancedPorseshnamehs;
                foreach ($porseshnamehs as $porseshnameh){
                    $data[] = [
                        'book_id' =>$porseshnameh->book_id,
                        'soal_count' =>$porseshnameh->number_of_question
                    ];
                }

                return response($data);
            }elseif ($azmonSoal->type == 'soal_b_soal'){
                return 'soal_b_soal';
            }
        }
    }

    public function getBasesList()
    {
        $bases = EducationalBase::query()->orderBy('id','asc')->get();
        return response($bases);
    }

    public function getClassList($baseId)
    {
        $classes = EducationalClass::query()->where('base_id',$baseId)->orderBy('class_title','asc')->get();
        return response($classes);
    }



}
