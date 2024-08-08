<?php

namespace App\Http\Controllers;

//modelos
use App\Models\User;
use App\Models\Cliente;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;
//request
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ClienteRequest;
use App\Http\Requests\MercadoLocalRequest;
use App\Http\Requests\VendedorRequest;
use App\Http\Requests\CartRequest;
use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ProductRequest;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

    class AdminController extends Controller
    {

        /**MERCADOS LOCALES */
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
        public function crearmercados()
        {
            $mercadoLocal = new MercadoLocal(); // Crear nueva instancia de MercadoLocal

            // Retornar vista 'AdminAgregarMercado' con el mercado local creado
            return view('AdminAgregarMercado', compact('mercadoLocal'));
        }

        public function guardarmercados(MercadoLocalRequest $request)
        {
                // Validar los datos del formulario
            $request->validate([
                'imagen_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'nombre' => 'required|string|max:255',
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

        //INSTANCIAS, significa guardar variables en $variables
            $mercadolocal->usuario = $usuario;
            $mercadolocal ->password = Hash::make($password);
            $mercadolocal->nombre = $request->nombre;
            $mercadolocal->imagen_referencia = $request->imagen_referencia;
            $mercadolocal->municipio = $request->municipio;
            $mercadolocal->ubicacion = $request->ubicacion;
            $mercadolocal->horaentrada = $request->horaentrada;
            $mercadolocal->horasalida = $request->horasalida;
            $mercadolocal->descripcion = $request->descripcion;

        //if para la imagen
            if ($request->hasFile('imagen_referencia')) {
            // Construir el nuevo nombre del archivo
                $nombre = str_replace(' ', '_', strtolower($request->input('nombre')));
                $municipio = str_replace(' ', '_', strtolower($request->input('municipio')));
                $imageName = "{$nombre}_{$municipio}.png";

            // Mover el archivo a la carpeta 'imagenes' con el nuevo nombre
                $request->imagen_referencia->move(public_path('imgs'), $imageName);

            // Guardar el nombre del archivo en la base de datos
                $mercadolocal->imagen_referencia = $imageName;
            }

            $mercadolocal->save();

            return redirect()->route    ('admin.index')->with([
                'usuario' => $usuario,
            '   password' => $password,
            ]);
        }
        public function vermercados($id)
        {
            $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID
        $vendedors = Vendedor::where('Fk_Mercado', $id)->get(); // Obtener vendedores asociados al mercado local

        // Retornar vista 'AdminListadoMercados' con datos del mercado local y vendedores
        return view('AdminListadoMercados', compact('mercadoLocal', 'vendedors'));
        }
        public function editarmercados($id)
        {
            $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

        // Retornar vista 'AdminEditarMercado' con el mercado local a editar
        return view('AdminEditarMercado', compact('mercadoLocal'));
        }
        public function actualizarmercados( MercadoLocalRequest $request, $id)
        {
            $mercadoLocal = MercadoLocal::find($id); // Encontrar mercado local por ID

            // Actualizar campos del mercado local con datos del formulario
            $mercadoLocal->update($request->validated());

            // Redirigir a la vista de índice de mercados locales con mensaje de éxito
            return redirect()->route('admin.index')
                ->with('success', 'MercadoLocal updated successfully');
        }
        public function eliminarmercados($id)
        {
            MercadoLocal::find($id)->delete(); // Encontrar y eliminar mercado local por ID

        // Redirigir a la vista de índice de mercados locales con mensaje de éxito
            return redirect()->route('admin.index')
            ->with('success', 'Mercado Local deleted successfully');
        }






        /**VENDEDORES */

        public function vendedores()
        {
            $vendedors = Vendedor::paginate();
        return view('AdminListadoVendedores', compact('vendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());
        }
        public function crearvendedores()
        {
            $vendedor = new Vendedor();
        $mercados = MercadoLocal::all(); // Suponiendo que tu modelo de mercados se llama MercadoLocal
        return view('AdminRegistrarVendedor', compact('vendedor', 'mercados'));


        }
        public function guardarvendedores(VendedorRequest $request)
        {
                // Validar los datos del formulario
         $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors',
            'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors',
            'numero_puesto' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
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
        if (Vendedor::where('usuario', $request->usuario)->exists() || Vendedor::where('telefono', $request->telefono)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Correo Electrónico o Teléfono.');
        }

        // Verificar si el numero_puesto ya existe en el mismo mercado
        if (Vendedor::where('fk_mercado', $request->fk_mercado)->where('numero_puesto', $request->numero_puesto)->exists()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya existe un vendedor con el mismo Numero de Puesto en este Mercado.');
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
        $vendedor->password = Hash::make($request->password); // Encriptar la contraseña
        $vendedor->clasificacion = $request->clasificacion;

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen_de_referencia')) {
            $file = $request->file('imagen_de_referencia');
            $imageName = $request->nombre . '_' . $request->nombre_del_local . '.png';

            // Movimiento
            $file->move(public_path('imgs'), $imageName);
            // Guardar
            $vendedor->imagen_de_referencia = $imageName;
        }

        $vendedor->save();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor creado exitosamente.');
        }
        public function vervendedores($id)
        {
            $vendedor = Vendedor::find($id);
            return view('vendedor.show', compact('vendedor'));
        }
        public function editarvendedores($id)
        {
            $vendedor = Vendedor::find($id);
        return view('AdminEditarVendedor', compact('vendedor'));

        }
        public function actualizarvendedores( Request $request, $id)
        {
                // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|email|unique:vendedors,usuario,' . $id . '|unique:users,usuario,' . $id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20|unique:vendedors,telefono,' . $id . '|unique:users,telefono,' . $id,
            'numero_puesto' => 'required|string|max:255|unique:vendedors,numero_puesto,' . $id,
            'fk_mercado' => 'required|exists:mercado_locals,id',
            'contrasena' => 'nullable|string|min:8|confirmed',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendedor = Vendedor::find($id);

        // Actualizar campos del vendedor
        $vendedor->usuario = $request->usuario;
        $vendedor->nombre = $request->nombre;
        $vendedor->apellidos = $request->apellidos;
        $vendedor->telefono = $request->telefono;
        $vendedor->numero_puesto = $request->numero_puesto;
        $vendedor->fk_mercado = $request->fk_mercado;
        if ($request->filled('contrasena')) {
            $vendedor->contrasena = bcrypt($request->contrasena); // Encriptar la contraseña
        }
        $vendedor->save();

        // Actualizar el usuario en la tabla `users`
        $user = User::where('usuario', $request->usuario)->first();
        if ($user) {
            $user->usuario = $request->usuario;
            $user->nombre = $request->nombre;
            $user->apellido = $request->apellidos;
            $user->telefono = $request->telefono;
            if ($request->filled('contrasena')) {
                $user->password = Hash::make($request->contrasena);
            }
            $user->save();
        }

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor actualizado exitosamente.');
        }
        public function eliminarvendedores($id)
        {
            $vendedor = Vendedor::find($id);

        // Eliminar el usuario en la tabla `users`
        User::where('usuario', $vendedor->usuario)->delete();

        $vendedor->delete();

        return redirect()->route('admin.vendedores')
            ->with('success', 'Vendedor eliminado exitosamente.');
        }





        /**CLIENTES */
        public function clientes()
        {
            $clientes = User::paginate();

        return view('AdminListadoClientes', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
        }
        public function eliminarclientes($id)
        {
            Cliente::find($id)->delete();

        return redirect()->route('admin.clientes')
            ->with('success', 'Cliente deleted successfully');
        }
    }
