
    <h1>Editar Reserva #{{ $reservation->id }}</h1>
    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
        @csrf
        @method('PUT')
        <ul>
            @foreach ($reservation->items as $item)
                <li>
                    {{ $item->product->name }}
                    <input type="number" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1">
                    <span>- ${{ $item->subtotal }}</span>
                </li>
            @endforeach
        </ul>
        <button type="submit">Actualizar</button>
    </form>
