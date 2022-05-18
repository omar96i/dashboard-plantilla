<?php

namespace App\Models\Proyectos;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoActividadAsistencia extends Model
{
    use HasFactory;
    protected $table = 'proyecto_actividad_asistencias';

    protected $fillable = [
        'actividad_id',
        'user_id',
        'latitude',
        'longitude',
        'url',
        'fecha',
        'time'
    ];

    public function tecnico(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'actividad_id');
    }

    public static function verificar($actividad_id, $fecha){
        return self::where('actividad_id', $actividad_id)->where('fecha', $fecha)->count();
    }
}
