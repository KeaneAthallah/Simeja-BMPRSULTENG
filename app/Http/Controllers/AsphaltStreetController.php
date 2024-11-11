<?php

namespace App\Http\Controllers;

use App\Models\AsphaltStreet;
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
            return view('pages.jalanAspal.create', ['title' => 'Tambah Jalan Aspal', 'users' =>  User::where('role', '!=', 'admin')->get()]);
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
                'date' => 'required|date',
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
            return view('pages.jalanAspal.index', [
                'title' => 'Edit Jalan Aspal',
                'users' =>  User::where('role', '!=', 'admin')->get(),
                'data' => $asphaltStreet,
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
                'noProvinsi' => 'required|numeric',
                'noRuas' => 'required|string|max:9',
                'namaProvinsi' => 'required|string|max:255',
                'namaRuas' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'fungsi' => 'required|string|max:255',
                'date' => 'required|date',
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
