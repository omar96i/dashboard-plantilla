<?php

namespace App\Models\Proyectos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Productos\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoActividadProducto extends Model
{
    use HasFactory;

    protected $table = 'proyecto_actividad_productos';


    protected $fillable = [
        'sub_cotizacion_producto_id',
        'producto_id',
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

    public function productos_secundarios(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function reportes(){
        return $this->hasMany(ProyectoActividadReporte::class);
    }

    public static function validarProducto($id, $actividad_id){
        return self::where('sub_cotizacion_producto_id', $id)->where('proyecto_actividad_id', $actividad_id)->count();
    }
    public static function validarProductoSecundario($id, $actividad_id){
        return self::where('producto_id', $id)->where('proyecto_actividad_id', $actividad_id)->count();
    }

    public static function getInventario($actividad_id){
        return self::where('proyecto_actividad_id', $actividad_id)->with('productos.productos.categoria')->get();
    }

    public static function getInventarioSecundario($actividad_id){
        return self::where('proyecto_actividad_id', $actividad_id)->with('productos_secundarios.categoria')->get();
    }
}
