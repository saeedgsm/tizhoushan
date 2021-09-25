<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * id azmoon
 */
class Azmoon extends Model
{
    protected $fillable = [
        'book_id',
        'azmoon_code',
        'azmoon_title',
        'azmoon_type',
        'azmoon_for',
        'price',
        'azmoon_sync_time',
        'type_payment',
        'azmoon_start',
        'azmoon_end',
        'azmoon_time',
        'azmoon_sync',
        'azmoon_status',
        'class_type', // all or elective
    ];

    public function soal()
    {
        return $this->hasOne(AzmoonSoalat::class,'azmoon_id');
    }

    public function soalatFiles()
    {
        return $this->hasMany(AzmoonSoalatFile::class,'azmoon_id');
    }

    public function porseshnamehs()
    {
        return $this->hasMany(AzmoonPorseshnameh::class,'azmoon_id');
    }

    public function porseshnameh()
    {
        return $this->hasOne(AzmoonPorseshnameh::class,'azmoon_id');
    }

    public function soalbsoals()
    {
        return $this->hasMany(AzmoonSoalBSoal::class,'azmoon_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    public function scopeAzmoonCodeGenerates()
    {
        do{
            $pool = 'abcdefghijklmnopqrstuvwxyz';
            $newCode = substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
            $checkCode = static::where('azmoon_code',$newCode)->get();
        }while( $checkCode->isNotEmpty() );
        return $newCode;
    }

    public function AzmoonResults()
    {
        return $this->hasMany(AzmoonResult::class,'azmoon_id');
    }

    public function AzmoonPorseshnamehResults()
    {
        return $this->hasMany(AzmoonResult::class,'azmoon_id');
    }

    public function azmoonBooks()
    {
        return $this->hasMany(AzmoonBook::class,'azmoon_id');
    }

    public function advancedFiles()
    {
        return $this->hasMany(AzmoonAdvancedFile::class,'azmoon_id');
    }

    public function advancedPorseshnamehs()
    {
        return $this->hasMany(AzmoonAdvancePorseshnameh::class,'azmoon_id');
    }

    public function azmoonClasses()
    {
        return $this->hasMany(AzmoonClass::class,'azmoon_id');
    }

}
