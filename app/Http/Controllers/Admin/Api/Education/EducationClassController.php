<?php


namespace App\Http\Controllers\Admin\Api\Education;

use App\EducationalBase;
use App\EducationalClass;
use App\Http\Controllers\Controller;
use App\StudentClassCourse;
use Illuminate\Http\Request;


class EducationClassController extends Controller
{

    public function baseClasses($baseId)
    {
        $base = EducationalBase::find($baseId);
        $class_list = $base->educationClasses;
        $classes=[];
        if ($class_list->isNotEmpty()) {
            foreach ($class_list as $value) {
                $regs = $value->classStudents->count();
                $c = [
                    'class_title'=>$value->class_title,
                    'registerable'=>$value->registrable,
                    'student_count'=>$regs,
                ];
                array_push($classes,$c);
            }
        }
        return response(['classes'=>$classes]);

    }


    public function store(Request $request)
    {
        return EducationalClass::create($request->all());
    }

    public function update(Request $request,$id)
    {
        $class = EducationalClass::findOrFail($id);
        return $class->update($request->all());

    }

    public function destroy($classId)
    {
        // $classId;
        $class = EducationalClass::findOrFail($classId);
        $registers = $class->classStudents;
        if ($registers->isNotEmpty()) {
            foreach ($registers as $value) {
                $value->delete();
            }
        }

         $classCourses = StudentClassCourse::query()->where('class_id',$class->id)->get();
         if ($classCourses->isNotEmpty()) {
            foreach ($classCourses as $value) {
                 $value->delete();
            }
         }

       return $class->delete();

    }

}
