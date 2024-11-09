<?php

namespace App\Http\Controllers;

use App\Models\RoadInventory;
use Illuminate\Http\Request;

class RoadInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.inventarisJalan.index", ["datas" => RoadInventory::all(), 'title' => 'Inventaris Jalan']);
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
    public function show(RoadInventory $roadInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoadInventory $roadInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoadInventory $roadInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoadInventory $roadInventory)
    {
        //
    }
}
