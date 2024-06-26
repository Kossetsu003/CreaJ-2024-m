<?php

namespace App\Http\Controllers;

use Illuminate\Http\AdminClienteRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\Session;

class AdminClienteController extends Controller
{

    //ADMINISTRADOR
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate();

        return view('AdminListadoClientes', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('RegistroUser', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
       $cliente = Cliente::create($request->validated());

       Session::put('id',$cliente->id);

        return redirect()->route('admin-clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = 1;
        $cliente = Cliente::find($id);

        return view('UserProfileVista', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('UserEditarPerfil', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('admin-clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    public function destroy($id)
    {
        Cliente::find($id)->delete();

        return redirect()->route('admin-clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }


}
