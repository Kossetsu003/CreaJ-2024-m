<h1>Productos</h1>
<ul>
    @foreach ($products as $product)
        <li>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a> - ${{ $product->price }}
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="number" name="quantity" value="1" min="1"> <!-- Campo para la cantidad -->
                <button type="submit">Agregar al carrito</button>
            </form>
        </li>
    @endforeach
</ul>
