<?php

namespace App\Http\Controllers;

//modelos
use App\Models\User;
use App\Models\Clientes;
use App\Models\MercadoLocal;
use App\Models\Vendedor;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\ReservationItem;
//request
use Illuminate\Http\Request;
use App\Http\Request\UserRequest;
use App\Http\Request\ClienteRequest;
use App\Http\Request\MercadoLocalRequest;
use App\Http\Request\VendedorRequest;
use App\Http\Request\CartRequest;
use App\Http\Request\ReservationRequest;
use App\Http\Request\ProductRequest;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



/**
 * Class UsuariosController
 * @package App/Http/Controllers
 */

    class AdminController extends Controller
    {
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
    }
