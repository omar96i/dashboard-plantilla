<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Proyectos\Proyecto;
use App\Models\Users\User;

class ProyectoPlano extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proyecto_planos';
    protected $softDelete = true;

    protected $fillable = [
        'proyecto_id',
        'usuario_id',
        'descripcion',
        'file',
        'estado'
    ];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function whoCreated(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
