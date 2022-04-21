<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectoActividadFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyecto_actividad_files';
    protected $softDelete = true;

    protected $fillable = [
        'proyecto_actividad_id',
        'file',
        'tipo'
    ];

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'proyecto_actividad_id');
    }

}
