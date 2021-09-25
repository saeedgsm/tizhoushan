<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonExclusive extends Model
{
    protected $fillable = ['azmoon_id','base_id','classes'];

    public function azmoon()
    {
        return $this->belongsTo(Azmoon::class,'azmoon_id');
    }

    public function base()
    {
        return $this->belongsTo(EducationalBase::class,'base_id');
    }
}
