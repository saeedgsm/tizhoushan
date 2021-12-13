<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AzmoonPayment extends Model
{
    protected $fillable = [
        'user_id',
        'azmoon_id',
        'gateway',
        'amount',
        'resnumber',
        'status',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function azmoon()
    {
        return $this->belongsTo(Azmoon::class,'azmoon_id');
    }
    //$table->unsignedBigInteger('user_id');
    //            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
    //            $table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->cascadeOnDelete();
    //
    //            $table->string('gateway')->nullable();
    //            $table->string('amount')->nullable();
    //            $table->string('resnumber')->nullable();
    //            $table->tinyInteger('status')->default(0);
    //            $table->dateTime('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
}
