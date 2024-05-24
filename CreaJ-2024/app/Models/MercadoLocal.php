<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MercadoLocal
 *
 * @property $id
 * @property $nombre
 * @property $imagen_referencia
 * @property $municipio
 * @property $ubicacion
 * @property $horaentrada
 * @property $horasalida
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Vendedor[] $vendedores
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MercadoLocal extends Model
{


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'imagen_referencia', 'municipio', 'ubicacion', 'horaentrada', 'horasalida', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores()
    {
        return $this->hasMany(\App\Models\Vendedor::class, 'id', 'fk_mercado');
    }


}
