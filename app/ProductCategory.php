<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'product_category_name',
        'product_category_latin',
        'product_category_label',
        'product_category_image',
        'product_category_order',
        'parent_id',
    ];

    public function childrenCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductCategory::class,'parent_id');
    }

    public function parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class,'parent_id');
    }

    public function checkLevelProductCategory(): string
    {
        if ($this->parent_id == null){
            return "سرگروه";
        }else{
            return $this->parentCategory->product_category_name;
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class,'product_category_id');
    }

    //$table->string('product_category_name')->nullable();
    //            $table->string('product_category_latin')->nullable();
    //            $table->string('product_category_label')->nullable();
    //            $table->string('product_category_image')->nullable();
    //            $table->integer('product_category_order')->default(1);
    //            $table->unsignedInteger('parent_id')->nullable();
}
