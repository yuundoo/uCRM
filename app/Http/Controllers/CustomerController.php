<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (auth()->user()->role === 'admin') {
            $customers =
                Customer::searchCustomers($request->search)
                ->select('id', 'username', 'kana', 'tel')->paginate(50);
            return Inertia::render('Customer/Index', [
                'customers' => $customers
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
            return Inertia::render('Customer/Create');
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create([
            'username' => $request->username,
            'kana' => $request->kana,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postcode' => $request->postcode,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'usermemo' => $request->usermemo,
        ]);

        return to_route('customers.index')->with([
            'message' => '登録完了しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if (auth()->user()->role === 'admin') {
            return Inertia::render('Customer/Show', [
                'customer' => $customer
            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        if (auth()->user()->role === 'admin') {
            return Inertia::render('Customer/Edit', [
                'customer' => $customer
            ]);
        } else {
            abort(403, '権限がありません。');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)

    {
        $customer->username = $request->username;
        $customer->kana =   $request->kana;
        $customer->tel =   $request->tel;
        $customer->email =  $request->email;
        $customer->postcode = $request->postcode;
        $customer->address =  $request->address;
        $customer->birthday = $request->birthday;
        $customer->gender =  $request->gender;
        $customer->usermemo = $request->usermemo;
        $customer->role = $request->role;
        $customer->save();
        return to_route('customers.index')
            ->with([
                'message' => '更新しました。',
                'status' => 'success'
            ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
