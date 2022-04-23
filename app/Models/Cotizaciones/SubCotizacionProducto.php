<?php

namespace App\Models\Cotizaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotizaciones\SubCotizacion;
use App\Models\Productos\Producto;
use App\Models\Proyectos\ProyectoActividadProducto;

class SubCotizacionProducto extends Model
{
    use HasFactory;

    protected $table = 'sub_cotizaciones_productos';

    protected $fillable = [
        'producto_id',
        'sub_cotizacion_id',
        'cantidad',
        'estado'
    ];

    // Relaciones start

    public function productos(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function subCotizacion(){
        return $this->belongsTo(SubCotizacion::class, 'sub_cotizacion_id');
    }

    public function actividad_inventario(){
        return $this->hasMany(ProyectoActividadProducto::class);
    }

    // Relaciones end

    public static function getInventario($id){
        return self::whereHas('subCotizacion.cotizacion.proyecto', function ($query) use($id) {
            $query->where('id', '=', $id);
        })->with('productos')->get();
    }

    public static function validar($id, $cantidad){
        return self::where('id', '=', $id)->where('cantidad', '<', $cantidad)->count();
    }
}
