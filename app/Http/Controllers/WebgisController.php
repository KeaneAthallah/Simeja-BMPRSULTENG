<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Webgis;
use Illuminate\Http\Request;

class WebgisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.webgis.index', ['title' => 'Webgis']);
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
    public function show(Webgis $webgis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Webgis $webgis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Webgis $webgis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webgis $webgis)
    {
        //
    }
    public function users()
    {
        $users = User::all();
        return view('pages.webgis.users', ['title' => 'Semua Users', 'datas' => $users]);
    }
    public function addUser()
    {
        return view('pages.webgis.addUser', ['title' => 'Tambah User']);
    }
}
