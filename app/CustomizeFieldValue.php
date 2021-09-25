<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizeFieldValue extends Model
{
    protected $fillable = [
        'user_id',
        'value',
        'field_name',
        'app_model',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    //$table->unsignedBigInteger('user_id')->nullable();
    //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //            $table->text('value')->nullable();
    //            $table->string('field_name')->nullable();
    //            $table->string('app_model')->nullable();
}
