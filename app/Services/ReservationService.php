<?php

namespace App\Services;

use App\Models\Reservation;


class ReservationService
{


    public function listReservations()
    {

        $userId = auth()->user()->id;
        $reservations = Reservation::where('customer_id', $userId)
            ->with(['customer', 'stylelist', 'item'])
            ->get();

        return $reservations;
    }

    public function allReservations($perPage, $searchTerm = '')
    {
        return Reservation::with(['customer', 'stylelist', 'item'])
            ->search($searchTerm)
            ->orderBy('id')
            ->paginate($perPage, ['id', 'customer_id', 'item_id', 'created_at', 'status']);
    }


    public function deatilReservations()
    {
        $userId = auth()->user()->id;
        $reservations = Reservation::where('customer_id', $userId)
            ->with(['customer', 'stylelist', 'item'])
            ->get();

        return $reservations;
    }

    // public function updateReservations()
    // {
    //     $userId = auth()->user()->id;
    //     $reservations = Reservation::where('customer_id', $userId)
    //         ->with(['customer', 'stylelist', 'item'])
    //         ->get();


    //     return $reservations;
    // }
}
