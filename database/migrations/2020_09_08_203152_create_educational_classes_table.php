<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_id');
            $table->foreign('base_id')->references('id')->on('educational_bases')->onDelete('cascade');
            $table->string('class_title')->nullable();
            $table->string('class_label')->nullable();
            $table->tinyInteger('registrable')->default(1)->nullable();
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
        Schema::dropIfExists('educational_classes');
    }
}
