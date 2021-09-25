<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_bases', function (Blueprint $table) {
            $table->id();
            $table->string('tariff_bases')->nullable();
            $table->string('tariff_label')->nullable();
            $table->string('tariff_amount')->nullable();
            $table->tinyInteger('tariff_active')->default(1)->nullable();
            $table->text('tariff_desc')->nullable();
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
        Schema::dropIfExists('tariff_bases');
    }
}
