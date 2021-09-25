<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_latin')->nullable();
            $table->string('product_label')->nullable();
            $table->longText('product_body')->nullable();
            $table->string('product_type')->nullable(); // Physical or virtual
            $table->string('product_type_payment')->nullable(); // cash or free
            $table->string('product_price')->nullable();
            $table->string('product_image')->nullable();
            $table->tinyInteger('product_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
