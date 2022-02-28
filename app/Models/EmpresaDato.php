<?php

namespace App\Models;

use App\Models\Cotizaciones\Cotizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaDato extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon',
        'nit',
        'telefono',
        'cuenta_corriente',
        'email',
        'estado'
    ];

    // Relaciones start

    public function cotizaciones(){
        return $this->hasMany(Cotizacion::class);
    }

    // Relaciones end
}
