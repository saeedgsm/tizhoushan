<?php


namespace App\Http\Controllers\Admin\Api\Course;


use App\Http\Controllers\Controller;
use App\StudentClassCourse;
use Illuminate\Http\Request;


class CourseClassController extends Controller
{
    public function courseClasses($courseId)
    {
        $data = StudentClassCourse::query()->where('course_id',$courseId)->get();
        $classes=[];
        if ($data->isNotEmpty()){
            foreach ($data as $class){
                $classes[] = [
                    'id'=>$class->id,
                    'base_id'=>$class->class->base_id,
                    'base_name'=>$class->class->educationBase->base_title,
                    'class_name'=>$class->class->class_title,
                    'registrable'=>$class->class->registrable,
                ];
            }
        }
        return response()->json($classes);

    }

    public function store(Request $request)
    {
        //return $request->all();
        $classList = $request['class_list'];
        if ($classList){
            foreach ($classList as $item){
                StudentClassCourse::create([
                    'course_id'=>$request['course_id'],
                    'class_id'=>$item['id']
                ]);
            }
        }

        return $request['class_list'];
    }

    public function destroy($id)
    {
        StudentClassCourse::destroy($id);
        return 'success';
    }
}