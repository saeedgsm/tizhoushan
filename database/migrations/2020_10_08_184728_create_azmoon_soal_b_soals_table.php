<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonSoalBSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_soal_b_soals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')->references('id')->on('azmoon_soalat_files')->onDelete('cascade');
           /* $table->string('tik_a')->nullable();
            $table->string('tik_b')->nullable();
            $table->string('tik_c')->nullable();
            $table->string('tik_d')->nullable();*/
            $table->string('key');
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
        Schema::dropIfExists('azmoon_soal_b_soals');
    }
}
