<?php

namespace App\Imports;

use App\CustomizeField;
use App\CustomizeFieldValue;
use App\EducationalBase;
use App\EducationalClass;
use App\InfoStudent;
use App\Models\User;
use App\RegisterClassStudent;
use App\Traits\OptionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Throwable;

class UsersImport implements ToModel, WithStartRow
{
    use OptionTrait;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //$usercode=$this->createUniqueUserCode();
        $privatecode=$this->createUniquePrivateCode(8);
        $user = User::create([
            'first_name'     => $row[0],
            'last_name'    => $row[1],

            'private_code'    => $privatecode,
            'usercode'    =>$row[9],
            'userpass'    => $row[9],
            'password' => Hash::make($row[9]),

            'level'=>'student',
        ]);
        InfoStudent::create([
            'user_id'=>$user->id
        ]);

        $customizeFields = CustomizeField::all();
        // مدرسه در حال تحصیل
       // $school_name = $customizeFields->where('field_name',$row[3])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[3],
            'field_name'=>'beanbioi'
        ]);

        // شماره موبایل پدر
       // $dad_phone = $customizeFields->where('field_name',$row[4])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[4],
            'field_name'=>'netsrymz'
        ]);
        // شماره موبایل مادر
       // $mom_phone = $customizeFields->where('field_name',$row[5])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[5],
            'field_name'=>'xghmcqrc'
        ]);

        // تلفن منزل
       // $house_phone = $customizeFields->where('field_name',$row[6])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[6],
            'field_name'=>'tlcejfpi'
        ]);

        // آدرس دقیق منزل
      //  $house_address = $customizeFields->where('field_name',$row[8])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[8],
            'field_name'=>'irvfvyqb'
        ]);
        // کد ملی دانش اموز
       // $melli = $customizeFields->where('field_name',$row[9])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[9],
            'field_name'=>'vcwujzqg'
        ]);

        // شغل پدر
      //  $dad_job = $customizeFields->where('field_name',$row[10])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[10],
            'field_name'=>'mrmdhrpz'
        ]);

        // شغل مادر
       // $mom_job = $customizeFields->where('field_name',$row[11])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[11],
            'field_name'=>'kpkyydfo'
        ]);

        // جنسیت
      //  $gender = $customizeFields->where('field_name',$row[12])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[12],
            'field_name'=>'dgnlgqjc'
        ]);

        // تام پدر
      //  $dad_name = $customizeFields->where('field_name',$row[13])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[13],
            'field_name'=>'nvnopdwc'
        ]);

        // ورودی ترم
       // $term = $customizeFields->where('field_name',$row[15])->first();
        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[15],
            'field_name'=>'zjuptdxz'
        ]);

        // تلفن برای ارتباط از طریق تلگرام و پیامک

        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[7],
            'field_name'=>'qzdufvky'
        ]);

        // کد

        CustomizeFieldValue::create([
            'user_id'=>$user->id,
            'value'=>$row[16],
            'field_name'=>'xwcmfldk'
        ]);

        $base_name = $row[2];
        $class_name = $row[14];
        $base = EducationalBase::query()->where('base_title','like','%' . $base_name. '%')->first();
        $class = EducationalClass::query()->where('class_title','like',$class_name)->first();
        if (empty($class)){
            $class = EducationalClass::create([
                'base_id'=>$base->id,
                'class_title'=>$class_name,
                'class_label'=>$class_name,
                'registrable'=>0,
            ]);

        }
        RegisterClassStudent::create([
            'user_id'=>$user->id,
            'base_id'=>$class->base_id,
            'class_id'=>$class->id,
        ]);


        return $user;
    }

    public function startRow(): int
    {
        return 2;
    }
}
