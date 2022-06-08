<?php

namespace App\Models\Productos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\Producto;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoValor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'producto_valores';
    protected $softDelete = true;

    protected $fillable = [
        'producto_id',
        'valor',
        'sub_valor',
        'porcentaje',
        'tipo'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function sub_cotizacion_productos(){
        return $this->hasMany(SubCotizacionProducto::class, 'producto_valor_id');
    }
}
