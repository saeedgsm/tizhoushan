<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonExclusivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_exclusives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')
                ->on('azmoons')->onDelete('cascade');
            $table->unsignedBigInteger('base_id');
            $table->string('classes')->nullable();
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
        Schema::dropIfExists('azmoon_exclusives');
    }
}
