<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Exhibicionproducto
 *
 * @property $id
 * @property $Imagen
 * @property $Nombre
 * @property $Descripcion
 * @property $Precio
 * @property $fk_vendedors
 * @property $Estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Vendedor $vendedor
 * @property Ventaproducto[] $ventaproductos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Exhibicionproducto extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Imagen', 'Nombre', 'Descripcion', 'Precio', 'fk_vendedors', 'Estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendedor()
    {
        return $this->belongsTo(\App\Models\Vendedor::class, 'fk_vendedors', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventaproductos()
    {
        return $this->hasMany(\App\Models\Ventaproducto::class, 'id', 'FK_Exhibicion');
    }
    

}
