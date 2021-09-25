<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationFeePayment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment',
        'resnumber',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    //$table->unsignedBigInteger('user_id');
    //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //            $table->string('amount');
    //            $table->boolean('payment')->default(false);
    //            $table->string('resnumber');
}
