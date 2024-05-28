<?php

namespace App\Http\Controllers;

use App\Models\MercadoLocal;
use App\Http\Requests\MercadoLocalRequest;

/**
 * Class MercadoLocalController
 * @package App\Http\Controllers
 */
class MercadoLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //CONTROLADORES PARA ADMINISTRADOR
    public function index()
    {
        $mercadoLocals = MercadoLocal::paginate();

        return view('AdminHome ', compact('mercadoLocals'))
            ->with('i', (request()->input('page', 1) - 1) * $mercadoLocals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mercadoLocal = new MercadoLocal();
        return view('AdminAgregarMercado', compact('mercadoLocal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MercadoLocalRequest $request)
    {
        MercadoLocal::create($request->validated());

        return redirect()->route('mercado-locals.index')
            ->with('success', 'MercadoLocal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mercadoLocal = MercadoLocal::find($id);

        return view('mercado-local.show', compact('mercadoLocal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mercadoLocal = MercadoLocal::find($id);

        return view('AdminEditarMercado', compact('mercadoLocal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MercadoLocal $_, $id)
    {
        $mercadoLocal = MercadoLocal::find($id);

        $mercadoLocal->nombre = request()->get("nombre");
        $mercadoLocal->municipio = request()->get("municipio");
        $mercadoLocal->ubicacion = request()->get("ubicacion");
        $mercadoLocal->horaentrada = request()->get("horaentrada");
        $mercadoLocal->horasalida = request()->get("horasalida");
        $mercadoLocal->descripcion = request()->get("descripcion");

        $mercadoLocal->save();
        return redirect()->route('mercado-locals.index')
            ->with('success', 'MercadoLocal updated successfully');
    }

    public function destroy($id)
    {
        MercadoLocal::find($id)->delete();

        return redirect()->route('mercado-locals.index')
            ->with('success', 'MercadoLocal deleted successfully');
    }

     //CONTROLADORES PARA MERCADO
     public function indexMercado()
     {
         $mercadoLocals = MercadoLocal::paginate();

         return view('mercado-local.index', compact('mercadoLocals'))
             ->with('i', (request()->input('page', 1) - 1) * $mercadoLocals->perPage());
     }

     /**
      * Show the form for creating a new resource.
      */
     public function createMercado()
     {
         $mercadoLocal = new MercadoLocal();
         return view('AdminAgregarMercado', compact('mercadoLocal'));
     }

     /**
      * Store a newly created resource in storage.
      */
     public function storeMercado(MercadoLocalRequest $request)
     {
         MercadoLocal::create($request->validated());

         return redirect()->route('mercado-locals.index')
             ->with('success', 'MercadoLocal created successfully.');
     }

     /**
      * Display the specified resource.
      */
     public function showMercado($id)
     {
         $mercadoLocal = MercadoLocal::find($id);

         return view('mercado-local.show', compact('mercadoLocal'));
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function editMercado($id)
     {
         $mercadoLocal = MercadoLocal::find($id);

         return view('AdminEditarMercado', compact('mercadoLocal'));
     }

     /**
      * Update the specified resource in storage.
      */
     public function updateMercado(MercadoLocalRequest $request, MercadoLocal $mercadoLocal)
     {
         $mercadoLocal->update($request->validated());

         return redirect()->route('mercado-locals.index')
             ->with('success', 'MercadoLocal updated successfully');
     }

     public function destroyMercado($id)
     {
         MercadoLocal::find($id)->delete();

         return redirect()->route('mercado-locals.index')
             ->with('success', 'MercadoLocal deleted successfully');
     }
}
