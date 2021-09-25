<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\SmsTool;

class SettingController extends Controller
{
    public function settingView()
    {
        $sms = SmsTool::first();
        return view('panel.admin.setting.all',compact('sms'));
    }

    public function smsStatus()
    {
        $sms = SmsTool::first();
        if ($sms->status == 1){
            $sms->update(['status'=>0]);
        }else{
            $sms->update(['status'=>1]);
        }
        return redirect(route('admin.setting.all'));
    }
}