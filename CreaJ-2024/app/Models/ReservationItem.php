<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_reservation', 'fk_product', 'quantity', 'price',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'fk_reservation');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
