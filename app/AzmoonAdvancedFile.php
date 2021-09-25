<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonAdvancedFile extends Model
{
    protected $fillable = [
        'azmoon_id',
        'book_id',
        'title',
        'pdf_file',
        'image',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    //   $table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //            $table->unsignedBigInteger('book_id');
    //            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
    //            $table->string('title')->nullable();
    //            $table->string('image')->nullable();
    //            $table->string('pdf_file')->nullable();
}
