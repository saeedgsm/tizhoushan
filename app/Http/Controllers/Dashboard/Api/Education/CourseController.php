<?php
namespace App\Http\Controllers\Dashboard\Api\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseRequest;
use App\Http\Resources\Education\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CourseController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $sort = json_decode($request->get('sort', json_encode(['order' => 'asc', 'column' => 'created_at'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
        $items = Course::filter($request->all())
            ->orderBy($sort['column'], $sort['order'])
            ->paginate((int) $request->get('perPage', 10));
        return response()->json([
            'courses' => CourseResource::collection($items->items()),
            'pagination' => [
                'currentPage' => $items->currentPage(),
                'perPage' => $items->perPage(),
                'total' => $items->total(),
                'totalPages' => $items->lastPage()
            ]
        ]);
    }

    public function store(CourseRequest $request): JsonResponse
    {
        try {
            $request->validated();
            Course::query()->create($request->all());
            $class='success';
            $msg="اطلاعات با موفقیت ثبت گردید!";
            $ex=null;
        }catch (Throwable $ex){
            $class='error';
            $msg="عملیات با مشکل مواجه شد!";
            $ex=$ex->getMessage();
        }
        return response()->json(['class'=>$class,'message' => $msg,'ex'=>$ex]);
    }

    public function show(Course $course)
    {
        return response()->json(new CourseResource($course));
    }

    public function update(CourseRequest $request,Course $course): JsonResponse
    {
        try {
            $request->validated();
            $course->update($request->all());
            $class='success';
            $msg="اطلاعات با موفقیت آپدیت گردید!";
            $ex=null;
        }catch (Throwable $ex){
            $class='error';
            $msg="عملیات با مشکل مواجه شد!";
            $ex=$ex->getMessage();
        }
        return response()->json(['class'=>$class,'message' => $msg,'ex'=>$ex]);
    }

    public function destroy(Course $course): JsonResponse
    {
        try {
            $course->delete();
            $class='success';
            $msg="اطلاعات با موفقیت حذف گردید!";
            $ex=null;
        }catch (Throwable $ex){
            $class='error';
            $msg="عملیات با مشکل مواجه شد!";
            $ex=$ex->getMessage();
        }
        return response()->json(['class'=>$class,'message' => $msg,'ex'=>$ex]);
    }
}
