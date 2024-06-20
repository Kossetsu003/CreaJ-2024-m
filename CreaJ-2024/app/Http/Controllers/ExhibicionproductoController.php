<?php

namespace App\Http\Controllers;

use App\Models\Exhibicionproducto;
use App\Http\Requests\ExhibicionproductoRequest;

/**
 * Class ExhibicionproductoController
 * @package App\Http\Controllers
 */
class ExhibicionproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exhibicionproductos = Exhibicionproducto::paginate();

        return view('exhibicionproducto.index', compact('exhibicionproductos'))
            ->with('i', (request()->input('page', 1) - 1) * $exhibicionproductos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exhibicionproducto = new Exhibicionproducto();
        return view('exhibicionproducto.create', compact('exhibicionproducto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExhibicionproductoRequest $request)
    {
        Exhibicionproducto::create($request->validated());

        return redirect()->route('exhibicionproductos.index')
            ->with('success', 'Exhibicionproducto created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exhibicionproducto = Exhibicionproducto::find($id);

        return view('exhibicionproducto.show', compact('exhibicionproducto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exhibicionproducto = Exhibicionproducto::find($id);

        return view('exhibicionproducto.edit', compact('exhibicionproducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExhibicionproductoRequest $request, Exhibicionproducto $exhibicionproducto)
    {
        $exhibicionproducto->update($request->validated());

        return redirect()->route('exhibicionproductos.index')
            ->with('success', 'Exhibicionproducto updated successfully');
    }

    public function destroy($id)
    {
        Exhibicionproducto::find($id)->delete();

        return redirect()->route('exhibicionproductos.index')
            ->with('success', 'Exhibicionproducto deleted successfully');
    }
}
