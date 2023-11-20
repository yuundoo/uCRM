<?php

namespace App\Http\Controllers;

use App\Models\InertiaTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaController extends Controller
{
    //

    public function index()
    {
        Inertia::render('Inertia/Index');
    }

    public function show($id)
    {
        dd($id);

        return Inertia::render('Inertia/Show', [
            'id' => $id
        ]);
    }

    public function store(Request $request)
    {
        $inertiaTest = new InertiaTest();
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();

        return to_route('inertia.index');
    }
}
