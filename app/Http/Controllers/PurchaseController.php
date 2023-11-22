<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use Inertia\Inertia;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');

        $orders = Order::query()
            ->search($searchTerm) // 검색 스코프 메서드 적용
            ->groupBy('id', 'customer_name', 'item_name', 'status', 'created_at')
            ->selectRaw('id, customer_name, item_name, sum(subtotal) as total, status, created_at')
            ->paginate(50);

        return Inertia::render('Purchase/Index', [
            'orders' => $orders,
            'filters' => $request->only(['search' => $searchTerm]), // 검색 필터를 프론트엔드에 전달
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::select('id', 'username', 'kana')->get();
        $items = Item::select('id', 'name', 'price')->where('is_selling', true)->get();

        return Inertia::render('Purchase/Create', [
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {

        DB::beginTransaction();

        try {

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
            DB::commit();

            return to_route('dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $item = Order::where('id', $purchase->id)->get();

        //합계
        $order = Order::where('id', $purchase->id)
            ->groupBy('id')
            ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at, updated_at')
            ->get();
        return Inertia::render('Purchase/Show', [
            'item' => $item,
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
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
