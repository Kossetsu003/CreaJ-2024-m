<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\ReservationItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('fk_user', Auth::id())->get();

        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity');

        $cartItem = Cart::where('fk_product', $product->id)
                        ->where('fk_user', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
            $cartItem->save();
        } else {
            Cart::create([
                'fk_product' => $product->id,
                'fk_user' => Auth::id(),
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito correctamente.');
    }


    //FUNCION DE GUARDAR COMO RESERVA
    public function checkout()
{
    $user = Auth::user();
    $cartItems = Cart::where('fk_user', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
    }

    $total = $cartItems->reduce(function ($carry, $item) {
        return $carry + ($item->product->price * $item->quantity);
    }, 0);

    // Crear la reserva
    $reservation = Reservation::create([
        'fk_user' => $user->id,
        'total' => $total,
    ]);

    // Crear los items de la reserva
    foreach ($cartItems as $item) {
        ReservationItem::create([
            'fk_reservation' => $reservation->id,
            'fk_product' => $item->fk_product,
            'quantity' => $item->quantity,
            'subtotal' => $item->subtotal,
        ]);
    }

    // Vaciar el carrito
    Cart::where('fk_user', $user->id)->delete();

    return redirect()->route('reservations.index')->with('success', 'Reserva creada exitosamente.');
}

    public function remove(Product $product)
    {
        $cartItem = Cart::where('fk_product', $product->id)
                        ->where('fk_user', Auth::id())
                        ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito correctamente.');
    }
}
