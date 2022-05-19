<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoActividadReagendamiento extends Model
{
    use HasFactory;
    protected $table = 'proyecto_actividad_reagendamientos';

    protected $fillable = [
        'actividad_id',
        'descripcion',
        'fecha_inicio',
        'fecha_final',
    ];

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'actividad_id');
    }

}
