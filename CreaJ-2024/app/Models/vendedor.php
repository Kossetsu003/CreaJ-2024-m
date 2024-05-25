<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendedor
 *
 * @property $id
 * @property $usuario
 * @property $ROL
 * @property $contrasena
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
class Vendedor extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario', 'ROL', 'contrasena', 'nombre', 'apellidos', 'telefono', 'numero_puesto', 'fk_mercado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mercadoLocal()
    {
        return $this->belongsTo(\App\Models\MercadoLocal::class, 'fk_mercado', 'id');
    }
    

}
