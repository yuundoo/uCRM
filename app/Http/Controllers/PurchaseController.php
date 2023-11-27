<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use Inertia\Inertia;
use App\Models\Item;
use App\Models\Order;
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
            ->groupBy('id')
            ->selectRaw('id, MAX(customer_name) as customer_name, GROUP_CONCAT(item_name) as item_name, SUM(subtotal) as total, MAX(status) as status, MAX(created_at) as created_at')
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
        $items = Item::select('id', 'name', 'price')->where('is_selling', true)->get();
        return Inertia::render('Purchase/Create', [
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
        // Eager Loading을 사용하여 관련 항목 데이터를 미리 로드
        $purchase->load('items');

        // items를 키-값 쌍으로 변환
        $purchaseItems = $purchase->items->keyBy('id');

        // 모든 상품 정보를 가져오면서 해당 구매 항목의 수량을 설정
        $allItems = Item::select('id', 'name', 'price')
            ->get()
            ->map(function ($item) use ($purchaseItems) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $purchaseItems[$item->id]->pivot->quantity ?? 0,
                ];
            });

        return Inertia::render('Purchase/Edit', [
            'items' => $allItems,
            'order' => $purchase->only(['id', 'customer_id', 'customer_name', 'status', 'created_at']),
        ]);
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
        $purchase->status = $request->status;
        $purchase->save();

        $items = [];
        foreach ($request->items as $item) {
            $items = $items + [
                $item['id'] => [
                    'quantity' => $item['quantity']
                ]
            ];
        }

        $purchase->items()->sync($items);
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
