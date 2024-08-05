<h1>Mis Reservas</h1>

@foreach ($reservations as $reservation)
    <div>
        <h2>Reserva #{{ $reservation->id }}</h2>
        <p>Total: ${{ $reservation->total }}</p>
        <ul>
            @foreach ($reservation->items as $item)
                @if ($item->product)
                <h1>{{ $item->product->id}}</h1>

                    <li>{{ $item->product->name }} - {{ $item->quantity }} - ${{ $item->subtotal }}</li>
                @else
                <h3>hola</h3>
                    <li>Producto no disponible - {{ $item->quantity }} - ${{ $item->subtotal }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endforeach
