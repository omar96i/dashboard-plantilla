<?php

namespace App\Models;

use App\Models\UserPersonalInformation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
		'role_user'
	];

    public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

    public function PersonalInformation(){
        return $this->hasOne(UserPersonalInformation::class);
    }

    public function getRoleUserAttribute()
	{
		return $this->getRoleNames();
	}

}
