<?php

namespace App\Models\Productos;

use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Productos\ProductosCategoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto'
    ];

    // Relaciones start

    public function subCotizaciones(){
        return $this->hasMany(SubCotizacionProducto::class);
    }

    public function categorias(){
        return $this->hasMany(ProductosCategoria::class);
    }

    // Relaciones end

}
