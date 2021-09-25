<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalClass extends Model
{
    protected $fillable = [
        'base_id',
        'class_title',
        'class_label',
        'registrable',
    ];

    public function educationBase()
    {
        return $this->belongsTo(EducationalBase::class,'base_id');
    }

    public function classStudents()
    {
        return $this->hasMany(RegisterClassStudent::class,'class_id');
    }

    public function classCourses()
    {
        return $this->hasMany(StudentClassCourse::class,'class_id');
    }
}
