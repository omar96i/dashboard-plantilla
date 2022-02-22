<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserPersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'documento',
        'nombres',
        'apellidos',
        'telefono',
        'sexo',
        'fecha_nacimiento',
        'ciudad',
        'foto',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
