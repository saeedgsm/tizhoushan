<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('private_code')->nullable();
            $table->tinyInteger('block')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->string('level')->default('user');
            $table->string('avatar')->nullable();
            $table->tinyInteger('avatar_check')->default(0)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('usercode')->nullable();
            $table->string('userpass')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
           // $table->timestamp('password_updated_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'level'=>'admin',
                'email'=>'admin@admin.com',
                'first_name'=>'saeed',
                'last_name'=>'gsm',
                'password'=>bcrypt('11111111'),
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
