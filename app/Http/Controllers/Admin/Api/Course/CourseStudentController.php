<?php


namespace App\Http\Controllers\Admin\Api\Course;


use App\Course;
use App\CustomizeField;
use App\CustomizeFieldStudent;
use App\CustomizeFieldValue;
use App\Http\Controllers\Controller;
use App\RegisterClassStudent;
use App\StudentClassCourse;
use App\Traits\CustomFields;
use App\User;

class CourseStudentController extends Controller
{
    use CustomFields;

    /**
     * adminApi.php
     * route : api/admin/active-course-students
     * fetch all active course Students
     *
     * vue.js
     * Routes.js
     * route name : ActiveCourseStudents
     */
    public function activeCourseStudents()
    {
        $coursesCount = Course::query()->where('status',1)->count();
        if ($coursesCount != 1){
            return response("error");
        }

        $course = Course::query()->where('status', 1)->first();
        $classes = StudentClassCourse::query()->where('course_id', $course->id)->get();
        $students = [];
        $headerColumns=$this->fetchHeaderColumns($classes);
        $public_header_columns=$this->publicHeaders();
        if ($classes->isNotEmpty()) {
            foreach ($classes as $class) {
                $registerClassStudents = RegisterClassStudent::query()->where('class_id', $class->class_id)->get();
                foreach ($registerClassStudents as $register) {
                    $st=$register->student;
                    $result= $this->checkStudentFields($st);

                    $name_family = $register->student->first_name . " " . $register->student->last_name;
                    $students[] = [
                        'user_id' => $register->student->id,
                        'user_code' => $register->student->usercode ?? 'تعیین نشده',
                        'user_pass' => $register->student->userpass,
                        'phone' => $register->student->phone ?? 'تعیین نشده',
                        'name_family' => $name_family,
                        'base_id' => $register->educationBase->id ?? null,
                        'base_name' => $register->educationBase->base_title ?? 'تعیین نشده',
                        'class_id' => $register->educationClass->id ?? null,
                        'class_name' => $register->educationClass->class_title ?? 'تعیین نشده',
                        'custom_fields'=>$result
                    ];
                }
            }
        }
        return response()->json(['students'=>$students,'headers'=>$headerColumns,'public_headers'=>$public_header_columns]);
    }

    public function index($courseId)
    {
        $course = Course::query()->where('id', $courseId)->first();
        $classes = StudentClassCourse::query()->where('course_id', $course->id)->get();
        $students = [];
        $headerColumns=$this->fetchHeaderColumns($classes);
        $public_header_columns=$this->publicHeaders();
        if ($classes->isNotEmpty()) {
            foreach ($classes as $class) {
                $registerClassStudents = RegisterClassStudent::query()->where('class_id', $class->class_id)->get();
                foreach ($registerClassStudents as $register) {
                    $st=$register->student;
                     $result= $this->checkStudentFields($st);

                    $name_family = $register->student->first_name . " " . $register->student->last_name;
                    $students[] = [
                        'user_id' => $register->student->id,
                        'user_code' => $register->student->usercode ?? 'تعیین نشده',
                        'user_pass' => $register->student->userpass,
                        'phone' => $register->student->phone ?? 'تعیین نشده',
                        'name_family' => $name_family,
                        'base_id' => $register->educationBase->id ?? null,
                        'base_name' => $register->educationBase->base_title ?? 'تعیین نشده',
                        'class_id' => $register->educationClass->id ?? null,
                        'class_name' => $register->educationClass->class_title ?? 'تعیین نشده',
                        'custom_fields'=>$result
                    ];
                }
            }
        }
        return response()->json(['students'=>$students,'headers'=>$headerColumns,'public_headers'=>$public_header_columns]);
    }

    public function checkStudentFields($student)
    {
        $field_data=[];
        //$mimeTypes=['text','number','textarea'];
         $all_public = CustomizeField::query()
            ->where('field_active',1)
            ->where('check_class_public',1)
            ->get();
         if ($all_public->isNotEmpty()){
             foreach ($all_public as $public){
                 //if (in_array($public->field_type,$mimeTypes)){}
                 $field_value = CustomizeFieldValue::query()
                     ->where('field_name',$public->field_name_latin)
                     ->where('user_id',$student->id)
                     ->first();
                 $field_data[]=[
                     'label'=>$public->field_name,
                     'field'=>$public->field_name_latin,
                     'value'=>$field_value->value ?? ""
                 ];
             }
         }

         return $field_data;

    }

    public function destroy($id)
    {
        User::destroy($id);
        return 'success';
    }

   /*  public function fetchHeaderColumns($classes)
    {
        $heads=[];
        if ($classes->isNotEmpty()){
            foreach ($classes as $class) {
                $student_fields = CustomizeFieldStudent::query()
                    ->where('class_id',$class->class_id)->get();
                if ($student_fields->isNotEmpty()){
                    foreach ($student_fields as $st_field){
                        $field = CustomizeField::query()
                            ->where('field_active',1)
                            ->where('id',$st_field->field_id)
                            ->first();
                        if ($field){
                            $heads[]=[
                                'label'=>$field->field_name,
                                'field'=>$field->field_name_latin,
                            ];
                        }
                    }
                }
            }
        }
        return $heads;
    } */

    /* public function publicHeaders()
    {
        $heads=[];
        $all_public = CustomizeField::query()
            ->where('field_active',1)
            ->where('check_class_public',1)
            ->get();
        if ($all_public->isNotEmpty()){
            foreach ($all_public as $public){
                $heads[]=[
                    'label'=>$public->field_name,
                    'field'=>$public->field_name_latin,
                ];
            }
        }
        return $heads;
    } */

}
