<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SoilsStreet;
use Illuminate\Http\Request;
use App\Models\RoadInventory;
use Barryvdh\DomPDF\Facade\Pdf;

class SoilsStreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = SoilsStreet::all();
        if (auth()->user()->role == "admin") {
            return view("pages.jalanTanah.index", ["datas" => SoilsStreet::all(), 'title' => 'Jalan Tanah/Kerikil']);
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
            return view('pages.jalanTanah.create', ['title' => 'Tambah Jalan Tanah/Kerikil', 'users' =>  User::where('role', '!=', 'admin')->get(), 'streets' => RoadInventory::all()]);
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
                'noProvinsi.required' => 'Nomor provinsi harus diisi.',
                'noProvinsi.numeric' => 'Nomor provinsi harus berupa angka.',
                'noRuas.required' => 'Nomor ruas harus diisi.',
                'noRuas.max' => 'Nomor ruas maksimal 9 karakter.',
                'namaProvinsi.required' => 'Nama provinsi harus diisi.',
                'namaProvinsi.max' => 'Nama provinsi maksimal 255 karakter.',
                'namaRuas.required' => 'Nama ruas harus diisi.',
                'namaRuas.max' => 'Nama ruas maksimal 255 karakter.',
                'kabupaten.required' => 'Kabupaten harus diisi.',
                'kabupaten.max' => 'Kabupaten maksimal 255 karakter.',
                'fungsi.required' => 'Fungsi harus diisi.',
                'fungsi.max' => 'Fungsi maksimal 255 karakter.',
                'date.required' => 'Tanggal harus diisi.',
                'date.date' => 'Format tanggal tidak valid.',
                'surveyor.required' => 'Surveyor harus dipilih.',
                'surveyor.array' => 'Surveyor harus berupa array.',
                'surveyor.min' => 'Minimal satu surveyor harus dipilih.',
            ]);
            $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
            SoilsStreet::create($validatedData);
            return redirect(route("jalanTanah.index"));
        } else {
            return view('401');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SoilsStreet $soilsStreet) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoilsStreet $soilsStreet)
    {
        if (auth()->user()->role == 'admin') {
            return view('pages.jalanTanah.edit', [
                'title' => 'Edit Jalan Tanah/Kerikil',
                'users' =>  User::where('role', '!=', 'admin')->get(),
                'data' => $soilsStreet,
                'streets' => RoadInventory::all()
            ]);
        } else {
            return view('401');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoilsStreet $soilsStreet)
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
                'fungsi.required' => 'Fungsi harus diisi.',
                'fungsi.max' => 'Fungsi maksimal 255 karakter.',
                'surveyor.required' => 'Surveyor harus dipilih.',
                'surveyor.array' => 'Surveyor harus berupa array.',
                'surveyor.min' => 'Minimal satu surveyor harus dipilih.',
            ]);
            $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
            $soilsStreet->update($validatedData);
            return redirect()->route('jalanTanah.index');
        } else {
            return view('401');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoilsStreet $soilsStreet)
    {
        $soilsStreet->delete();
        return redirect()->route('jalanTanah.index');
    }
}
