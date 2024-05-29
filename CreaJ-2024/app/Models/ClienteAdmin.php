<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $ROL
 * @property $usuario
 * @property $contrasena
 * @property $nombre
 * @property $apellido
 * @property $telefono
 * @property $sexo
 * @property $created_at
 * @property $updated_at
 *
 * @property Ventaproducto[] $ventaproductos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ClienteAdmin extends Model
{


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ROL', 'usuario', 'contrasena', 'nombre', 'apellido', 'telefono', 'sexo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventaproductos()
    {
        return $this->hasMany(\App\Models\Ventaproducto::class, 'id', 'FK_Clientes');
    }


}
