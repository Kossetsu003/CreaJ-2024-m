<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Models\Cliente;
use App\Http\Requests\VendedorRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


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
        return view('AdminRegistrarVendedor', compact('vendedor'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(VendedorRequest $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors',
            'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors',
            'numero_puesto' => 'required|integer|unique:vendedors',
            'contrasena' => 'required|string|min:8|confirmed',
            'clasificacion' => 'required|string|max:255',
            'fk_mercado' => 'required|exists:mercado_locals,id',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar si ya existen datos iguales en la base de datos
        if (Vendedor::where('usuario', $request->usuario)->exists() || Vendedor::where('telefono', $request->telefono)->exists() || Vendedor::where('numero_puesto', $request->numero_puesto)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Correo Electrónico, Teléfono o con ese mismo Numero de Puesto.');
        }

        // Crear vendedor si la validación pasa y no hay datos repetidos
        $vendedor = new Vendedor();
        $vendedor->usuario = $request->usuario;
        $vendedor->nombre = $request->nombre;
        $vendedor->nombre_del_local = $request->nombre_del_local;
        $vendedor->apellidos = $request->apellidos;
        $vendedor->telefono = $request->telefono;
        $vendedor->numero_puesto = $request->numero_puesto;
        $vendedor->fk_mercado = $request->fk_mercado;
        $vendedor->password = Hash::make($request->contrasena); // Encriptar la contraseña
        $vendedor->clasificacion = $request->clasificacion;

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen_referencia')) {
            $file = $request->file('imagen_referencia');
            $imageName = $request->nombre . '_' . $request->nombre_del_local . '.png';
            $file->move(public_path('imgs'), $imageName);
            $vendedor->imagen_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin-vendedors.index')
            ->with('success', 'Vendedor creado exitosamente.');
    }

    /* Display the specified resource.
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

        return view('AdminEditarVendedor', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Vendedor $_, $id)
    {
        $vendedor = Vendedor::find($id);

        $vendedor->usuario = request()->get("usuario");
        $vendedor->nombre = request()->get("nombre");
        $vendedor->apellidos = request()->get("apellidos");
        $vendedor->telefono = request()->get("telefono");
        $vendedor->numero_puesto = request()->get("numero_puesto");
        $vendedor->fk_mercado = request()->get("fk_mercado");
        $vendedor->save();

        return redirect()->route('admin-vendedors.index')
            ->with('success', 'Vendedor updated successfully');
    }

    public function destroy($id)
    {
        Vendedor::find($id)->delete();

        return redirect()->route('admin-vendedors.index')
            ->with('success', 'Vendedor deleted successfully');
    }
}
