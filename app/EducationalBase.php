<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalBase extends Model
{
    protected $fillable = [
        'base_title',
        'base_label',
    ];

    public function educationClasses()
    {
        return $this->hasMany(EducationalClass::class,'base_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class,'book_educational_base');
    }
}
