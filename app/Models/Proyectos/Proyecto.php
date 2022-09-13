<?php

namespace App\Models\Proyectos;

use App\Models\Cotizaciones\Cotizacion;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyectos';
    protected $softDelete = true;

    protected $fillable = [
        'usuario_id',
        'cotizacion_id',
        'nombre',
        'fecha_inicial',
        'fecha_final',
        'estado'
    ];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function whoCreated(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function planos(){
        return $this->hasMany(ProyectoPlano::class);
    }

    public static function inventario($id){
        return self::with('cotizacion.subCotizaciones.productos.productos.categoria')->where('id', $id)->get();
    }

    public function actividades(){
        return $this->hasMany(ProyectoActividad::class);
    }

    public function interventorias(){
        return $this->hasMany(ProyectoInterventoria::class, 'proyecto_id');
    }
}
