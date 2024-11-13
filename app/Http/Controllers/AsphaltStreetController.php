<?php

namespace App\Http\Controllers;

use App\Models\AsphaltStreet;
use App\Models\RoadInventory;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AsphaltStreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == "admin") {
            $data = AsphaltStreet::all();
            return view("pages.jalanAspal.index", ["datas" => $data, 'title' => 'Jalan Aspal']);
        } else {
            return view('401');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            return view('pages.jalanAspal.create', ['title' => 'Tambah Jalan Aspal', 'users' =>  User::where('role', '!=', 'admin')->get(), 'streets' => RoadInventory::all()]);
        } else {
            return view('401');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $validatedData = $request->validate([
                '_token' => 'required|string',
                'road_inventory_id' => 'required|integer',
                'fungsi' => 'required|string|max:255',
                'surveyor' => 'required|array|min:1',
                'surveyor.*' => 'integer',
            ], [
                '_token.required' => 'Token harus diisi.',
                'road_inventory_data_id.required' => 'ID data harus diisi.',
                'road_inventory_data_id.integer' => 'ID data harus berupa angka.',
                'surveyor.required' => 'Surveyor harus dipilih.',
                'surveyor.array' => 'Surveyor harus berupa array.',
                'surveyor.min' => 'Minimal satu surveyor harus dipilih.',
            ]);
            $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
            AsphaltStreet::create($validatedData);
            return redirect()->route('jalanAspal.index');
        } else {
            return view('401');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsphaltStreet $asphaltStreet) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsphaltStreet $asphaltStreet)
    {
        if (auth()->user()->role == 'admin') {
            // Display the names
            return view('pages.jalanAspal.edit', [
                'title' => 'Edit Jalan Aspal',
                'users' =>  User::where('role', '!=', 'admin')->get(),
                'data' => $asphaltStreet,
                'streets' => RoadInventory::all()
            ]);
        } else {
            return view('401');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsphaltStreet $asphaltStreet)
    {
        if (auth()->user()->role == 'admin') {
            $validatedData = $request->validate([
                '_token' => 'required|string',
                'road_inventory_id' => 'required|integer',
                'fungsi' => 'required|string|max:255',
                'surveyor' => 'required|array|min:1',
                'surveyor.*' => 'integer',

            ], [
                '_token.required' => 'Token harus diisi.',
                'road_inventory_data_id.required' => 'ID data harus diisi.',
                'road_inventory_data_id.integer' => 'ID data harus berupa angka.',
                'fungsi.required' => 'Fungsi harus diisi.',
                'fungsi.max' => 'Fungsi maksimal 255 karakter.',
                'surveyor.required' => 'Surveyor harus dipilih.',
                'surveyor.array' => 'Surveyor harus berupa array.',
                'surveyor.min' => 'Minimal satu surveyor harus dipilih.',

            ]);
            $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
            $asphaltStreet->update($validatedData);
            return redirect()->route('jalanAspal.edit');
        } else {
            return view('401');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsphaltStreet $asphaltStreet)
    {
        $asphaltStreet->delete();
        return redirect()->route('jalanAspal.index');
    }
}
