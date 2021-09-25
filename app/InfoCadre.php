<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InfoCadre extends Model
{
    protected $fillable = [
        'user_id',
        'resume',
        'gender',
        'state_id',
        'city_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
