<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Models\Cliente;
use Illuminate\Http\Request\VendedorRequest;
use Illuminate\Support\Facades\Session;


class AdminVendedorController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vendedors = Vendedor::paginate();


        return view('AdminListadoVendedores', compact('vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendedor = new Vendedor();
        return view('MercadoRegistrarVendedor', compact('vendedor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendedorRequest $request)
    {
        Vendedor::create($request->validated());

        return redirect()->route('admin-vendedors.index')
            ->with('success', 'Vendedor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vendedor = Vendedor::find($id);

        return view('vendedor.show', compact('vendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendedor = Vendedor::find($id);

        return view('vendedor.edit', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendedorRequest $request, Vendedor $vendedor)
    {
        $vendedor->update($request->validated());

        return redirect()->route('AdminListadoVendedores')
            ->with('success', 'Vendedor updated successfully');
    }

    public function destroy($id)
    {
        Vendedor::find($id)->delete();

        return redirect()->route('AdminListadoVendedores')
            ->with('success', 'Vendedor deleted successfully');
    }
}
