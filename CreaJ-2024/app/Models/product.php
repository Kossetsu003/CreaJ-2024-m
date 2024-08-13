<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'products';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'fk_vendedors',
    ];

    /**
     * Get the vendedor associated with the product.
     */
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'fk_vendedors');
    }
}
