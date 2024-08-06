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

 class VendedoresController extends Controller{


    public function show($id)
{
    $vendedor = Vendedor::with('mercadoLocal')->find($id);
    $mercadoLocal = $vendedor->mercadoLocal;
    $products = Product::where('fk_vendedors', $id)->get();

    return view('VendedorHome', compact('vendedor', 'products','mercadoLocal'));
}
 }
