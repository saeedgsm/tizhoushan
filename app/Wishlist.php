<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'wishlist_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    // $table->unsignedBigInteger('user_id');
    //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //            $table->unsignedBigInteger('product_id');
    //            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    //            $table->integer('wishlist_count')->default(1);
}
