<?php

namespace App\Models\Cotizaciones;

use App\Models\EmpresaDato;
use App\Models\Users\User;
use App\Models\Cotizaciones\SubCotizacion;
use App\Models\Dolar\DolarValor;
use App\Models\Proyectos\Proyecto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'user_id',
        'empresa_datos_id',
        'dolar_id',
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

    public function abonos(){
        return $this->hasMany(CotizacionAbono::class);
    }

    public function proyecto(){
        return $this->hasOne(Proyecto::class);
    }

    public function dolar(){
        return $this->belongsTo(DolarValor::class, 'dolar_id');
    }

    public function files(){
        return $this->hasMany(CotizacionFile::class, 'cotizacion_id');
    }

    // Relaciones end
}
