<?php

namespace App\Models\Productos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\ProductoValor;
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
        'foto'
    ];

    // Relaciones start

    public function subCotizaciones(){
        return $this->hasMany(SubCotizacionProducto::class);
    }

    public function valores(){
        return $this->hasMany(ProductoValor::class);
    }

    public static function findByIdSubCotizacion($id)
	{
		return self::whereHas('subCotizaciones', function ($query) use ($id) {
			$query->where(['sub_cotizacion_id' => $id, 'estado' => 'activo']);
		})->with('valores', 'subCotizaciones')->get();
	}

    // Relaciones end

}
