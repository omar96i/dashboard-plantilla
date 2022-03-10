<?php

namespace App\Models\Users;

use App\Models\Cotizaciones\Cotizacion;
use App\Models\Proyectos\Proyecto;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Users\InformacionPersonal;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
		'role_user'
	];

    protected $dates = ['deleted_at'];

    // Relaciones start

    public function informacionPersonal(){
        return $this->hasOne(InformacionPersonal::class);
    }

    public function cotizacionesCreadas(){
        return $this->hasMany(Cotizacion::class);
    }

    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }

    // Relaciones end

    // Mutadores

    public function getRoleUserAttribute()
	{
		return $this->getRoleNames();
	}

    ////Auto encriptado
    public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}


}
