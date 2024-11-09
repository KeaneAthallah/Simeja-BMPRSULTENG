<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SoilsStreet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SoilsStreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            return view('pages.jalanTanah.create', ['title' => 'Tambah Jalan Tanah/Kerikil', 'users' =>  User::where('role', '!=', 'admin')->get()]);
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
                'noProvinsi' => 'required|numeric',
                'noRuas' => 'required|string|max:9',
                'namaProvinsi' => 'required|string|max:255',
                'namaRuas' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'fungsi' => 'required|string|max:255',
                'dariPatok' => 'required|string|max:255',
                'date' => 'required|date',
                'kePatok' => 'required|string|max:255',
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
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
                'date.required' => 'Tanggal harus diisi.',
                'date.date' => 'Format tanggal tidak valid.',
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
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
    public function show(SoilsStreet $soilsStreet)
    {
        $pdf = Pdf::loadView('pages.jalanTanah.show', ['data' => $soilsStreet, 'title' => 'Detail Jalan Aspal', 'users' =>  User::where('role', '!=', 'admin')->get()]);
        return $pdf->stream('DetailJalanTanah-Kerikil.pdf');
    }

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
                'noProvinsi' => 'required|numeric',
                'noRuas' => 'required|string|max:9',
                'namaProvinsi' => 'required|string|max:255',
                'namaRuas' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'fungsi' => 'required|string|max:255',
                'dariPatok' => 'required|string|max:255',
                'date' => 'required|date',
                'kePatok' => 'required|string|max:255',
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
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
                'date.required' => 'Tanggal harus diisi.',
                'date.date' => 'Format tanggal tidak valid.',
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
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
