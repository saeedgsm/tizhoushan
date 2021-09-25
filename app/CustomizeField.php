<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizeField extends Model
{
    protected $fillable = [
        'field_name',
        'field_name_latin',
        'field_type',
        'field_model',
        'field_length',
        'field_default_value',
        'field_required',
        'field_filter',
        'field_active',
        'field_help',
        'check_class_public',
    ];

    public function fieldOptions()
    {
        return $this->hasMany(CustomizeFieldOption::class,'field_id');
    }

    public function scopeFieldLatinGenerates()
    {
        do{
            $pool = 'abcdefghijklmnopqrstuvwxyz';
            $newCode = substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
            $checkCode = static::where('field_name_latin',$newCode)->get();
        }while( $checkCode->isNotEmpty() );
        return $newCode;
    }

    public function studentField()
    {
        return $this->hasMany(CustomizeFieldStudent::class,'field_id');
    }
}
