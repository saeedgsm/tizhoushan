<?php

namespace App\Http\Resources\Education;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Course $course */
        $course=$this;
        return [
            'id'=>$course->id,
            'course_title'=>$course->course_title,
            'course_image'=>asset($course->course_image),
            'status'=>$course->status,
            'created_at' => $course->created_at->toISOString(),
            'updated_at' => $course->updated_at->toISOString()
        ];

    }
}
