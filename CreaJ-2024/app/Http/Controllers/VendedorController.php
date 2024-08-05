<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class VendedorController
 * @package App\Http\Controllers
 */
class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendedores = Vendedor::paginate();

        return view('vendedor.index', compact('vendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendedor = new Vendedor();
        $mercados = MercadoLocal::all();
        return view('vendedor.create', compact('vendedor', 'mercados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors,usuario',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors,telefono',
            'numero_puesto' => 'required|integer|unique:vendedors,numero_puesto',
            'contrasena' => 'required|string|min:8|confirmed',
            'fk_mercado' => 'required|exists:mercado_locals,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Vendedor::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->contrasena),
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'numero_puesto' => $request->numero_puesto,
            'fk_mercado' => $request->fk_mercado,
            'ROL' => 3,
        ]);

        return redirect()->route('VendedorHome')
            ->with('success', 'Vendedor creado exitosamente.');
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
        $mercados = MercadoLocal::all();
        return view('vendedor.edit', compact('vendedor', 'mercados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors,usuario,' . $id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors,telefono,' . $id,
            'numero_puesto' => 'required|integer|unique:vendedors,numero_puesto,' . $id,
            'fk_mercado' => 'required|exists:mercado_locals,id',
            'contrasena' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendedor = Vendedor::find($id);

        $vendedor->usuario = $request->usuario;
        $vendedor->nombre = $request->nombre;
        $vendedor->apellidos = $request->apellidos;
        $vendedor->telefono = $request->telefono;
        $vendedor->numero_puesto = $request->numero_puesto;
        $vendedor->fk_mercado = $request->fk_mercado;
        if ($request->filled('contrasena')) {
            $vendedor->password = Hash::make($request->contrasena);
        }
        $vendedor->save();

        return redirect()->route('vendedors.index')
            ->with('success', 'Vendedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Vendedor::find($id)->delete();

        return redirect()->route('vendedors.index')
            ->with('success', 'Vendedor eliminado exitosamente.');
    }
}
