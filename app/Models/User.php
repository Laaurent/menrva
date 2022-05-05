<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'user_type_id',
        'city',
        'city_department',
        'resume'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',

    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $appends = [
        'lastFormationDate',
        'isLikedByAuthUser',
    ];




    public function formations()
    {
        return $this->hasMany(Formation::class)->latest();
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class)->latest();
    }
    public function likes()
    {
        if (Auth::check()) {
            return $this->hasMany(Like::class, 'user_liked_id')->where('user_id', Auth::id());
        } else
            return $this->hasMany(Like::class, 'user_liked_id')->where('user_id', 0);
    }
    public function lastExperience()
    {
        return $this->experiences()->latest()->take(1);
    }
    public function lastFormation()
    {
        return $this->formations()->latest();
    }
    public function getisLikedByAuthUserAttribute()
    {
        return count($this->likes) > 0;
    }

    public function getlastFormationDateAttribute()
    {
        return count($this->lastFormation) > 0 ? $this->lastFormation[0]->end_date : null;
    }
}
