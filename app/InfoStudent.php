<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoStudent extends Model
{
    protected $fillable = [
        'user_id',
        'melli',
        'gender',
        'father',
        'state_id',
        'city_id',
        'school_name',
        'profile_image',
        'profile_image_submit',
        'tel_home',
        'tel_parent',
        'birthdate',
        'hamgam_code',
        'first_log',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // $table->string('tel_home')->nullable();
    //            $table->string('tel_parent')->nullable();
    //            $table->string('birthdate')->nullable();
}
