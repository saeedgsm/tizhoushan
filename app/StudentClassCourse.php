<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClassCourse extends Model
{
    protected $fillable = [
        //'user_id',
        'course_id',
        'class_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function class(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EducationalClass::class,'class_id');
    }

    //      $table->unsignedBigInteger('user_id');
    //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //
    //            $table->unsignedBigInteger('course_id')->nullable();
    //            $table->foreign('course_id')->references('id')->on('courses');
    //
    //            $table->unsignedBigInteger('class_id')->nullable();
    //            $table->foreign('class_id')->references('id')->on('educational_classes');
}
