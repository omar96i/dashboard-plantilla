<?php

namespace App\Models\Proyectos;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectoActividadReporte extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyecto_actividad_reportes';
    protected $softDelete = true;

    protected $fillable = [
        'producto_id',
        'usuario_id',
        'actividad_id',
        'cantidad',
        'descripcion',
        'fecha',
        'estado'
    ];

    public function producto(){
        return $this->belongsTo(ProyectoActividadProducto::class, 'producto_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function actividad(){
        return $this->belongsTo(ProyectoActividad::class, 'actividad_id');
    }

    public static function getDatos(){
        return self::with('usuario.informacionPersonal', 'actividad', 'producto.productos.productos')->get();
    }
}
