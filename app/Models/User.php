<?php

namespace App\Models;

use App\ActiveAccountCode;
use App\AzmoonPayment;
use App\InfoCadre;
use App\InfoStudent;
use App\RegisterClassStudent;
use App\ShopCart;
use App\TeacherCourse;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level',
        'usercode',
        'userpass',
        'email',
        'password',
        'block',
        'active',
        'avatar',
        'avatar_check',
        'first_name',
        'last_name',
        'username',
        'phone',
        'private_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->level == 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->level == 'teacher';
    }

    public function isAgency(): bool
    {
        return $this->level == 'agency';
    }

    public function isOffice(): bool
    {
        return $this->level === 'office';
    }

    public function isStudent(): bool
    {
        return $this->level === 'student';
    }

    public function userAvatar()
    {
        $img['url']=$this->avatar;
        if ($img['url'] === null || ! file_exists(public_path($img['url'])))
            $img['url'] = "imgs/profile.jpg";
        return $img['url'];
    }

    public function student(): HasOne
    {
        return $this->hasOne(InfoStudent::class,'user_id');
    }

    public function studentBaseClass(): HasOne
    {
        return $this->hasOne(RegisterClassStudent::class,'user_id');
    }

    public function teacherCourses(): HasMany
    {
        return $this->hasMany(TeacherCourse::class,'user_id');
    }

    public function scopeSearch($query, $q)
    {
        return $query
            ->where('first_name','LIKE',"%{$q}%")
            ->orWhere('last_name','LIKE',"%{$q}%");
    }

    public function activeAccountCodes(): HasMany
    {
        return $this->hasMany(ActiveAccountCode::class);
    }

    public function cadre(): HasOne
    {
        return $this->hasOne(InfoCadre::class);
    }

    public function shopCarts(): HasMany
    {
        return $this->hasMany(ShopCart::class,'user_id');
    }

    public function azmoonPayments(): HasMany
    {
        return $this->hasMany(AzmoonPayment::class,'user_id');
    }
}
