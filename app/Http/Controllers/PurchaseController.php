<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use Inertia\Inertia;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Stylelist;
use App\Services\ReservationService;


class PurchaseController extends Controller
{

    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $searchTerm = $request->input('search', '');
            $reservations = $this->reservationService->allReservations(30, $searchTerm);

            return Inertia::render('Purchase/Index', [
                'reservations' => $reservations,
                'filters' => $request->only(['search' => $searchTerm]), // 검색 필터를 프론트엔드에 전달
            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role === 'admin') {
            $items = Item::select('id', 'name', 'price')->where('is_selling', true)->get();
            return Inertia::render('Purchase/Create', [
                'items' => $items
            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {

        $purchase = Purchase::create([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
        ]);
        foreach ($request->items as $item) {
            $purchase->items()->attach($purchase->id, [
                'item_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }

        return to_route('purchases.index')->with([
            'message' => '登録完了しました。',
            'status' => 'success'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->role === 'admin') {

            $reservation = Reservation::with(['customer', 'stylelist', 'item'])
                ->findOrFail($id);

            return Inertia::render('Purchase/Show', [
                'reservation' => $reservation
            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role === 'admin') {
            $reservation = Reservation::with(['customer', 'stylelist', 'item'])
                ->findOrFail($id);

            $stylelists = Stylelist::all();
            $items = Item::all();

            return Inertia::render('Purchase/Edit', [
                'reservation' => $reservation,
                'stylelists' => $stylelists,
                'items' => $items,

            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Reservation $reservation)
    {
        // $this->authorize('update', $purchase);
        $reservation->status = $request->status;
        $reservation->customer_id = $request->customer_id;
        $reservation->stylelist_id = $request->stylelist_id;
        $reservation->item_id = $request->item_id;
        $reservation->date = $request->date;
        $reservation->time = $request->time;

        $reservation->save();
        return to_route('purchases.index')->with([
            'message' => '修正完了しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
