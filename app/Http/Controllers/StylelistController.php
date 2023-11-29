<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStylelistRequest;
use App\Http\Requests\UpdateStylelistRequest;
use App\Models\Stylelist;
use Inertia\Inertia;

class StylelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Stylelist/Index', [
            'stylelists' => Stylelist::select(
                'id',
                'name',
                'profile_image',
                'description',
                'review_count',
                'average_rating',
                'tags',
            )->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stylelist  $stylelist
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStylelistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStylelistRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stylelist  $stylelist
     * @return \Illuminate\Http\Response
     */
    public function show(Stylelist $stylelist)
    {
        return Inertia::render('Stylelist/Show', [
            'stylelist' => $stylelist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stylelist  $stylelist
     * @return \Illuminate\Http\Response
     */
    public function edit(Stylelist $stylelist)
    {
        return Inertia::render('Stylelist/Edit', [
            'stylelists' => $stylelist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStylelistRequest  $request
     * @param  \App\Models\Stylelist  $stylelist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStylelistRequest $request, Stylelist $stylelist)
    {
        $stylelist->name = $request->name;
        $stylelist->profile_image = $request->profile_image;
        $stylelist->description = $request->description;
        $stylelist->tags = $request->tags;
        $stylelist->save();
        return to_route('stylelists.index')
            ->with([
                'message' => '更新しました。',
                'status' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stylelist  $stylelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stylelist $stylelist)
    {
        $stylelist->delete();
        return to_route('stylelists.index')->with([
            'message' => '削除しました。',
            'status' => 'danger'
        ]);
    }
}
