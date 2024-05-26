<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Session;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
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
    public function AdminCreate()
    {
        $cliente = new Cliente();
        return view('RegistroUser', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AdminStore(ClienteRequest $request)
    {
       $cliente = Cliente::create($request->validated());

       Session::put('id',$cliente->id);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function AdminShow($id)
    {
        $cliente = Cliente::find($id);

        return view('UserProfileVista', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function AdminEdit($id)
    {
        $cliente = Cliente::find($id);

        return view('UserEditarPerfil', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function AdminUpdate(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    public function Destroy($id)
    {
        Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }

    //CLIENTE
    public function indexCliente()
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCliente()
    {
        $cliente = new Cliente();
        return view('RegistroUser', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCliente(ClienteRequest $request)
    {
       $cliente = Cliente::create($request->validated());

       Session::put('id',$cliente->id);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showCliente($id)
    {
        $cliente = Cliente::find($id);

        return view('UserProfileVista', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCliente($id)
    {
        $cliente = Cliente::find($id);

        return view('UserEditarPerfil', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCliente(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    public function destroyCliente($id)
    {
        Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }
}
