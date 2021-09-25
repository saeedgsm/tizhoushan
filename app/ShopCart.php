<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'shop_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
