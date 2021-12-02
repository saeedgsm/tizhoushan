<?php


namespace App\Http\Controllers\Admin\Api\Course;


use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->all());
        return 'success';
    }

    public function getCourse($id)
    {
        $course = Course::query()->where('id',$id)->first();
        return response()->json($course);
    }

    public function update($id, Request $request)
    {
        $course = Course::query()->where('id',$id)->first();
        $course->update($request->all());
        return 'success';
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return 'success';
    }
}
