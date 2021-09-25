<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $fillable = ['user_id','course_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
}
