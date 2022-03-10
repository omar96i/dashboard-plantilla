<?php

namespace App\Models\Iva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iva extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ivas';
    protected $softDelete = true;

    protected $fillable = [
        'valor'
    ];
}
