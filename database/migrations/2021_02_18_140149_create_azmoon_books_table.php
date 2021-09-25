<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAzmoonBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('azmoon_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('azmoon_id');
            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

            $table->string('azmoon_type')->nullable();

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
        Schema::dropIfExists('azmoon_books');
    }
}
