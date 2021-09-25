<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonSoalatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_soalats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
            $table->string('soal_title')->nullable();
            $table->string('soal_cover')->nullable();
            $table->string('soal_label')->nullable();
            $table->string('soal_count')->nullable();
            $table->string('type')->nullable(); // poreshnameh YA soal_b_soal
            $table->string('answer_type')->nullable(); // a,b,c,d OR اف ...
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
        Schema::dropIfExists('azmoon_soalats');
    }
}
