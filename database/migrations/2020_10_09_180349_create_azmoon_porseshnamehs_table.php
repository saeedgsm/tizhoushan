<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonPorseshnamehsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_porseshnamehs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
            $table->integer('number_of_question')->nullable();
            $table->text('correct_key');
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
        Schema::dropIfExists('azmoon_porseshnamehs');
    }
}
