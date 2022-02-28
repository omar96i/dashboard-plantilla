<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\ProductosCategoria;

class ProductoCategoria extends Model
{
    use HasFactory;

    protected $table = 'producto_categorias';

    protected $fillable = [
        'nombre'
    ];

    // Relaciones start

    public function productos(){
        return $this->belongsToMany(ProductosCategoria::class);
    }

    // Relaciones end

}
