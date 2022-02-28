<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class InformacionPersonal extends Model
{
    use HasFactory;

    protected $table = 'informacion_personal';

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
