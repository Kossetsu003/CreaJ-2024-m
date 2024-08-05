<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationItem;
use App\Models\Cart;
use Illuminate\Http\Request;
/**
 * Class ReservationController
 * @package App\Http\Controllers
 */
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener las reservas del usuario autenticado con los ítems y productos relacionados
        $reservations = Reservation::where('fk_users', Auth::id())->with('items.product')->get();

        return view('UserEstadoReservas', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los ítems del carrito del usuario autenticado
        $cartItems = Cart::with('product')->where('fk_users', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total del carrito
        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        return view('reservations.create', compact('cartItems', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('fk_users', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->product->price * $item->quantity);
        }, 0);

        // Crear la reserva
        $reservation = Reservation::create([
            'fk_users' => $user->id,
            'total' => $total,
        ]);

        // Crear los items de la reserva
        foreach ($cartItems as $item) {
            ReservationItem::create([
                'fk_reservation' => $reservation->id,
                'fk_product' => $item->fk_product,
                'quantity' => $item->quantity,
                'subtotal' => $item->quantity * $item->product->price,
            ]);
        }

        // Vaciar el carrito
        Cart::where('fk_users', $user->id)->delete();

        return redirect()->route('reservations.index')->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        if ($reservation->fk_users !== Auth::id()) {
            abort(403);
        }

        $reservation->load('items.product');
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        if ($reservation->fk_users !== Auth::id()) {
            abort(403);
        }

        $reservation->load('items.product');
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        if ($reservation->fk_users !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;

        foreach ($request->items as $itemId => $itemData) {
            $item = ReservationItem::find($itemId);
            if ($item && $item->fk_reservation == $reservation->id) {
                $item->quantity = $itemData['quantity'];
                $item->subtotal = $item->quantity * $item->product->price;
                $item->save();

                $total += $item->subtotal;
            }
        }

        $reservation->total = $total;
        $reservation->save();

        return redirect()->route('reservations.show', $reservation)->with('success', 'Reserva actualizada exitosamente.');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->fk_users !== Auth::id()) {
            abort(403);
        }

        $reservation->items()->delete();
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
