<?php

namespace App\Models\Proyectos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectoActividadProducto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyecto_actividad_productos';
    protected $softDelete = true;

    protected $fillable = [
        'sub_cotizacion_producto_id',
        'proyecto_actividad_id',
        'cantidad',
        'estado'
    ];

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'proyecto_actividad_id');
    }

    public function productos(){
        return $this->belongsTo(SubCotizacionProducto::class, 'sub_cotizacion_producto_id');
    }
}
