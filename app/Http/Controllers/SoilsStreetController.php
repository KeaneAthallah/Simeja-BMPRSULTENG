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
        if(auth()->user()->role == "admin") {
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
        if(auth()->user()->role == 'admin') {
            return view('pages.jalanTanah.create', ['title' => 'Tambah Jalan Tanah/Kerikil', 'users' => User::all()]);
        } else {
            return view('401');
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->role == 'admin') {
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
            'kemiringan' => 'required|integer|in:1,2',
            'penurunan' => 'required|integer|in:1,2,3,4,5',
            'erosi' => 'required|integer|in:1,2,3,4,5',
            'ukuranTerbanyak' => 'required|integer|min:1',
            'tebalLapisan' => 'required|integer|min:1',
            'distribusi' => 'required|integer|min:1',
            'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
            'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
            'bekasRoda' => 'required|integer|in:1,2,3,4,5',
            'bergelombang' => 'required|integer|in:1,2,3,4,5',
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
            'kemiringan.required' => 'Permukaan perkerasan harus diisi.',
            'kemiringan.integer' => 'Permukaan perkerasan harus berupa angka.',
            'kemiringan.in' => 'Permukaan perkerasan harus salah satu dari: 1, 2.',
            'penurunan.required' => 'Penurunan harus diisi.',
            'penurunan.integer' => 'Penurunan harus berupa angka.',
            'penurunan.in' => 'Penurunan harus salah satu dari: 1, 2, 3, 4, 5.',
            'erosi.required' => 'erosi harus diisi.',
            'erosi.integer' => 'erosi harus berupa angka.',
            'erosi.in' => 'erosi harus salah satu dari: 1, 2, 3, 4, 5.',
            'ukuranTerbanyak.required' => 'Ukuran Terbanyak harus diisi.',
            'ukuranTerbanyak.integer' => 'Ukuran Terbanyak harus berupa angka.',
            'ukuranTerbanyak.in' => 'Ukuran Terbanyak harus salah satu dari: 1, 2, 3, 4, 5.',
            'tebalLapisan.required' => 'tebal Lapisan harus diisi.',
            'tebalLapisan.integer' => 'tebal Lapisan harus berupa angka.',
            'tebalLapisan.min' => 'tebal Lapisan harus lebih dari 0.',
            'distribusi.required' => 'distribusi harus diisi.',
            'distribusi.integer' => 'distribusi harus berupa angka.',
            'distribusi.min' => 'distribusi harus lebih dari 0.',
            'jumlahLubang.required' => 'Jumlah lubang harus diisi.',
            'jumlahLubang.integer' => 'Jumlah lubang harus berupa angka.',
            'jumlahLubang.in' => 'Jumlah lubang harus salah satu dari: 1, 2, 3, 4, 5.',
            'ukuranLubang.required' => 'Ukuran lubang harus diisi.',
            'ukuranLubang.integer' => 'Ukuran lubang harus berupa angka.',
            'ukuranLubang.in' => 'Ukuran lubang harus salah satu dari: 1, 2, 3, 4, 5.',
            'bekasRoda.required' => 'Bekas roda harus diisi.',
            'bekasRoda.integer' => 'Bekas roda harus berupa angka.',
            'bekasRoda.in' => 'Bekas roda harus salah satu dari: 1, 2, 3, 4, 5.',
            'bergelombang.required' => 'Bergelombang harus diisi.',
            'bergelombang.integer' => 'Bergelombang harus berupa angka.',
            'bergelombang.in' => 'Bergelombang harus salah satu dari: 1, 2, 3, 4, 5.',
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
        $pdf = Pdf::loadView('pages.jalanTanah.show', ['data' => $soilsStreet, 'title' => 'Detail Jalan Aspal', 'users' => User::all()]);
        return $pdf->stream('DetailJalanTanah-Kerikil.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoilsStreet $soilsStreet)
    {
        if(auth()->user()->role == 'admin') {
            return view('pages.jalanTanah.edit', [
                'title' => 'Edit Jalan Tanah/Kerikil',
                'users' => User::all(),
                'data' => $soilsStreet,
            ]);
        }
        else {
            return view('401');
        }
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoilsStreet $soilsStreet)
    {
        if(auth()->user()->role == 'admin') {
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
            'kemiringan' => 'required|integer|in:1,2',
            'penurunan' => 'required|integer|in:1,2,3,4,5',
            'erosi' => 'required|integer|in:1,2,3,4,5',
            'ukuranTerbanyak' => 'required|integer|min:1',
            'tebalLapisan' => 'required|integer|min:1',
            'distribusi' => 'required|integer|min:1',
            'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
            'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
            'bekasRoda' => 'required|integer|in:1,2,3,4,5',
            'bergelombang' => 'required|integer|in:1,2,3,4,5',
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
            'kemiringan.required' => 'Permukaan perkerasan harus diisi.',
            'kemiringan.integer' => 'Permukaan perkerasan harus berupa angka.',
            'kemiringan.in' => 'Permukaan perkerasan harus salah satu dari: 1, 2.',
            'penurunan.required' => 'Penurunan harus diisi.',
            'penurunan.integer' => 'Penurunan harus berupa angka.',
            'penurunan.in' => 'Penurunan harus salah satu dari: 1, 2, 3, 4, 5.',
            'erosi.required' => 'erosi harus diisi.',
            'erosi.integer' => 'erosi harus berupa angka.',
            'erosi.in' => 'erosi harus salah satu dari: 1, 2, 3, 4, 5.',
            'ukuranTerbanyak.required' => 'Ukuran Terbanyak harus diisi.',
            'ukuranTerbanyak.integer' => 'Ukuran Terbanyak harus berupa angka.',
            'ukuranTerbanyak.in' => 'Ukuran Terbanyak harus salah satu dari: 1, 2, 3, 4, 5.',
            'tebalLapisan.required' => 'tebal Lapisan harus diisi.',
            'tebalLapisan.integer' => 'tebal Lapisan harus berupa angka.',
            'tebalLapisan.min' => 'tebal Lapisan harus lebih dari 0.',
            'distribusi.required' => 'distribusi harus diisi.',
            'distribusi.integer' => 'distribusi harus berupa angka.',
            'distribusi.min' => 'distribusi harus lebih dari 0.',
            'jumlahLubang.required' => 'Jumlah lubang harus diisi.',
            'jumlahLubang.integer' => 'Jumlah lubang harus berupa angka.',
            'jumlahLubang.in' => 'Jumlah lubang harus salah satu dari: 1, 2, 3, 4, 5.',
            'ukuranLubang.required' => 'Ukuran lubang harus diisi.',
            'ukuranLubang.integer' => 'Ukuran lubang harus berupa angka.',
            'ukuranLubang.in' => 'Ukuran lubang harus salah satu dari: 1, 2, 3, 4, 5.',
            'bekasRoda.required' => 'Bekas roda harus diisi.',
            'bekasRoda.integer' => 'Bekas roda harus berupa angka.',
            'bekasRoda.in' => 'Bekas roda harus salah satu dari: 1, 2, 3, 4, 5.',
            'bergelombang.required' => 'Bergelombang harus diisi.',
            'bergelombang.integer' => 'Bergelombang harus berupa angka.',
            'bergelombang.in' => 'Bergelombang harus salah satu dari: 1, 2, 3, 4, 5.',
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
        $soilsStreet->update($validatedData);
        return redirect()->route('jalanTanah.index');
    }
    else {
        return view('401');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoilsStreet $soilsStreet)
    {
        //
    }
}
