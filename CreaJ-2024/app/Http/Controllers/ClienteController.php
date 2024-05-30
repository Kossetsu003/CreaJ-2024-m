<?php

namespace App\Http\Controllers;

use App\Models\MercadoLocal;
use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{


    //CLIENTE
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate();
        $mercadoLocals = MercadoLocal::paginate();


        return view('UserHome', compact('clientes','mercadolocals'))
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
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:clientes',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:clientes',
            'sexo' => 'required|string',
            'contrasena' => 'required|string|min:8|confirmed',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear cliente si la validación pasa
        $cliente = Cliente::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'contrasena' => bcrypt($request->contrasena), // Asegúrate de encriptar la contraseña
        ]);

        // Guardar el ID del cliente en la sesión
        Session::put('id', $cliente->id);

        return redirect()->route('LoginUser', ['success' => true]);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
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

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    public function destroy($id)
    {
        Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }


}
