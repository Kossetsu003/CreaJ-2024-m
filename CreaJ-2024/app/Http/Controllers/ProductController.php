<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendedor;
use App\Http\Requests\ProductRequest;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Lo unico que se es que no lo ocupo?
        $products = Product::paginate();

        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Obtener el producto específico por su ID
    $product = Product::find($id);

    // Obtener todos los productos con paginación
    $products = Product::where('id', '!=', $id)->paginate();
    $vendedor = $product->vendedor;

    // Retornar la vista con ambos datos
    return view('UserProductoEnEspecifico', compact('product', 'products','vendedor'))
        ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
