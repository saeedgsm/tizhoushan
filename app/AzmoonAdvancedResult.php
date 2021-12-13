<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AzmoonAdvancedResult extends Model
{
    protected $fillable = [
        'user_id',
        'azmoon_id',
        'book_id',
        'result',
        'start_date',
        'end_date',
        'correct_count',
        'wrong_count',
        'not_answer_count',
        'status',  // testing - completed - incomplete
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function azmoon()
    {
        return $this->belongsTo(Azmoon::class,'azmoon_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }



    // $table->unsignedBigInteger('user_id');
    //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //
    //            $table->unsignedBigInteger('azmoon_id');
    //            $table->foreign('azmoon_id')->references('id')->on('azmoons')->onDelete('cascade');
    //
    //            $table->unsignedBigInteger('book_id');
    //            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
    //
    //            $table->longText('result')->nullable();
    //            $table->string('start_date')->nullable();
    //            $table->string('end_date')->nullable();
    //            $table->integer('correct_count')->default(0);
    //            $table->integer('wrong_count')->default(0);
    //            $table->integer('not_answer_count')->default(0);
}
