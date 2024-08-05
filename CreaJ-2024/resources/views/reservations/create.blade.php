
    <h1>Crear Reserva</h1>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <h2>Resumen del Carrito</h2>
        <ul>
            @foreach ($cartItems as $item)
                <li>{{ $item->product->name }} - {{ $item->quantity }} - ${{ $item->subtotal }}</li>
            @endforeach
        </ul>
        <p>Total: ${{ $total }}</p>
        <button type="submit">Confirmar Reserva</button>
    </form>


