<?php

namespace App\Http\Controllers;

use App\Models\Kritik;
use App\Http\Requests\StoreKritikRequest;
use App\Http\Requests\UpdateKritikRequest;

class KritikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKritikRequest $request)
    {
        $data = $request->all();
        $data['film_id'] = $request->input (key: 'film_id');
        kritik::create(attributes: $data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kritik $kritik)
    {
        return view('kritik.show', compact('kritik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kritik $kritik)
    {
        return view('kritik.edit', compact('kritik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKritikRequest $request, Kritik $kritik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kritik $kritik)
    {
        $kritik->delete();
        return redirect()->route('kritik.index')->with('success', 'Kritik berhasil dihapus.');
    }
}
