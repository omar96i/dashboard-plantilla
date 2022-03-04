<?php

namespace App\Models\Cotizaciones;

use App\Models\EmpresaDato;
use App\Models\Users\User;
use App\Models\Cotizaciones\SubCotizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'user_id',
        'empresa_datos_id',
        'nombre_facturar',
        'cliente_proyecto',
        'documento',
        'direccion',
        'telefono',
        'fecha',
        'email',
        'estado'
    ];

    // Relaciones start

    public function whoCreated(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function datosEmpresa(){
        return $this->belongsTo(EmpresaDato::class, 'empresa_datos_id');
    }

    public function subCotizaciones(){
        return $this->hasMany(SubCotizacion::class);
    }

    // Relaciones end
}
