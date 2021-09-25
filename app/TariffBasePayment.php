<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TariffBasePayment extends Model
{
    protected $fillable = [
        'tariff_id',
        'user_id',
        'amount',
        'payment',
        'resnumber',
        'type_payment',
        'desc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tariff_base()
    {
        return $this->belongsTo(TariffBase::class,'tariff_id');
    }
}
