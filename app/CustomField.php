<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = [
        'custom_field_name',
        'field_list',
        'table_task',
    ];
    // $table->string('custom_field_name')->nullable();
    //            $table->text('field_list')->nullable();
    //            $table->string('table_task')->nullable();
}
