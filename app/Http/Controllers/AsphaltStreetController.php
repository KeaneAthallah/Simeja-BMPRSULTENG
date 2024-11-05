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
        $data = AsphaltStreet::all();
        return view("pages.jalanAspal.index", ["datas" => $data, 'title' => 'Jalan Aspal']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jalanAspal.create', ['title' => 'Tambah Jalan Aspal', 'users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            '_token' => 'required|string',
            'noProvinsi' => 'required|numeric',
            'noRuas' => 'required|string|max:5',
            'namaProvinsi' => 'required|string|max:255',
            'namaRuas' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'dariPatok' => 'required|string|max:255',
            'date' => 'required|date',
            'kePatok' => 'required|string|max:255',
            'surveyor' => 'required|array|min:1',
            'surveyor.*' => 'integer',
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
            'noProvinsi.required' => 'Nomor provinsi harus diisi.',
            'noProvinsi.numeric' => 'Nomor provinsi harus berupa angka.',
            'noRuas.required' => 'Nomor ruas harus diisi.',
            'noRuas.max' => 'Nomor ruas maksimal 5 karakter.',
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
        $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
        AsphaltStreet::create($validatedData);

        return redirect()->route('jalanAspal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AsphaltStreet $asphaltStreet)
    {
        $pdf = Pdf::loadView('pages.jalanAspal.show', ['data' => $asphaltStreet, 'title' => 'Detail Jalan Aspal', 'users' => User::all()]);
        return $pdf->stream('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsphaltStreet $asphaltStreet)
    {
        // Display the names
        return view('pages.jalanAspal.edit', [
            'title' => 'Edit Jalan Aspal',
            'users' => User::all(),
            'data' => $asphaltStreet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AsphaltStreet $asphaltStreet)
    {
        $validatedData = $request->validate([
            '_token' => 'required|string',
            'noProvinsi' => 'required|numeric',
            'noRuas' => 'required|string|max:5',
            'namaProvinsi' => 'required|string|max:255',
            'namaRuas' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'dariPatok' => 'required|string|max:255',
            'date' => 'required|date',
            'kePatok' => 'required|string|max:255',
            'surveyor' => 'required|array|min:1',
            'surveyor.*' => 'integer',
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
            'noProvinsi.required' => 'Nomor provinsi harus diisi.',
            'noProvinsi.numeric' => 'Nomor provinsi harus berupa angka.',
            'noRuas.required' => 'Nomor ruas harus diisi.',
            'noRuas.max' => 'Nomor ruas maksimal 5 karakter.',
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
        $validatedData['surveyor'] = implode(',', $validatedData['surveyor']);
        $asphaltStreet->update($validatedData);
        return redirect()->route('jalanAspal.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsphaltStreet $asphaltStreet)
    {
        //
    }
}
