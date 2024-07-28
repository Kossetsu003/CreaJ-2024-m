<?php

namespace App\Http\Controllers;

use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cliente;
use  Illuminate\Support\Facades\Hash;
use App\Http\Requests\MercadoLocalRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminMercadoLocalController extends Controller
{
    // Método: index
    // Descripción: Carga la vista principal del administrador con datos paginados de mercados locales, vendedores y clientes específicos.
    public function index()
    {
        $id = 1; // ID del cliente para obtener datos específicos
        $mercadoLocals = MercadoLocal::paginate(); // Obtener mercados locales paginados
        $vendedors = Vendedor::paginate(); // Obtener vendedores paginados
        $clientes = Cliente::where('id', $id)->get(); // Obtener cliente específico

        // Retornar la vista 'AdminHome' con los datos paginados y la variable 'i' para la paginación
        return view('AdminHome', compact('mercadoLocals', 'vendedors', 'clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $mercadoLocals->perPage());
    }

    // Método: create
    // Descripción: Muestra el formulario para crear un nuevo mercado local.
    public function create()
    {
        $mercadoLocal = new MercadoLocal(); // Crear nueva instancia de MercadoLocal

        // Retornar vista 'AdminAgregarMercado' con el mercado local creado
        return view('AdminAgregarMercado', compact('mercadoLocal'));
    }

    // Método: store
    // Descripción: Almacena un nuevo mercado local en la base de datos.
    public function store(MercadoLocalRequest $request)
    {
       // Validar los datos del formulario
       $request->validate([

        'nombre' => 'required|string|max:255',
        'imagen_referencia' => 'required|string|max:255',
        'municipio' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'horaentrada' => 'required|string|max:255',
        'horasalida' => 'required|string|max:255',
       'descripcion' => 'required|string|max:500',

    ]);

        $nombreLimpio = str_replace(' ', '', $request->nombre);
        $usuario = strtolower($nombreLimpio) . '@minishop.sv';
        $password = '1' . strtolower($nombreLimpio) . '!';

        $mercadolocal = new MercadoLocal();

        $mercadolocal->usuario = $usuario;


        $mercadolocal ->password = Hash::make($password);

        $mercadolocal->nombre = $request->nombre;
        $mercadolocal->imagen_referencia = $request->imagen_referencia;
        $mercadolocal->municipio = $request->municipio;
        $mercadolocal->ubicacion = $request->ubicacion;
        $mercadolocal->horaentrada = $request->horaentrada;
        $mercadolocal->horasalida = $request->horasalida;
        $mercadolocal->descripcion = $request->descripcion;



        $mercadolocal->save();

        return redirect()->route('admin-mercado-locals.confirmation')->with([
            'usuario' => $usuario,
            'password' => $password,
        ]);

        }

        public function confirmation()
    {
        // Obtener los datos de la sesión
        $usuario = session('usuario');
        $contrasena = session('contrasena');

        // Mostrar la vista de confirmación
        return view('admin-mercado-locals.confirmation', compact('usuario', 'contrasena'));
    }


    // Método: show
    // Descripción: Muestra los detalles de un mercado local específico.
    public function show($id)
    {
        $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID
        $vendedors = Vendedor::where('Fk_Mercado', $id)->get(); // Obtener vendedores asociados al mercado local

        // Retornar vista 'AdminListadoMercados' con datos del mercado local y vendedores
        return view('AdminListadoMercados', compact('mercadoLocal', 'vendedors'));
    }

    // Método: edit
    // Descripción: Muestra el formulario para editar un mercado local existente.
    public function edit($id)
    {
        $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

        // Retornar vista 'AdminEditarMercado' con el mercado local a editar
        return view('AdminEditarMercado', compact('mercadoLocal'));
    }

    // Método: update
    // Descripción: Actualiza los datos de un mercado local existente en la base de datos.
    public function update(MercadoLocalRequest $request, $id)
    {
        $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

        // Actualizar campos del mercado local con datos del formulario
        $mercadoLocal->update($request->validated());

        // Redirigir a la vista de índice de mercados locales con mensaje de éxito
        return redirect()->route('admin-mercado-locals.index')
            ->with('success', 'MercadoLocal updated successfully');
    }

    // Método: destroy
    // Descripción: Elimina un mercado local específico de la base de datos.
    public function destroy($id)
    {
        MercadoLocal::find($id)->delete(); // Encontrar y eliminar mercado local por ID

        // Redirigir a la vista de índice de mercados locales con mensaje de éxito
        return redirect()->route('admin-mercado-locals.index')
            ->with('success', 'Mercado Local deleted successfully');
    }
}
