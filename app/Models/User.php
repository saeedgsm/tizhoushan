<?php

namespace App\Models;

use App\ActiveAccountCode;
use App\AzmoonPayment;
use App\InfoCadre;
use App\InfoStudent;
use App\RegisterClassStudent;
use App\ShopCart;
use App\TeacherCourse;
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

    public function isAdmin()
    {
        return $this->level == 'admin';
    }

    public function isTeacher()
    {
        return $this->level == 'teacher';
    }

    public function isAgency()
    {
        return $this->level == 'agency';
    }

    public function isOffice()
    {
        return $this->level === 'office';
    }

    public function isStudent()
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

    public function student()
    {
        return $this->hasOne(InfoStudent::class,'user_id');
    }

    public function studentBaseClass()
    {
        return $this->hasOne(RegisterClassStudent::class,'user_id');
    }


    public function teacherCourses()
    {
        return $this->hasMany(TeacherCourse::class,'user_id');
    }

    public function scopeSearch($query, $q)
    {
        return $query
            ->where('first_name','LIKE',"%{$q}%")
            ->orWhere('last_name','LIKE',"%{$q}%");
    }

    public function activeAccountCodes()
    {
        return $this->hasMany(ActiveAccountCode::class);
    }

    public function cadre()
    {
        return $this->hasOne(InfoCadre::class);
    }

    public function shopCarts()
    {
        return $this->hasMany(ShopCart::class,'user_id');
    }

    public function azmoonPayments()
    {
        return $this->hasMany(AzmoonPayment::class,'user_id');
    }
}
