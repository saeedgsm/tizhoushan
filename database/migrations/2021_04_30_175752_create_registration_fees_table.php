<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // این قسمت لغو شده است
        Schema::create('registration_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_id');
            $table->tinyInteger('status')->default(0);
            $table->string('cost')->default(0)->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('registration_fees');
    }
}
