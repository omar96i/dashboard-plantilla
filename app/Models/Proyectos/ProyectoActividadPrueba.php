<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoActividadPrueba extends Model
{
    use HasFactory;

    protected $table = 'proyecto_actividad_pruebas';

    protected $fillable = [
        'actividad_id',
        'descripcion',
        'files',
        'fecha',
    ];

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'actividad_id');
    }
}
