<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\InfoStudent;
use App\InfoTeacher;
use App\User;
use Illuminate\Http\Request;

class InfoTeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('level','teacher')->latest()->paginate(20);
        return view('panel.admin.InfoTeachers.all',compact('teachers'));
    }

    public function create()
    {
        return view('panel.admin.InfoTeachers.create');
    }

    public function store(TeacherRequest $request)
    {
        $userData  = [
            'level'=>'teacher',
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'password'=>bcrypt($request['password']),
            'block'=>$request['block'],
        ];
        $user = User::create($userData);
        $teacherData = [
            'user_id'=>$user->id,
            'gender'=>$request['gender'],
            'resume'=>$request['resume'],
        ];
        InfoTeacher::create($teacherData);

        return redirect(route('admin.teachers.index'))->with('success','کاربر با موفقیت ثبت گردید!');
    }

    public function show(User $teacher)
    {
        $courses = $teacher->teacherCourses()->latest()->get();
        return view('panel.admin.InfoTeachers.show',compact('teacher','courses'));
    }

    public function edit(User $teacher)
    {
        $tcInfo = $teacher->teacher;
        return view('panel.admin.InfoTeachers.edit',compact('teacher','tcInfo'));
    }

    public function update(TeacherRequest $request, InfoTeacher $teacher)
    {
        $user = $teacher->user;
        if ($request['email']){
            $newEmail = $request['email'];
        }else{
            $newEmail=$user->email;
        }

        if ($request['phone']){
            $newPhone = $request['phone'];
        }else{
            $newPhone=$user->phone;
        }

        if ($request['password']){
            $newPassword = bcrypt($request['password']);
        }else{
            $newPassword = $user->password;
        }


        $userData  = [
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'email'=>$newEmail,
            'phone'=>$newPhone,
            'password'=>$newPassword,
            'block'=>$request['block'],
        ];
        $teacherData = [
            'user_id'=>$user->id,
            'gender'=>$request['gender'],
            'resume'=>$request['resume'],
        ];
        $user->update($userData);
        $teacher->update($teacherData);
        return redirect(route('admin.teachers.index'))->with('success','کاربر با موفقیت ویرایش گردید!');
    }

    public function destroy(InfoTeacher $teacher)
    {
        $user = $teacher->user;
        $user->delete();
        return redirect(route('admin.teachers.index'))->with('success','کاربر با موفقیت حذف گردید!');
    }
}
