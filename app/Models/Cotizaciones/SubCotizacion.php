<?php

namespace App\Models\Cotizaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cotizaciones\Cotizacion;
use App\Models\Cotizaciones\SubCotizacionObservacion;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Cotizaciones\SubCotizacionManoObra;

class SubCotizacion extends Model
{
    use HasFactory;

    protected $table = 'sub_cotizaciones';

    protected $fillable = [
        'cotizacion_id',
        'area',
        'descripcion'
    ];

    // Relaciones start

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    public function observaciones(){
        return $this->hasMany(SubCotizacionObservacion::class);
    }

    public function productos(){
        return $this->hasMany(SubCotizacionProducto::class);
    }

    public function manoObra(){
        return $this->hasOne(SubCotizacionManoObra::class);
    }

    // Relaciones end

}
