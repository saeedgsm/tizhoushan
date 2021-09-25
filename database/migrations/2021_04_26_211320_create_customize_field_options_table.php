<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeFieldOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_field_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->nullable();
            $table->foreign('field_id')->references('id')->on('customize_fields')->onDelete('cascade');
            $table->string('option_value')->nullable();
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
        Schema::dropIfExists('customize_field_options');
    }
}
