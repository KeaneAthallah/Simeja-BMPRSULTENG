<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AsphaltStreet;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AsphaltStreetData;
use Illuminate\Support\Facades\Storage;

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
        } else if (auth()->user()->role == 'admin') {
            $data = AsphaltStreetData::all();
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
            return view('pages.dataJalanAspal.create', ['title' => 'Tambah Jalan Aspal Data', 'jalanAspals' => $asphaltStreets]);
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
                "image" => "nullable|max:2048",
                'koordinat' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // Attempt to decode JSON string
                        $coordinates = json_decode($value, true);

                        // Check if JSON parsing is successful
                        if (json_last_error() !== JSON_ERROR_NONE || !is_array($coordinates)) {
                            $fail("The {$attribute} field must be a valid JSON array of coordinate pairs.");
                            return;
                        }

                        // Validate each coordinate pair
                        foreach ($coordinates as $index => $coordinate) {
                            if (!is_array($coordinate) || count($coordinate) !== 2) {
                                $fail("Each coordinate pair in {$attribute} must contain exactly two values (longitude and latitude). Error at index {$index}.");
                                return;
                            }
                        }
                    }
                ],
                'asphalt_street_id' => 'required|integer',
                'permukaanPerkerasan' => 'required|integer|in:1,2',
                'dariPatok' => 'required|string|max:255',
                'kePatok' => 'required|string|max:255',
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
                'koordinat.required' => 'Field koordinat wajib diisi.',
                'koordinat.array' => 'Field koordinat harus berupa array pasangan koordinat.',
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
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
            if ($request->hasFile('image')) {
                // Process the file
                $validatedData['image'] = $request->file('image')->store('complain_images');
            } else {
                dd('No file uploaded'); // Or log this message
            }
            $panjang =
                intval(substr($request->kePatok, -3)) -
                intval(substr($request->dariPatok, -3));
            $result1 = '';
            if ($request->luas == 1) {
                $result1 = 0;
            } elseif ($request->luas == 2) {
                $result1 = 5;
            } elseif ($request->luas == 3) {
                $result1 = 20;
            } elseif ($request->luas == 4) {
                $result1 = 40;
            }

            $result2 = '';
            if ($request->lebar === '') {
                $result2 = '';
            } elseif ($request->lebar == 4) {
                $result2 = $result1 * 2;
            } else {
                $result2 = 0;
            }

            $result3 = $result2 == 0 ? $result1 : $result2;

            $result4 = '';
            if ($request->jumlahLubang == 1) {
                $result4 = $result3;
            } elseif ($request->jumlahLubang == 2) {
                $result4 = $result3 + 15;
            } elseif ($request->jumlahLubang == 3) {
                $result4 = $result3 + 75;
            } elseif ($request->jumlahLubang == 4) {
                $result4 = $result3 + 225;
            }
            $result5 = '';
            if ($request->bekasRoda == 1) {
                $result5 = $result4;
            } elseif ($request->bekasRoda == 2) {
                $result5 = $result4 + 5 * 0.5;
            } elseif ($request->bekasRoda == 3) {
                $result5 = $result4 + 5 * 2;
            } elseif ($request->bekasRoda == 4) {
                $result5 = $result4 + 5 * 4;
            }
            $result6 = $result5 = '' ? '' : $result5;
            $nilaiIri = 0;
            $result7 = 0;
            if ($nilaiIri <= 4 && $result6 <= 50) {
                $result7 = $panjang;
            }
            $result8 = 0;
            if (
                ($nilaiIri <= 4 && $result6 > 50 && $result6 <= 100) ||
                ($nilaiIri > 4 && $nilaiIri <= 8 && $result6 <= 100)
            ) {
                $result8 = $panjang;
            }
            $result9 = 0;
            if (
                ($nilaiIri <= 8 && $result6 > 100 && $result6 <= 150) ||
                ($nilaiIri > 8 && $nilaiIri <= 12 && $result6 <= 150)
            ) {
                $result9 = $panjang;
            }
            $result10 = 0;
            if (
                ($nilaiIri > 12 && $result6 >= 0) ||
                ($nilaiIri <= 12 && $result6 > 150)
            ) {
                $result10 = $panjang;
            }
            $result11 = isset($result7) && isset($result8) ? $result7 + $result8 : 0;
            $result12 = isset($result9) && isset($result10) ? $result9 + $result10 : 0;
            if ($result7 + $result8 > 0 && $result9 + $result10 == 0) {
                $pemeliharaan = 'Pemeliharaan Rutin';
            } elseif ($result7 + $result8 + $result10 == 0 && $result9 > 0) {
                $pemeliharaan = 'Pemeliharaan Berkala';
            } elseif ($result7 + $result8 + $result9 == 0 && $result10 > 0) {
                $pemeliharaan = 'Peningkatan/Rekonstruksi';
            } else {
                $pemeliharaan = '';
            }
            if ($result6 < 50) {
                $kondisi = 'Baik';
            } elseif ($result6 <= 100) {
                $kondisi = 'Sedang';
            } elseif ($result6 < 150) {
                $kondisi = 'Rusak Ringan';
            } else {
                $kondisi = 'Rusak Berat';
            }
            $streetModel = AsphaltStreet::where('id', '=', $request->asphalt_street_id)->first();
            $validatedData['noRuas'] = $streetModel->noRuas;
            $validatedData['penanganan'] = $pemeliharaan;
            $validatedData['panjang'] = $panjang;
            $validatedData['sdi'] = $result6;
            $validatedData['kondisiJalan'] = $kondisi;
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
        // dd($asphaltStreetData->asphaltStreet->surveyor);
        $surveyorIds = explode(',', $asphaltStreetData->asphaltStreet->surveyor);
        $users = User::whereIn('id', $surveyorIds)->get();
        $pdf = Pdf::loadView('pages.jalanAspal.show', ['data' => $asphaltStreetData, 'title' => 'Detail Jalan Aspal', 'users' => $users]);
        return $pdf->stream('DetailJalanAspal.pdf');
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
                "image" => "nullable|max:2048",
                'koordinat' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        // Attempt to decode JSON string
                        $coordinates = json_decode($value, true);

                        // Check if JSON parsing is successful
                        if (json_last_error() !== JSON_ERROR_NONE || !is_array($coordinates)) {
                            $fail("The {$attribute} field must be a valid JSON array of coordinate pairs.");
                            return;
                        }

                        // Validate each coordinate pair
                        foreach ($coordinates as $index => $coordinate) {
                            if (!is_array($coordinate) || count($coordinate) !== 2) {
                                $fail("Each coordinate pair in {$attribute} must contain exactly two values (longitude and latitude). Error at index {$index}.");
                                return;
                            }
                        }
                    }
                ],
                'asphalt_street_id' => 'required|integer',
                'permukaanPerkerasan' => 'required|integer|in:1,2',
                'kondisi' => 'required|integer|in:1,2,3,4,5',
                'dariPatok' => 'required|string|max:255',
                'kePatok' => 'required|string|max:255',
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
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
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
            if ($request->hasFile('image')) {
                // Delete the old image file if it exists
                if ($asphaltStreetData->image) {
                    Storage::delete($asphaltStreetData->image);
                }
                // Store the new image file and update the image path in the validated data
                $validatedData['image'] = $request->file('image')->store('complain_images');
            }
            $panjang =
                intval(substr($request->kePatok, -3)) -
                intval(substr($request->dariPatok, -3));
            $result1 = '';
            if ($request->luas == 1) {
                $result1 = 0;
            } elseif ($request->luas == 2) {
                $result1 = 5;
            } elseif ($request->luas == 3) {
                $result1 = 20;
            } elseif ($request->luas == 4) {
                $result1 = 40;
            }

            $result2 = '';
            if ($request->lebar === '') {
                $result2 = '';
            } elseif ($request->lebar == 4) {
                $result2 = $result1 * 2;
            } else {
                $result2 = 0;
            }

            $result3 = $result2 == 0 ? $result1 : $result2;

            $result4 = '';
            if ($request->jumlahLubang == 1) {
                $result4 = $result3;
            } elseif ($request->jumlahLubang == 2) {
                $result4 = $result3 + 15;
            } elseif ($request->jumlahLubang == 3) {
                $result4 = $result3 + 75;
            } elseif ($request->jumlahLubang == 4) {
                $result4 = $result3 + 225;
            }
            $result5 = '';
            if ($request->bekasRoda == 1) {
                $result5 = $result4;
            } elseif ($request->bekasRoda == 2) {
                $result5 = $result4 + 5 * 0.5;
            } elseif ($request->bekasRoda == 3) {
                $result5 = $result4 + 5 * 2;
            } elseif ($request->bekasRoda == 4) {
                $result5 = $result4 + 5 * 4;
            }
            $result6 = $result5 = '' ? '' : $result5;
            $nilaiIri = 0;
            $result7 = 0;
            if ($nilaiIri <= 4 && $result6 <= 50) {
                $result7 = $panjang;
            }
            $result8 = 0;
            if (
                ($nilaiIri <= 4 && $result6 > 50 && $result6 <= 100) ||
                ($nilaiIri > 4 && $nilaiIri <= 8 && $result6 <= 100)
            ) {
                $result8 = $panjang;
            }
            $result9 = 0;
            if (
                ($nilaiIri <= 8 && $result6 > 100 && $result6 <= 150) ||
                ($nilaiIri > 8 && $nilaiIri <= 12 && $result6 <= 150)
            ) {
                $result9 = $panjang;
            }
            $result10 = 0;
            if (
                ($nilaiIri > 12 && $result6 >= 0) ||
                ($nilaiIri <= 12 && $result6 > 150)
            ) {
                $result10 = $panjang;
            }
            $result11 = isset($result7) && isset($result8) ? $result7 + $result8 : 0;
            $result12 = isset($result9) && isset($result10) ? $result9 + $result10 : 0;
            if ($result7 + $result8 > 0 && $result9 + $result10 == 0) {
                $pemeliharaan = 'Pemeliharaan Rutin';
            } elseif ($result7 + $result8 + $result10 == 0 && $result9 > 0) {
                $pemeliharaan = 'Pemeliharaan Berkala';
            } elseif ($result7 + $result8 + $result9 == 0 && $result10 > 0) {
                $pemeliharaan = 'Peningkatan/Rekonstruksi';
            } else {
                $pemeliharaan = '';
            }
            if ($result6 < 50) {
                $kondisi = 'Baik';
            } elseif ($result6 <= 100) {
                $kondisi = 'Sedang';
            } elseif ($result6 < 150) {
                $kondisi = 'Rusak Ringan';
            } else {
                $kondisi = 'Rusak Berat';
            }
            $streetModel = AsphaltStreet::where('id', '=', $request->asphalt_street_id)->first();
            $validatedData['noRuas'] = $streetModel->noRuas;
            $validatedData['penanganan'] = $pemeliharaan;
            $validatedData['panjang'] = $panjang;
            $validatedData['sdi'] = $result6;
            $validatedData['kondisiJalan'] = $kondisi;
            $asphaltStreetData->update($validatedData);
            return redirect()->route('dataJalanAspal.index');
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
