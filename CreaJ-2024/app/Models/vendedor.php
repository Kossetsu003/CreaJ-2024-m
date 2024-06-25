<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Vendedor
 *
 * @property $id
 * @property $usuario
 * @property $ROL
 * @property $password
 * @property $nombre
 * @property $apellidos
 * @property $telefono
 * @property $numero_puesto
 * @property $fk_mercado
 * @property $created_at
 * @property $updated_at
 *
 * @property MercadoLocal $mercadoLocal
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vendedor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario',
        'ROL',
        'password', // Cambiado de 'contrasena' a 'password'
        'nombre',
        'apellidos',
        'telefono',
        'numero_puesto',
        'fk_mercado'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mercadoLocal()
    {
        return $this->belongsTo(\App\Models\MercadoLocal::class, 'fk_mercado', 'id');
    }
}
