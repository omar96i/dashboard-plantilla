<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;

    protected $table = 'productos_categorias';

    protected $fillable = [
        'producto_id',
        'categoria_id',
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
