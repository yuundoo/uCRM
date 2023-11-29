<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorereservationRequest;
use App\Http\Requests\UpdatereservationRequest;
use App\Models\Reservation;
use Inertia\Inertia;
use App\Models\Stylelist;
use App\Models\Item;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Stylelist/Reservation', [
            'stylelists' => Stylelist::select('id', 'name', 'review_count',)->get(),
            'items' => Item::select('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorereservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorereservationRequest $request)
    {
        Reservation::create([
            'customer_id' => $request->customer_id,
            'stylelist_id' => $request->stylelist_id,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('/dashboard')->with('success', '予約完了できました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatereservationRequest  $request
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatereservationRequest $request, reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(reservation $reservation)
    {
        //
    }
}
