<?php

namespace App\Models\Proyectos;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectoActividad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyecto_actividades';
    protected $softDelete = true;

    protected $fillable = [
        'proyecto_id',
        'empleado_id',
        'usuario_id',
        'descripcion',
        'finalizacion_descripcion',
        'fecha_inicio',
        'fecha_final',
        'estado'
    ];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function whoCreated(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function empleado(){
        return $this->belongsTo(User::class, 'empleado_id');
    }

    public function files(){
        return $this->hasMany(ProyectoActividadFile::class);
    }

    public function inventario(){
        return $this->hasMany(ProyectoActividadProducto::class);
    }

    public function reportes(){
        return $this->hasMany(ProyectoActividadReporte::class, 'actividad_id');
    }

    public function pruebas(){
        return $this->hasOne(ProyectoActividadPrueba::class, 'actividad_id');
    }

    public function solicitudes(){
        return $this->hasMany(ProyectoActividadProductoSolicitud::class, 'actividad_id');
    }
}
