<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AzmoonBook extends Model
{
    protected $fillable = [
        'azmoon_id',
        'book_id',
        'azmoon_type', // normal || advance
    ];

    public function azmoon()
    {
        return $this->belongsTo(Azmoon::class,'azmoon_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }


}
