<?php


namespace App\Http\Controllers\Api\Admin\Student;


use App\Http\Controllers\Controller;
use App\User;

class StudentController extends Controller
{
    public function index()
    {
        $data_students=null;
        $students = User::query()->where('level','student')->latest()->get();
        foreach ($students as $student){
            $name_family = $student->first_name . ' ' . $student->last_name;
            $register = $student->studentBaseClass;
            $data_students[]=[
                'id' =>$student->id,
                'name_family' =>$name_family,
                'base_id' => $register->educationBase->id ?? null,
                'base_name' => $register->educationBase->base_title ?? 'تعیین نشده',
                'class_id' => $register->educationClass->id ?? null,
                'class_name' => $register->educationClass->class_title ?? 'تعیین نشده',
                'user_code' => $student->usercode,
                'user_pass' => $student->userpass,
                'email' => $student->email ?? 'تعیین نشده',
                'phone' => $student->phone ?? 'تعیین نشده',
            ];
        }
        return response()->json($data_students);
    }

    public function delete($id)
    {
         $student = User::query()->where('id',$id)->first();
         if ($student){
             $student->delete();
             return response('success',200);
         }else{
             return response('error',404);
         }

    }

    public function getBaseClassInfo($studentID)
    {
        return $studentID;
    }
}