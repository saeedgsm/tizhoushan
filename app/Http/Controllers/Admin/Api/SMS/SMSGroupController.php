<?php


namespace App\Http\Controllers\Admin\Api\SMS;


use App\Http\Controllers\Controller;
use App\RegisterClassStudent;
use App\User;
use Illuminate\Http\Request;

class SMSGroupController extends Controller
{
    public function sendSMSGroup(Request $request)
    {
        $classes = $request['classes'];
        $phoneUsers=[];
        foreach ($classes as $class) {
            $registers = RegisterClassStudent::query()->where('class_id',$class['id'])->get();
            if ($registers->isNotEmpty()){
                foreach ($registers as $register) {
                    $st = User::query()->where('id',$register->user_id)->first();
                    if (! empty($st)){
                      if ($st->phone != null){
                          array_push($phoneUsers,[
                              'user_id'=>$st->id,
                              'phone'=>$st->phone,
                              'name_family'=>$st->first_name . ' ' . $st->last_name,
                          ]);
                      }
                    }
                }
              //  $students =
            }
           /// return $class['id'];
        }
        return $phoneUsers;
    }
}
