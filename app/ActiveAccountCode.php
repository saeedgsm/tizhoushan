<?php

namespace App;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActiveAccountCode extends Model
{
    protected $fillable = ['user_id' , 'code' , 'used' , 'expire'];

    public function scopeCreateCode($query , $user)
    {
        $code = $this->code();

        return $query->create([
            'user_id' => $user->id,
            'code' => $code,
            'expire' => Carbon::now()->addMinutes(15)
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    private function code()
    {
        do {
            $code = rand(1000,9999);
            $check_code = static::whereCode($code)->get();
        } while( ! $check_code->isEmpty() );

        return $code;
    }
}
