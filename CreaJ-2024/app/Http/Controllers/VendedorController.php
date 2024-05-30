<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Http\Requests\VendedorRequest;
use Illuminate\Support\Facades\Session;
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
        $vendedors = Vendedor::paginate();

        return view('vendedor.index', compact('vendedors'))
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
         // Validar los datos del formulario
         $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors',
            'numero_puesto' => 'required|string|max:255',
            'contrasena' => 'required|string|min:8|confirmed',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar si ya existen datos iguales en la base de datos
        if (Vendedor::where('usuario', $request->usuario)->exists() || Vendedor::where('telefono', $request->telefono)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo correo electrónico o teléfono.');
        }

        // Crear vendedor si la validación pasa y no hay datos repetidos
        $vendedor = Vendedor::create([
            'usuario' => $request->usuario,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'numero_puesto' => $request->numero_puesto,
            'fk_mercado' => 1, // Valor predeterminado
            'contrasena' => Hash::make($request->contrasena), // Encriptar la contraseña
        ]);

        // Verificar si ya existen datos iguales en la base de datos
        if (Vendedor::where('usuario', $request->usuario)->exists() || Vendedor::where('telefono', $request->telefono)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo correo electrónico o teléfono.');
            }

        return redirect()->route('admin-vendedors.index')
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

        return view('vendedor.edit', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendedorRequest $request, Vendedor $vendedor)
    {
        $vendedor->update($request->validated());

        return redirect()->route('vendedors.index')
            ->with('success', 'Vendedor updated successfully');
    }

    public function destroy($id)
    {
        Vendedor::find($id)->delete();

        return redirect()->route('vendedors.index')
            ->with('success', 'Vendedor deleted successfully');
    }
}
