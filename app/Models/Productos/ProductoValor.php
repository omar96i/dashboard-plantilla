<?php

namespace App\Models\Productos;

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
        'tipo'
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
