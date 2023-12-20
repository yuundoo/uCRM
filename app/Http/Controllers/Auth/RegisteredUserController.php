<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Customer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create([
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
            'role' => 'user'
        ]);

        Auth::login($customer);

        return redirect(RouteServiceProvider::HOME);
    }
}
