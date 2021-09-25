<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    protected $fillable = [
        'base_id',
        'status',
        'cost',
        'desc',
    ];

    public function base()
    {
        return $this->belongsTo(EducationalBase::class,'base_id');
    }
    //  $table->tinyInteger('status')->default(0);
    //            $table->string('cost')->default(0)->nullable();
    //            $table->text('desc')->nullable();
}
