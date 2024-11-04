<?php

namespace App\Http\Controllers;

use App\Models\AsphaltStreet;
use Illuminate\Http\Request;

class AsphaltStreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AsphaltStreet::all();
        return view("pages.jalanAspal.index", ["datas" => $data, 'title' => 'Jalan Aspal']);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AsphaltStreet $asphaltStreet)
    {
        return view('pages.jalanAspal.show', ['data' => $asphaltStreet, 'title' => 'Jalan Aspal']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsphaltStreet $asphaltStreet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsphaltStreet $asphaltStreet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsphaltStreet $asphaltStreet)
    {
        //
    }
}
