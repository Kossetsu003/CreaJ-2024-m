<!-- resources/views/cart/index.blade.php -->

<h1>Carrito de Compras</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<ul>
    @foreach ($cartItems as $cartItem)
        <li>
            Producto: {{ $cartItem->product->name }} - Cantidad: {{ $cartItem->quantity }} - Precio: ${{ $cartItem->product->price }} - Subtotal: ${{ $cartItem->product->price * $cartItem->quantity }}
            <form action="{{ route('cart.remove', $cartItem->product_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar del carrito</button>
            </form>
        </li>
    @endforeach
</ul>

<h2>Total: ${{ $total }}</h2>
