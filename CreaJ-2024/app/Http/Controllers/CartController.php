<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Obtener los ítems del carrito del usuario autenticado
        $cartItems = Cart::with('product')->where('fk_users', Auth::id())->get();

        // Calcular el total del carrito
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'subtotal|integer|min:1'
        ]);

        $quantity = $request->input('quantity');
        $subtotal = $request->input('subtotoal');

//VERIFICACION
        // Verificar si el producto ya está en el carrito del usuario actual
        $cartItem = Cart::where('product_id', $product->id)
                        ->where('fk_users', Auth::id())
                        //al utilizar GET lo que se hace es agarrar el objeto
                        ->first();



               

                        
        if ($cartItem) {
            // Si existe, actualizar la cantidad sumando la nueva cantidad
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->product->price;
            $cartItem->save();
            //AQUI SE CREA LA CARRETILLA
        } else {
            // Si no existe, crear uno nuevo en el carrito del usuario actual
            Cart::create([
                'product_id' => $product->id,
                'fk_users' => Auth::id(), // Asignar el ID del usuario actual
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price
            ]);
        }

        $cartItems = Cart::where('fk_users', Auth::id())->get();
        //SUBTOTAL
                    $subtotal = $cartItems->reduce(function ($carry, $item){
                        return $carry +($item->product->price * $item->quantity);
                    },);

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito correctamente.');
    }

    public function remove(Product $product)
    {
        // Buscar el ítem del carrito del producto específico del usuario actual
        $cartItem = Cart::where('product_id', $product->id)
                        ->where('fk_users', Auth::id())
                        ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                // Si la cantidad es mayor que 1, reducir la cantidad
                $cartItem->quantity--;
                $cartItem->save();
            } else {
                // Si la cantidad es 1 o menos, eliminar el ítem del carrito
                $cartItem->delete();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito correctamente.');
    }
}
