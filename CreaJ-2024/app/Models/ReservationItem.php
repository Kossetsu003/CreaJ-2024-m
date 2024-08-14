<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    protected $fillable = [
        'fk_reservation',
        'fk_product',
        'quantity',
        'subtotal',
        'fk_vendedors',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'fk_product');
    }
}

