<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoons', function (Blueprint $table) {
            $table->id();
           // $table->unsignedBigInteger('book_id')->nullable();
            $table->string('azmoon_code')->nullable();
            $table->string('azmoon_title')->nullable();
            $table->string('price')->nullable();
            $table->string('type_payment')->nullable(); // free or cash
            $table->text('desc')->nullable();
            $table->string('azmoon_type')->nullable(); // normal or advance
            $table->string('azmoon_for')->default('exam')->nullable(); // survey or exam
            $table->string('azmoon_start')->nullable();
            $table->string('azmoon_end')->nullable();
            $table->string('azmoon_time')->nullable();
            $table->string('class_type')->default('all')->nullable(); // all or elective
            $table->tinyInteger('azmoon_status')->default(0)->nullable();
            $table->tinyInteger('azmoon_sync')->default(0)->nullable();
            $table->integer('azmoon_sync_time')->default(0)->nullable();
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
        Schema::dropIfExists('azmoons');
    }
}
