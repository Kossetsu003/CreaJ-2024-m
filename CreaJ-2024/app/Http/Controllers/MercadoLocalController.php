<?php

namespace App\Http\Controllers;

use App\Models\MercadoLocal;
use App\Http\Requests\MercadoLocalRequest;
use Illuminate\Support\Facades\Session;


/**
 * Class MercadoLocalController
 * @package App\Http\Controllers
 */
class MercadoLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //CONTROLADORES PARA MERCADO
    public function index()
    {
        $mercadoLocals = MercadoLocal::paginate();

        return view('mercado-local.index ', compact('mercadoLocals'))
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
        //YO lo que hago es validar y guardar los datos en $MercadoLocal
        MercadoLocal::create($request->validated());
        $UsuarioMercadoLocal = $request->nombre . '_' . $request->municipio;

        //Aqui me los une
        MercadoLocal::create([
          
            'usuario' => $UsuarioMercadoLocal . '@minishop.sv', // Generar un correo basado en el username
           
        ]);
       
//Aqui me los manda
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
            ->with('success', 'Mercado Local deleted successfully');
    }



}
