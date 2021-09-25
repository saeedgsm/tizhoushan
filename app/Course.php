<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_title',
        'course_image',
        'status',
    ];

    public function classes()
    {
        return $this->hasMany(StudentClassCourse::class,'class_id');
    }
}
