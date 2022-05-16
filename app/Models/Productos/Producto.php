<?php

namespace App\Models\Productos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\ProductoValor;
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
        'foto'
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

    public function solicitudes(){
        return $this->hasMany(ProyectoActividadProductoSolicitud::class, 'producto_id');
    }

    public static function findByIdSubCotizacion($id)
	{
		return self::whereHas('subCotizaciones', function ($query) use ($id) {
			$query->where(['sub_cotizacion_id' => $id, 'estado' => 'activo']);
		})->with('valores', 'subCotizaciones')->get();
	}

    // Relaciones end

}
