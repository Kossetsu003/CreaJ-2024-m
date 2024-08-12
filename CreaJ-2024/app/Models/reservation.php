<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'fk_users',
        'estado',
        'retiro',

    ];

    // Relationship to the MercadoLocal model


    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_users');
    }
   

    // Other relationships, such as items and products
}
