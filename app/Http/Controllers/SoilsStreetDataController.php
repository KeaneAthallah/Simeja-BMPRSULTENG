<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SoilsStreet;
use Illuminate\Http\Request;
use App\Models\SoilsStreetData;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SoilsStreetDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == "staff") {
            $userId = auth()->user()->id;
            $soilsStreets = SoilsStreet::all()->filter(function ($soilsStreet) use ($userId) {
                $surveyors = explode(',', $soilsStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            // Get all matching soils_streets_id values
            $soilsStreetIds = $soilsStreets->pluck('id')->toArray();

            // Retrieve all soilsStreetData records for the matching IDs
            $data = SoilsStreetData::whereIn('soils_street_id', $soilsStreetIds)->latest()->get();
            return view("pages.dataJalanTanah.index", ["datas" => $data, 'title' => 'Data Jalan Tanah/Kerikil']);
        } else if (auth()->user()->role == 'admin') {
            $data = SoilsStreetData::all();
            return view("pages.dataJalanTanah.index", ["datas" => $data, 'title' => 'Data Jalan Tanah/Kerikil']);
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
            $soilsStreets = SoilsStreet::all()->filter(function ($soilsStreet) use ($userId) {
                $surveyors = explode(',', $soilsStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            return view('pages.dataJalanTanah.create', ['title' => 'Tambah Data Jalan Tanah/Kerikil', 'jalanTanahs' => $soilsStreets]);
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'soils_street_id' => 'required|numeric',
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
                'kemiringan' => 'required|integer|in:1,2',
                'penurunan' => 'required|integer|in:1,2,3,4,5',
                'erosi' => 'required|integer|in:1,2,3,4,5',
                'ukuranTerbanyak' => 'required|integer|min:1',
                'tebalLapisan' => 'required|integer|min:1',
                'distribusi' => 'required|integer|min:1',
                'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
                'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
                'dariPatok' => 'required|string|max:255',
                'kePatok' => 'required|string|max:255',
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
                'koordinat.required' => 'Field koordinat wajib diisi.',
                'koordinat.array' => 'Field koordinat harus berupa array pasangan koordinat.',
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
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
            if ($request->hasFile('image')) {
                // Process the file
                $validatedData['image'] = $request->file('image')->store('complain_images');
            } else {
                dd('No file uploaded'); // Or log this message
            }
            SoilsStreetData::create($validatedData);
            return redirect(route("dataJalanTanah.index"));
        } else {
            return view('401');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SoilsStreetData $soilsStreetData)
    {
        $pdf = Pdf::loadView('pages.jalanTanah.show', ['data' => $soilsStreetData, 'title' => 'Detail Jalan Aspal', 'users' =>  User::where('role', '!=', 'admin')->get()]);
        return $pdf->stream('DetailJalanTanah-Kerikil.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoilsStreetData $soilsStreetData)
    {
        if (auth()->user()->role == 'staff') {
            $userId = auth()->user()->id;
            $soilsStreets = SoilsStreet::all()->filter(function ($soilsStreet) use ($userId) {
                $surveyors = explode(',', $soilsStreet->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            return view('pages.dataJalanTanah.edit', [
                'title' => 'Edit Data Jalan Tanah/Kerikil',
                'data' => $soilsStreetData,
                'jalanTanahs' => $soilsStreets
            ]);
        } else {
            return view('401');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoilsStreetData $soilsStreetData)
    {
        if (auth()->user()->role == 'staff') {
            $validatedData = $request->validate([
                '_token' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'soils_street_id' => 'required',
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
                'kemiringan' => 'required|integer|in:1,2,3,4',
                'penurunan' => 'required|integer|in:1,2,3,4,5',
                'erosi' => 'required|integer|in:1,2,3,4,5',
                'ukuranTerbanyak' => 'required|integer|min:1',
                'tebalLapisan' => 'required|integer|min:1',
                'distribusi' => 'required|integer|min:1',
                'jumlahLubang' => 'required|integer|in:1,2,3,4,5',
                'dariPatok' => 'required|string|max:255',
                'ukuranLubang' => 'required|integer|in:1,2,3,4,5',
                'kePatok' => 'required|string|max:255',
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
                'koordinat.required' => 'Field koordinat wajib diisi.',
                'koordinat.array' => 'Field koordinat harus berupa array pasangan koordinat.',
                'kemiringan.required' => 'Permukaan perkerasan harus diisi.',
                'kemiringan.integer' => 'Permukaan perkerasan harus berupa angka.',
                'kemiringan.in' => 'Permukaan perkerasan harus salah satu dari: 1, 2, 3, 4.',
                'penurunan.required' => 'Penurunan harus diisi.',
                'dariPatok.required' => 'Dari patok harus diisi.',
                'dariPatok.max' => 'Dari patok maksimal 255 karakter.',
                'penurunan.integer' => 'Penurunan harus berupa angka.',
                'penurunan.in' => 'Penurunan harus salah satu dari: 1, 2, 3, 4, 5.',
                'erosi.required' => 'erosi harus diisi.',
                'erosi.integer' => 'erosi harus berupa angka.',
                'kePatok.required' => 'Ke patok harus diisi.',
                'kePatok.max' => 'Ke patok maksimal 255 karakter.',
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
            if ($request->hasFile('image')) {
                // Delete the old image file if it exists
                if ($soilsStreetData->image) {
                    Storage::delete($soilsStreetData->image);
                }

                // Store the new image file and update the image path in the validated data
                $validatedData['image'] = $request->file('image')->store('complain_images');
            }
            $soilsStreetData->update($validatedData);
            return redirect()->route('dataJalanTanah.index');
        } else {
            return view('401');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoilsStreetData $soilsStreetData)
    {
        $soilsStreetData->delete();
        return redirect()->route('dataJalanTanah.index');
    }
}
