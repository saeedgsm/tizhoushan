<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
            $table->unsignedBigInteger('educational_class_id');
            $table->foreign('educational_class_id')->references('id')->on('educational_classes')->onDelete('cascade');
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
        Schema::dropIfExists('azmoon_classes');
    }
}
