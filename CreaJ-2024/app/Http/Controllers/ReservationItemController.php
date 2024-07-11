<?php

namespace App\Http\Controllers;

use App\Models\ReservationItem;
use App\Http\Requests\ReservationItemRequest;

/**
 * Class ReservationItemController
 * @package App\Http\Controllers
 */
class ReservationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservationItems = ReservationItem::paginate();

        return view('reservation-item.index', compact('reservationItems'))
            ->with('i', (request()->input('page', 1) - 1) * $reservationItems->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservationItem = new ReservationItem();
        return view('reservation-item.create', compact('reservationItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationItemRequest $request)
    {
        ReservationItem::create($request->validated());

        return redirect()->route('reservation-items.index')
            ->with('success', 'ReservationItem created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservationItem = ReservationItem::find($id);

        return view('reservation-item.show', compact('reservationItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservationItem = ReservationItem::find($id);

        return view('reservation-item.edit', compact('reservationItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationItemRequest $request, ReservationItem $reservationItem)
    {
        $reservationItem->update($request->validated());

        return redirect()->route('reservation-items.index')
            ->with('success', 'ReservationItem updated successfully');
    }

    public function destroy($id)
    {
        ReservationItem::find($id)->delete();

        return redirect()->route('reservation-items.index')
            ->with('success', 'ReservationItem deleted successfully');
    }
}
