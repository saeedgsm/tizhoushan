<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_name',
        'zarib',
        'nomreh_manfi',
        'nomreh',
    ];

    public function bases()
    {
        return $this->belongsToMany(EducationalBase::class);
    }

    public function azmoons()
    {
        return $this->hasMany(AzmoonBook::class,'book_id');
    }

    //$table->string('book_name')->nullable();
    //            $table->integer('zarib')->nullable();
    //            $table->integer('nomreh_manfi')->nullable();
    //            $table->integer('nomreh')->nullable();
}
