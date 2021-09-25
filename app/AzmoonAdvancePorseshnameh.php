<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonAdvancePorseshnameh extends Model
{
    protected $fillable = [
        'azmoon_id',
        'book_id',
        'number_of_question',
        'correct_key',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    //  $table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //            $table->unsignedBigInteger('book_id');
    //            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
    //            $table->integer('number_of_question')->nullable();
    //            $table->text('correct_key');
}
