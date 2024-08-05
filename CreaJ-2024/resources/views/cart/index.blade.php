<!-- resources/views/cart/index.blade.php -->

<h1>Carrito de Compras</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<ul>
    @foreach ($cartItems as $cartItem)
        <li>
            Producto: {{ $cartItem->product->name }} - Cantidad: {{ $cartItem->quantity }} - Precio: ${{ $cartItem->product->price }} - Subtotal: ${{ $cartItem->product->price * $cartItem->quantity }}
            <form action="{{ route('cart.remove', $cartItem->fk_product) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar del carrito</button>
            </form>
l    @endforeach
</ul>

<?php echo $userid ?>
<h2>Total: ${{ $total }}</h2>

<!-- Formulario para guardar los ítems del carrito en una reserva -->
<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <button type="submit">Guardar Reserva</button>
</form>

