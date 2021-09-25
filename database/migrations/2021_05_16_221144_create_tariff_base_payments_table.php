<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffBasePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariff_base_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('tariff_id')->nullable();
            $table->foreign('tariff_id')->references('id')->on('tariff_bases')->onDelete('cascade');
            $table->string('amount')->nullable();
            $table->boolean('payment')->default(false);
            $table->string('resnumber')->nullable();
            $table->string('desc')->nullable();
            $table->string('type_payment')->default('online');
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
        Schema::dropIfExists('tariff_base_payments');
    }
}
