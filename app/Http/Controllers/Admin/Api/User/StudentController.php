<?php


namespace App\Http\Controllers\Admin\Api\User;

use App\EducationalBase;
use App\EducationalClass;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\InfoStudent;
use App\RegisterClassStudent;
use App\TariffBasePayment;
use App\Traits\CustomFields;
use App\Traits\OptionTrait;
use App\Traits\UploaderFile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    use OptionTrait, UploaderFile;

    public function studentAll()
    {
        $subWeek = Carbon::now()->subWeek();
        $subMonth = Carbon::now()->subMonth();
       // $users = User::query()->where('level', 'student')->whereDate('created_at', '>', $subMonth)->latest()->get();
        $users = User::query()->where('level', 'student')->latest()->get();
       // $public_header_columns=$this->publicHeaders();
        if ($users->isNotEmpty()) {
            foreach ($users as $student) {
                $name_family = $student->first_name . " " . $student->last_name;
                $register = $student->studentBaseClass;
                $base_id = null;
                $base_name = null;
                $class_id = null;
                $class_name = null;
                if ($register) {
                    if ($register->base_id != '') {
                        $base = EducationalBase::find($register->base_id);
                        if ($register->class_id != '') {
                            $class = EducationalClass::find($register->class_id);
                            $class_id = $class != null ? $class->id : null;
                            $class_name = $class != null ? $class->class_title : 'تعیین نشده';
                        }
                        $base_id = $base->id;
                        $base_name = $base->base_title;
                    }
                }

               // $result= $this->checkStudentFields($$student);
                //$class_id = $student->studentBaseClass->class_id;
                $students[] = [
                    'user_id' => $student->id,
                    'user_code' => $student->usercode ?? 'تعیین نشده',
                    'user_pass' => $student->userpass,
                    'phone' => $student->phone ?? 'تعیین نشده',
                    'name_family' => $name_family,
                   // 'register' => $register,
                    'base_id' => $base_id,
                    'base_name' =>  $base_name,
                    'class_id' => $class_id,
                    'class_name' => $class_name,
                    'created_at' => $student->created_at->toDateTimeString(),
                    //'custom_fields'=>$result
                ];
            }
        }

        return response(['students'=>$students]);
    }

    public function quickRegister(Request $request)
    {
        $usercode = $this->createUniqueUserCode();
        $privatecode = $this->createUniquePrivateCode(8);
        $user = User::create([
            'level' => 'student',
            'usercode' => $request['usercode'],
            'private_code' => $privatecode,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'userpass' => $request['password'],
            'password' => bcrypt($request['password']),
        ]);

        RegisterClassStudent::create([
            'user_id' => $user->id,
            'base_id' => $request['base_id'],
            'class_id' => $request['class_id'],
        ]);

        InfoStudent::create([
            'user_id' => $user->id
        ]);

        if ($request['type_payment'] == 'in-person') {
            TariffBasePayment::create([
                'user_id' => $user->id,
                'amount' => '0',
                'payment' => 1,
                'resnumber' => 1,
                'type_payment' => $request['type_payment'],
                'desc' => "پرداخت حضوری",
            ]);
        }

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        $student = InfoStudent::query()->where('user_id', $user->id)->first();
        $register = RegisterClassStudent::query()->where('user_id', $user->id)->first();
        $payments = TariffBasePayment::query()->where('user_id', $user->id)->get();

        $img['url'] = $user->avatar;
        if ($img['url'] == null || !file_exists(public_path($img['url'])))
            $img['url'] = "assets/images/users/avatar-512.png";

        $userInfo = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'usercode' => $user->usercode,
            'userpass' => $user->userpass,
            'email' => $user->email,
            'phone' => $user->phone,
            'base_name' => $register->educationBase->base_title,
            'class_name' => $register->educationClass->class_title,
            'avatar' => $img['url'],
        ];

        return $userInfo;
    }

    public function edit($id)
    {
        $user = User::find($id);
        $student = InfoStudent::query()->where('user_id', $user->id)->first();
        $register = RegisterClassStudent::query()->where('user_id', $user->id)->first();
        $userInfo = [
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'usercode' => $user->usercode,
            'base_id' => $register->educationBase->id,
            'class_id' => $register->educationClass->id,
            'state_id' => $student->state_id,
            'city_id' => $student->city_id,
        ];

        return  response()->json($userInfo);
    }

    public function update(Request $request)
    {
        $user = User::find($request['user_id']);
        $student = InfoStudent::query()->where('user_id', $user->id)->first();
        $register = RegisterClassStudent::query()->where('user_id', $user->id)->first();
        $userInfo = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'usercode' => $request['usercode'],
        ];

        $password = $request['password'];
        if ($password) {
            $userInfo['password'] = bcrypt($password);
            $userInfo['userpass'] = $password;
        } else {
            $userInfo['password'] = $user->password;
            $userInfo['userpass'] = $user->userpass;
        }
        $user->update($userInfo);

        $studentInfo = [
            'state_id' => $request['state_id'],
            'city_id' => $request['city_id'],
        ];

        $student->update($studentInfo);

        $register->update([
            'class_id' => $request['class_id'],
            'base_id' => $request['base_id']
        ]);
        return 'success';
    }

    public function checkPhone(Request $request)
    {

        $user = User::query()->where('phone', $request['check_phone'])->first();
        if ($user) {
            if ($user->id == $request['user_id']) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function checkUsercode(Request $request)
    {

        $user = User::query()->where('usercode', $request['check_usercode'])->first();
        if ($user) {
            if ($user->id == $request['user_id']) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function uploadStudentExcel(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            Excel::import(new UsersImport(), $file);
            // return $l = $this->UploadSoalFiles($file,'exc');
        }
        return $request->all();
    }
}
