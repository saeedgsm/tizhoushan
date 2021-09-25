<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('melli')->nullable();
            $table->enum('gender',['male','female','unselect'])->nullable()->default('unselect');
            $table->string('father')->nullable();
            $table->string('school_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->tinyInteger('profile_image_submit')->default(0);
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();

            // part 2
            $table->string('tel_home')->nullable();
            $table->string('tel_parent')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('hamgam_code')->nullable();
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
        Schema::dropIfExists('info_students');
    }
}
