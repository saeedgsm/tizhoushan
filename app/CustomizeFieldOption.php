<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizeFieldOption extends Model
{
    protected $fillable = [
        'field_id',
        'option_value',
    ];

    public function customizeField()
    {
        return $this->belongsTo(CustomizeField::class,'field_id');
    }
}
