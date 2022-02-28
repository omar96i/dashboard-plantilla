<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\ProductoCategoria;
use App\Models\Productos\Producto;

class ProductosCategoria extends Model
{
    use HasFactory;

    protected $table = 'productos_categorias';

    protected $fillable = [
        'producto_id',
        'categoria_id',
        'estado'
    ];

    // Relaciones start

    public function categorias(){
        return $this->belongsToMany(ProductoCategoria::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    // Relaciones end
}
