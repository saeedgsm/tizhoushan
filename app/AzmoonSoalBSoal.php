<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonSoalBSoal extends Model
{
    protected $fillable = [
        'azmoon_id',
        'file_id',
        'tik_a',
        'tik_b',
        'tik_c',
        'tik_d',
        'key',
    ];

    public function azmoonSoalatfile()
    {
        return $this->belongsTo(AzmoonSoalatFile::class,'file_id');
    }
    //$table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //            $table->unsignedBigInteger('file_id');
    //            $table->foreign('file_id')->references('id')->on('azmoon_soalat_files')->onDelete('cascade');
    //            $table->string('tik_a')->nullable();
    //            $table->string('tik_b')->nullable();
    //            $table->string('tik_c')->nullable();
    //            $table->string('tik_d')->nullable();
    //            $table->string('key');
}
