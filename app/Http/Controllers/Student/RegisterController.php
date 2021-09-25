<?php


namespace App\Http\Controllers\Student;


use App\EducationalBase;
use App\Http\Controllers\Controller;
use App\RegisterClassStudent;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function select()
    {
        $bases = EducationalBase::all();
        return view('panel.student.baseClass.select',compact('bases'));
    }

    public function update(Request $request)
    {
        $register = RegisterClassStudent::query()->where('user_id',auth()->id())->first();
        if ($register){
            if ($register->base_id == null || $register->class_id == null){
                $register->update($request->all());
            }
        }else{
            RegisterClassStudent::create([
                'user_id'=>auth()->id(),
                'base_id'=>$request['base_id'],
                'class_id'=>$request['class_id'],
            ]);
        }
        return redirect(route('student.panel.edit'))->with('success','پایه و کلاس آموزشی شما با موفقیت ثبت گردید!');
    }
}
