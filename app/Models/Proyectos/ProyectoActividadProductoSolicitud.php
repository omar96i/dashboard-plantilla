<?php

namespace App\Models\Proyectos;

use App\Models\Productos\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoActividadProductoSolicitud extends Model
{
    use HasFactory;
    protected $table = 'proyecto_actividad_producto_solicitudes';

    protected $fillable = [
        'actividad_id',
        'producto_id',
        'cantidad',
        'descripcion',
        'estado'
    ];

    public function actividades(){
        return $this->belongsTo(ProyectoActividad::class, 'actividad_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
