<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterClassStudent extends Model
{
    protected $fillable = [
        'user_id',
        'base_id',
        'class_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function educationBase()
    {
        return $this->belongsTo(EducationalBase::class,'base_id');
    }

    public function educationClass()
    {
        return $this->belongsTo(EducationalClass::class,'class_id');
    }
}
