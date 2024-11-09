<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AsphaltStreet;
use App\Models\AsphaltStreetData;

class AsphaltStreetDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->role == "staff") {
            $userId = auth()->user()->id;
            $asphaltStreets = AsphaltStreet::all()->filter(function ($asphaltStreet) use ($userId) {
                $surveyors = explode(',', $asphaltStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            // Get all matching asphalt_streets_id values
            $asphaltStreetIds = $asphaltStreets->pluck('id')->toArray();

            // Retrieve all AsphaltStreetData records for the matching IDs
            $data = AsphaltStreetData::whereIn('asphalt_street_id', $asphaltStreetIds)->latest()->get();
            return view("pages.dataJalanAspal.index", ["datas" => $data, 'title' => 'Jalan Aspal Data']);
        } else {
            return view('401');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'staff') {
            $userId = auth()->user()->id;
            $asphaltStreets = AsphaltStreet::all()->filter(function ($asphaltStreet) use ($userId) {
                $surveyors = explode(',', $asphaltStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            return view('pages.dataJalanAspal.create', ['title' => 'Tambah Jalan Aspal Data', 'users' => User::all(), 'jalanAspals' => $asphaltStreets]);
        } else {
            return view('401');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'staff') {
            $validatedData = $request->validate([
                '_token' => 'required|string',
                'asphalt_street_id' => 'required|integer',
                'permukaanPerkerasan' => 'required|integer|in:1,2',
                'kondisi' => 'required|integer|in:1,2,3,4,5',
                'penurunan' => 'required|integer|in:1,2,3,4,5',
                'tambalan' => 'required|integer|in:1,2,3,4,5',
                'jenis' => 'required|integer|in:1,2,3,4,5',
                'lebar' => 'required|integer|min:1',
                'luas' => 'required|integer|min:1',
                'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
                'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
                'bekasRoda' => 'required|integer|in:1,2,3,4,5',
                'kerusakanTepiKiri' => 'required|integer|in:1,2,3,4,5',
                'kerusakanTepiKanan' => 'required|integer|in:1,2,3,4,5',
                'kondisiBahuKiri' => 'required|integer|in:1,2,3,4,5',
                'kondisiBahuKanan' => 'required|integer|in:1,2,3,4,5',
                'permukaanBahuKiri' => 'required|integer|in:1,2,3,4,5',
                'permukaanBahuKanan' => 'required|integer|in:1,2,3,4,5',
                'kondisiSaluranKiri' => 'required|integer|in:1,2,3,4,5',
                'kondisiSaluranKanan' => 'required|integer|in:1,2,3,4,5',
                'kerusakanLerengKanan' => 'required|integer|in:1,2,3,4,5',
                'kerusakanLerengKiri' => 'required|integer|in:1,2,3,4,5',
                'trotoarKiri' => 'required|integer|in:1,2,3,4,5',
                'trotoarKanan' => 'required|integer|in:1,2,3,4,5',
            ], [
                '_token.required' => 'Token harus diisi.',
                'permukaanPerkerasan.required' => 'Permukaan perkerasan harus diisi.',
                'permukaanPerkerasan.integer' => 'Permukaan perkerasan harus berupa angka.',
                'permukaanPerkerasan.in' => 'Permukaan perkerasan harus salah satu dari: 1, 2.',
                'kondisi.required' => 'Kondisi harus diisi.',
                'kondisi.integer' => 'Kondisi harus berupa angka.',
                'kondisi.in' => 'Kondisi harus salah satu dari: 1, 2, 3, 4, 5.',
                'penurunan.required' => 'Penurunan harus diisi.',
                'penurunan.integer' => 'Penurunan harus berupa angka.',
                'penurunan.in' => 'Penurunan harus salah satu dari: 1, 2, 3, 4, 5.',
                'tambalan.required' => 'Tambalan harus diisi.',
                'tambalan.integer' => 'Tambalan harus berupa angka.',
                'tambalan.in' => 'Tambalan harus salah satu dari: 1, 2, 3, 4, 5.',
                'jenis.required' => 'Jenis harus diisi.',
                'jenis.integer' => 'Jenis harus berupa angka.',
                'jenis.in' => 'Jenis harus salah satu dari: 1, 2, 3, 4, 5.',
                'lebar.required' => 'Lebar harus diisi.',
                'lebar.integer' => 'Lebar harus berupa angka.',
                'lebar.min' => 'Lebar harus lebih dari 0.',
                'luas.required' => 'Luas harus diisi.',
                'luas.integer' => 'Luas harus berupa angka.',
                'luas.min' => 'Luas harus lebih dari 0.',
                'jumlahLubang.required' => 'Jumlah lubang harus diisi.',
                'jumlahLubang.integer' => 'Jumlah lubang harus berupa angka.',
                'jumlahLubang.in' => 'Jumlah lubang harus salah satu dari: 1, 2, 3, 4, 5.',
                'ukuranLubang.required' => 'Ukuran lubang harus diisi.',
                'ukuranLubang.integer' => 'Ukuran lubang harus berupa angka.',
                'ukuranLubang.in' => 'Ukuran lubang harus salah satu dari: 1, 2, 3, 4, 5.',
                'bekasRoda.required' => 'Bekas roda harus diisi.',
                'bekasRoda.integer' => 'Bekas roda harus berupa angka.',
                'bekasRoda.in' => 'Bekas roda harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanTepiKiri.required' => 'Kerusakan tepi kiri harus diisi.',
                'kerusakanTepiKiri.integer' => 'Kerusakan tepi kiri harus berupa angka.',
                'kerusakanTepiKiri.in' => 'Kerusakan tepi kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanTepiKanan.required' => 'Kerusakan tepi kanan harus diisi.',
                'kerusakanTepiKanan.integer' => 'Kerusakan tepi kanan harus berupa angka.',
                'kerusakanTepiKanan.in' => 'Kerusakan tepi kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiBahuKiri.required' => 'Kondisi bahu kiri harus diisi.',
                'kondisiBahuKiri.integer' => 'Kondisi bahu kiri harus berupa angka.',
                'kondisiBahuKiri.in' => 'Kondisi bahu kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiBahuKanan.required' => 'Kondisi bahu kanan harus diisi.',
                'kondisiBahuKanan.integer' => 'Kondisi bahu kanan harus berupa angka.',
                'kondisiBahuKanan.in' => 'Kondisi bahu kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'permukaanBahuKiri.required' => 'Permukaan bahu kiri harus diisi.',
                'permukaanBahuKiri.integer' => 'Permukaan bahu kiri harus berupa angka.',
                'permukaanBahuKiri.in' => 'Permukaan bahu kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'permukaanBahuKanan.required' => 'Permukaan bahu kanan harus diisi.',
                'permukaanBahuKanan.integer' => 'Permukaan bahu kanan harus berupa angka.',
                'permukaanBahuKanan.in' => 'Permukaan bahu kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiSaluranKiri.required' => 'Kondisi saluran kiri harus diisi.',
                'kondisiSaluranKiri.integer' => 'Kondisi saluran kiri harus berupa angka.',
                'kondisiSaluranKiri.in' => 'Kondisi saluran kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiSaluranKanan.required' => 'Kondisi saluran kanan harus diisi.',
                'kondisiSaluranKanan.integer' => 'Kondisi saluran kanan harus berupa angka.',
                'kondisiSaluranKanan.in' => 'Kondisi saluran kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanLerengKanan.required' => 'Kerusakan lereng kanan harus diisi.',
                'kerusakanLerengKanan.integer' => 'Kerusakan lereng kanan harus berupa angka.',
                'kerusakanLerengKanan.in' => 'Kerusakan lereng kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanLerengKiri.required' => 'Kerusakan lereng kiri harus diisi.',
                'kerusakanLerengKiri.integer' => 'Kerusakan lereng kiri harus berupa angka.',
                'kerusakanLerengKiri.in' => 'Kerusakan lereng kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'trotoarKiri.required' => 'Trotoar kiri harus diisi.',
                'trotoarKiri.integer' => 'Trotoar kiri harus berupa angka.',
                'trotoarKiri.in' => 'Trotoar kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'trotoarKanan.required' => 'Trotoar kanan harus diisi.',
                'trotoarKanan.integer' => 'Trotoar kanan harus berupa angka.',
                'trotoarKanan.in' => 'Trotoar kanan harus salah satu dari: 1, 2, 3, 4, 5.',
            ]);
            AsphaltStreetData::create($validatedData);
            return redirect()->route('dataJalanAspal.index');
        } else {
            return view('401');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AsphaltStreetData $asphaltStreetData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsphaltStreetData $asphaltStreetData)
    {
        if (auth()->user()->role == 'staff') {
            $userId = auth()->user()->id;
            $asphaltStreets = AsphaltStreet::all()->filter(function ($asphaltStreet) use ($userId) {
                $surveyors = explode(',', $asphaltStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            return view('pages.dataJalanAspal.edit', [
                'title' => 'Edit Jalan Aspal',
                'users' => User::all(),
                'data' => $asphaltStreetData,
                'jalanAspals' => $asphaltStreets
            ]);
        } else {
            return view('401');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsphaltStreetData $asphaltStreetData)
    {
        if (auth()->user()->role == 'staff') {
            $validatedData = $request->validate([
                '_token' => 'required|string',
                'asphalt_streets_id' => 'required|integer',
                'permukaanPerkerasan' => 'required|integer|in:1,2',
                'kondisi' => 'required|integer|in:1,2,3,4,5',
                'penurunan' => 'required|integer|in:1,2,3,4,5',
                'tambalan' => 'required|integer|in:1,2,3,4,5',
                'jenis' => 'required|integer|in:1,2,3,4,5',
                'lebar' => 'required|integer|min:1',
                'luas' => 'required|integer|min:1',
                'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
                'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
                'bekasRoda' => 'required|integer|in:1,2,3,4,5',
                'kerusakanTepiKiri' => 'required|integer|in:1,2,3,4,5',
                'kerusakanTepiKanan' => 'required|integer|in:1,2,3,4,5',
                'kondisiBahuKiri' => 'required|integer|in:1,2,3,4,5',
                'kondisiBahuKanan' => 'required|integer|in:1,2,3,4,5',
                'permukaanBahuKiri' => 'required|integer|in:1,2,3,4,5',
                'permukaanBahuKanan' => 'required|integer|in:1,2,3,4,5',
                'kondisiSaluranKiri' => 'required|integer|in:1,2,3,4,5',
                'kondisiSaluranKanan' => 'required|integer|in:1,2,3,4,5',
                'kerusakanLerengKanan' => 'required|integer|in:1,2,3,4,5',
                'kerusakanLerengKiri' => 'required|integer|in:1,2,3,4,5',
                'trotoarKiri' => 'required|integer|in:1,2,3,4,5',
                'trotoarKanan' => 'required|integer|in:1,2,3,4,5',
            ], [
                '_token.required' => 'Token harus diisi.',
                'permukaanPerkerasan.required' => 'Permukaan perkerasan harus diisi.',
                'permukaanPerkerasan.integer' => 'Permukaan perkerasan harus berupa angka.',
                'permukaanPerkerasan.in' => 'Permukaan perkerasan harus salah satu dari: 1, 2.',
                'kondisi.required' => 'Kondisi harus diisi.',
                'kondisi.integer' => 'Kondisi harus berupa angka.',
                'kondisi.in' => 'Kondisi harus salah satu dari: 1, 2, 3, 4, 5.',
                'penurunan.required' => 'Penurunan harus diisi.',
                'penurunan.integer' => 'Penurunan harus berupa angka.',
                'penurunan.in' => 'Penurunan harus salah satu dari: 1, 2, 3, 4, 5.',
                'tambalan.required' => 'Tambalan harus diisi.',
                'tambalan.integer' => 'Tambalan harus berupa angka.',
                'tambalan.in' => 'Tambalan harus salah satu dari: 1, 2, 3, 4, 5.',
                'jenis.required' => 'Jenis harus diisi.',
                'jenis.integer' => 'Jenis harus berupa angka.',
                'jenis.in' => 'Jenis harus salah satu dari: 1, 2, 3, 4, 5.',
                'lebar.required' => 'Lebar harus diisi.',
                'lebar.integer' => 'Lebar harus berupa angka.',
                'lebar.min' => 'Lebar harus lebih dari 0.',
                'luas.required' => 'Luas harus diisi.',
                'luas.integer' => 'Luas harus berupa angka.',
                'luas.min' => 'Luas harus lebih dari 0.',
                'jumlahLubang.required' => 'Jumlah lubang harus diisi.',
                'jumlahLubang.integer' => 'Jumlah lubang harus berupa angka.',
                'jumlahLubang.in' => 'Jumlah lubang harus salah satu dari: 1, 2, 3, 4, 5.',
                'ukuranLubang.required' => 'Ukuran lubang harus diisi.',
                'ukuranLubang.integer' => 'Ukuran lubang harus berupa angka.',
                'ukuranLubang.in' => 'Ukuran lubang harus salah satu dari: 1, 2, 3, 4, 5.',
                'bekasRoda.required' => 'Bekas roda harus diisi.',
                'bekasRoda.integer' => 'Bekas roda harus berupa angka.',
                'bekasRoda.in' => 'Bekas roda harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanTepiKiri.required' => 'Kerusakan tepi kiri harus diisi.',
                'kerusakanTepiKiri.integer' => 'Kerusakan tepi kiri harus berupa angka.',
                'kerusakanTepiKiri.in' => 'Kerusakan tepi kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanTepiKanan.required' => 'Kerusakan tepi kanan harus diisi.',
                'kerusakanTepiKanan.integer' => 'Kerusakan tepi kanan harus berupa angka.',
                'kerusakanTepiKanan.in' => 'Kerusakan tepi kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiBahuKiri.required' => 'Kondisi bahu kiri harus diisi.',
                'kondisiBahuKiri.integer' => 'Kondisi bahu kiri harus berupa angka.',
                'kondisiBahuKiri.in' => 'Kondisi bahu kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiBahuKanan.required' => 'Kondisi bahu kanan harus diisi.',
                'kondisiBahuKanan.integer' => 'Kondisi bahu kanan harus berupa angka.',
                'kondisiBahuKanan.in' => 'Kondisi bahu kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'permukaanBahuKiri.required' => 'Permukaan bahu kiri harus diisi.',
                'permukaanBahuKiri.integer' => 'Permukaan bahu kiri harus berupa angka.',
                'permukaanBahuKiri.in' => 'Permukaan bahu kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'permukaanBahuKanan.required' => 'Permukaan bahu kanan harus diisi.',
                'permukaanBahuKanan.integer' => 'Permukaan bahu kanan harus berupa angka.',
                'permukaanBahuKanan.in' => 'Permukaan bahu kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiSaluranKiri.required' => 'Kondisi saluran kiri harus diisi.',
                'kondisiSaluranKiri.integer' => 'Kondisi saluran kiri harus berupa angka.',
                'kondisiSaluranKiri.in' => 'Kondisi saluran kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'kondisiSaluranKanan.required' => 'Kondisi saluran kanan harus diisi.',
                'kondisiSaluranKanan.integer' => 'Kondisi saluran kanan harus berupa angka.',
                'kondisiSaluranKanan.in' => 'Kondisi saluran kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanLerengKanan.required' => 'Kerusakan lereng kanan harus diisi.',
                'kerusakanLerengKanan.integer' => 'Kerusakan lereng kanan harus berupa angka.',
                'kerusakanLerengKanan.in' => 'Kerusakan lereng kanan harus salah satu dari: 1, 2, 3, 4, 5.',
                'kerusakanLerengKiri.required' => 'Kerusakan lereng kiri harus diisi.',
                'kerusakanLerengKiri.integer' => 'Kerusakan lereng kiri harus berupa angka.',
                'kerusakanLerengKiri.in' => 'Kerusakan lereng kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'trotoarKiri.required' => 'Trotoar kiri harus diisi.',
                'trotoarKiri.integer' => 'Trotoar kiri harus berupa angka.',
                'trotoarKiri.in' => 'Trotoar kiri harus salah satu dari: 1, 2, 3, 4, 5.',
                'trotoarKanan.required' => 'Trotoar kanan harus diisi.',
                'trotoarKanan.integer' => 'Trotoar kanan harus berupa angka.',
                'trotoarKanan.in' => 'Trotoar kanan harus salah satu dari: 1, 2, 3, 4, 5.',
            ]);
            $asphaltStreetData->update($validatedData);
            return redirect()->route('dataJalanAspal.edit', $asphaltStreetData->id);
        } else {
            return view('401');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsphaltStreetData $asphaltStreetData)
    {
        $asphaltStreetData->delete();
        return redirect()->route('dataJalanAspal.index');
    }
}
