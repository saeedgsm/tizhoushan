<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\TeacherCourse;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    public function create(Request $request)
    {
        $datacourses = Course::all();
        $teacherCourses = TeacherCourse::all();
        $courses=[];
        foreach ($datacourses as $course){

             $check = $teacherCourses->where('course_id','==',$course->id)->first();

             if (!$check){
                 $courses[]=$course;
             }
        }
        $teacher = User::where('id',$request['tech_id'])->first();

        return view('panel.admin.teacherCourses.create',compact('courses','teacher'));
    }

    public function store(Request $request)
    {
        TeacherCourse::create($request->all());
        $teacher = User::where('id',$request['user_id'])->first();
        return redirect(route('admin.teachers.show',$teacher))->with('success','دوره انتخاب شده برای استاد مربوطه ثبت شد!');
    }
}
