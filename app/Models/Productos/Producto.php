<?php

namespace App\Models\Productos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\ProductoValor;
use App\Models\Proyectos\ProyectoActividadProducto;
use App\Models\Proyectos\ProyectoActividadProductoSolicitud;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';
    protected $softDelete = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'referencia',
        'marca',
        'color',
        'temperatura_calor',
        'voltaje',
        'cantidad',
        'categoria_id',
        'foto',
        'files',
        'numero',
        'codigo_utopia',
        'ubicacion',
        'provedor',
        'observacion',
        'barcode',
    ];

    // Relaciones start

    public function subCotizaciones(){
        return $this->hasMany(SubCotizacionProducto::class);
    }

    public function valores(){
        return $this->hasMany(ProductoValor::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function categorias(){
        return $this->hasMany(ProductoCategoria::class, 'producto_id');
    }

    public function solicitudes(){
        return $this->hasMany(ProyectoActividadProductoSolicitud::class, 'producto_id');
    }

    public function reabastecimientos(){
        return $this->hasMany(ProductoReabastecimiento::class, 'producto_id');
    }

    public function actividades(){
        return $this->hasMany(ProyectoActividadProducto::class, 'producto_id');
    }

    public static function findByIdSubCotizacion($id)
	{
		return self::whereHas('subCotizaciones', function ($query) use ($id) {
			$query->where(['sub_cotizacion_id' => $id, 'estado' => 'activo']);
		})->with('valores', 'subCotizaciones')->get();
	}

    public static function validar($id, $cantidad){
        return self::where('id', '=', $id)->where('cantidad', '<', $cantidad)->count();
    }

    // Relaciones end

}
