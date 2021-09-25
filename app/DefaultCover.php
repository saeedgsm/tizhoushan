<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultCover extends Model
{
    protected $fillable = [
        'cover_name',
        'cover_loc',
        'cover_url',
    ];


    //$table->string('cover_name')->nullable();
    //            $table->string('cover_loc')->nullable();
    //            $table->text('cover_url')->nullable();
}
