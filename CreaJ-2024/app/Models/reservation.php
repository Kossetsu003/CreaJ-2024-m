<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'fk_users', 'total','estado',
    ];

    public function items()
    {
        return $this->hasMany(ReservationItem::class, 'fk_reservation');
    }
}
