<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'product_code',
        'product_name',
        'product_latin',
        'product_label',
        'product_body',
        'product_type',
        'product_type_payment',
        'product_price',
        'product_image',
        'product_status',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // $table->unsignedBigInteger('product_category_id');
    //            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
    //            $table->string('product_code')->nullable();
    //            $table->string('product_name')->nullable();
    //            $table->string('product_latin')->nullable();
    //            $table->string('product_label')->nullable();
    //            $table->longText('product_body')->nullable();
    //            $table->string('product_type')->nullable(); // Physical or virtual
    //            $table->string('product_type_payment')->nullable(); // cash or free
    //            $table->string('product_price')->nullable();
    //            $table->string('product_image')->nullable();
}
