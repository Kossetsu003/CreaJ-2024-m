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

 class MercadosController extends Controller
 {
    public function index($id){
        // Buscar el mercado local por ID
    $mercadoLocal = MercadoLocal::find($id);

    // Obtener los vendedores con fk_mercado igual al ID del mercado local con paginación
    $vendedors = Vendedor::where('fk_mercado', $id)->paginate();

    // Retornar la vista con ambos datos
    return view('MercadoHome', compact('mercadoLocal', 'vendedors'))
        ->with('i', (request()->input('page', 1) - 1) * $vendedors->perPage());

    }
 }
