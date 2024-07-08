
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>${{ $product->price }}</p>
    <form action="{{ route('cart.add', $product) }}" method="POST">
        @csrf
        <button type="submit">Agregar al carrito</button>
    </form>

