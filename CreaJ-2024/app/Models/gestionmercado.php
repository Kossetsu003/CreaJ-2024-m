<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gestionmercado extends Model
{
    use HasFactory;

    protected $table = 'mercado_local';

    protected $fillable = [
        'nombre',
        'imagen_referencia',
        'municipio',
        'ubicacion',
        'horaentrada',
        'horasalida',
        'descripcion'
    ];

}
