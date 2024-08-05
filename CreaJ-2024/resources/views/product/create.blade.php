`@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Product
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Product</span>
                    </div>
                    <div class="card-body bg-white">
                        <h1>Productos</h1>
<ul>
    @foreach ($products as $product)
        <li>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a> - ${{ $product->price }}
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="number" name="quantity" value="1" min="1">
                <input type="hidden" name="subtotal" value="1" min="1"> <!-- Campo para la cantidad -->
                <button type="submit">Agregar al carrito</button>
            </form>
        </li>
    @endforeach
</ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
