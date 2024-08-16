<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $reservations = Reservation::where('fk_user', Auth::id())->with('items.product')->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener los ítems del carrito del usuario autenticado
        $cartItems = Cart::with('product')->where('fk_user', Auth::id())->get();

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
    DB::beginTransaction();

    try {
        // Crear la reserva con el campo 'fk_user' incluido
        $reservation = Reservation::create([
            'fk_user' => Auth::id(), // Asegúrate de que este campo coincide con tu esquema
            'total' => 0, // Se actualizará después

        ]);

        // Obtener los artículos del carrito
        $cartItems = Cart::where('fk_user', Auth::id())->get();

        $total = 0;

        foreach ($cartItems as $item) {
            // Crear elementos de reserva
            ReservationItem::create([
                'fk_reservation' => $reservation->id,
                'fk_product' => $item->fk_product,
                'nombre' => $item->product->name,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
                'fk_vendedors' => $item->product->vendedor->id,
                'precio' => $item->product->price// Ajusta según la lógica
            ]);

            // Calcular el total
            $total += $item->subtotal;
        }

        // Actualizar el total de la reserva
        $reservation->total = $total;
        $reservation->save();

        // Vaciar el carrito
        Cart::where('fk_user', Auth::id())->delete();

        DB::commit();

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error al crear la reserva: ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        if ($reservation->fk_user !== Auth::id()) {
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
        if ($reservation->fk_user !== Auth::id()) {
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
        if ($reservation->fk_user !== Auth::id()) {
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
        if ($reservation->fk_user !== Auth::id()) {
            abort(403);
        }

        $reservation->items()->delete();
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
