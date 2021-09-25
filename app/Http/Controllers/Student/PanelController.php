<?php

namespace App\Http\Controllers\Student;

use App\CustomField;
use App\CustomizeFieldValue;
use App\EducationalBase;
use App\Events\StudentCompleteInfo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OptionController;
use App\InfoStudent;
use App\RegisterClassStudent;
use App\RegistrationFeePayment;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class PanelController extends OptionController
{
    use CustomFields;

    public function index()
    {
        return view('panel.student.panel.show');
    }

    public function edit()
    {
        $user = auth()->user();
        $stInfo = InfoStudent::query()->where('user_id', $user->id)->first();
        $states = DB::table('states')->orderBy('name', 'asc')->get();
        $cities = DB::table('cities')->where('state_id', $stInfo->state_id)->orderBy('name', 'asc')->get();

        $custom = CustomField::query()->where('table_task', 'edit_student_info')->first();
        if (!empty($custom)) {
            $colsDef = $custom->field_list;
            $cols = $this->exportArray($colsDef);
        }

        $register = RegisterClassStudent::query()->where('user_id',auth()->id())->first();
        if ($register){
            if ($register->class_id == null || $register->base_id == null){
                $registerView = 1;
            }else{
                $registerView=0;
            }
        }else{
            $registerView=1;
        }

        $bases = EducationalBase::all();

        return view('panel.student.panel.edit', compact('user',
            'stInfo', 'states', 'cities', 'cols','registerView','bases'));
    }

    public function update(Request $request)
    {
        $inputs = null;
        $acf = null;
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'acf_')) {
                $ex = explode("_",$key);
                $acf[$ex[1]] = $value;
                $cfv = CustomizeFieldValue::query()->where('field_name',$ex[1])->first();
                if ($cfv){
                    $cfv->update(['value'=>$value]);
                }else{
                    CustomizeFieldValue::create([
                        'user_id'=>auth()->user()->id,
                        'value'=>$value,
                        'field_name'=>$ex[1],
                        'app_model'=>'info_students',
                    ]);
                }
            } else {
                $inputs[$key] = $value;
            }
        }
        /*$request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['nullable', 'numeric', 'digits:11', 'unique:users'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);*/
        $user = auth()->user();

        $file = $request->file('avatar');
        $userInfo = Arr::except($inputs,['password', 'email', 'phone', 'avatar','_method','_token']);
        $studentInfo = $user->student;

        if ($file) {
            if (file_exists(asset($user->avatar)))
                unlink($user->avatar);
            $userInfo['avatar'] = $this->uploadImage($file, 'avatars');
            $user->update(['avatar_check' => 0]);
        } else {
            $userInfo['avatar'] = $user->avatar;
        }

        $phone = $request['phone'];
        if ($phone) {
            $userInfo['phone'] = $phone;
        } else {
            $userInfo['phone'] = $user->phone;
        }

        $email = $request['email'];
        if ($email) {
            $userInfo['email'] = $email;
        } else {
            $userInfo['email'] = $user->email;
        }

        $password = $request['password'];
        if ($password) {
            $userInfo['password'] = bcrypt($password);
            $userInfo['userpass'] = $password;
        } else {
            $userInfo['password'] = $user->password;
            $userInfo['userpass'] = $user->userpass;
        }

        $user->update($userInfo);

        $studentInfo->update([
            'father' => $request['father'] ?? $studentInfo->father,
            'school_name' => $request['school_name'] ?? $studentInfo->school_name,
            'melli' => $request['melli'] ?? $studentInfo->melli,
            'tel_home' => $request['tel_home'] ?? $studentInfo->tel_home,
            'tel_parent' => $request['tel_parent'] ?? $studentInfo->tel_parent,
            'hamgam_code' => $request['hamgam_code'] ?? $studentInfo->hamgam_code,
            'birthdate' => $request['birthdate'] ?? $studentInfo->birthdate,
            'state_id' => $request['state_id'] ?? $studentInfo->state_id,
            'city_id' => $request['city_id'] ?? $studentInfo->city_id,
        ]);
        if ($studentInfo->first_log == 0){
            event(new StudentCompleteInfo($user));
            $studentInfo->update(['first_log'=>1]);
        }

        return redirect(route('student.panel'))->with('success', 'اطلاعات کاربری با موفقیت ویرایش گردید!');
    }
}
