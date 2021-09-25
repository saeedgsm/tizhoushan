<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonSoalatFile extends Model
{
    // azmoon_type == normal

    protected $fillable = [
        'azmoon_id',
        'title',
        'pdf_file',
        'image',
    ];
    //$table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //            $table->string('title')->nullable();
    //            $table->string('file')->nullable();
    //            $table->string('file_type')->nullable();
}
