<?php
namespace App\Http\Controllers\Dashboard\Api\Education;

use App\Http\Controllers\Controller;
use App\Http\Resources\Education\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
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
}
