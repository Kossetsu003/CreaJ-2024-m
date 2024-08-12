<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'fk_products',
        'fk_users',
        'subtotal', // Añadimos fk_users a los campos fillable
        'quantity',
    ];

    public function producto()
{
    return $this->belongsTo(Product::class, 'fk_products');
}


    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_users');
    }
}

