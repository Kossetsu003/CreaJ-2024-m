
    <h1>Reserva #{{ $reservation->id }}</h1>
    <p>Total: ${{ $reservation->total }}</p>
    <ul>
        @foreach ($reservation->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} - ${{ $item->subtotal }}</li>
        @endforeach
    </ul>
    <a href="{{ route('reservations.edit', $reservation) }}">Editar</a>
    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>

