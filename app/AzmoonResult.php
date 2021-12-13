<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AzmoonResult extends Model
{
    protected $fillable = [
        'user_id',
        'azmoon_id',
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


}
