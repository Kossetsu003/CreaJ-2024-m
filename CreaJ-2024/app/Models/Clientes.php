<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Clientes extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'usuario', 'contrasena', // Asegúrate de tener estos campos en tu tabla clientes
    ];

    protected $hidden = [
        'contrasena', // Oculta la contraseña al serializar el modelo
    ];
}
