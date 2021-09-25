<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizeFieldStudent extends Model
{
    protected $fillable = [
        'field_id',
        'class_id'
    ];
}
