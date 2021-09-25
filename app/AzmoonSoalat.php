<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonSoalat extends Model
{
    protected $fillable = [
        'azmoon_id',
        'soal_title',
        'soal_cover',
        'soal_label',
        'soal_count',
        'type',
        'answer_type',
    ];

    public function azmoonImage()
    {
        $img['url']=$this->soal_cover;

        if ($img['url'] == null || ! file_exists(public_path($img['url'])))
            $img['url'] = "assets/images/widget-img.png";

        return $img['url'];
    }
    //$table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //            $table->string('soal_title')->nullable();
    //            $table->string('soal_cover')->nullable();
    //            $table->string('soal_label')->nullable();
    //            $table->string('soal_count')->nullable();
    //            $table->string('type')->nullable(); // poreshnameh YA soal b soal
    //            $table->string('answer_type')->nullable(); // a,b,c,d OR اف ...
}
