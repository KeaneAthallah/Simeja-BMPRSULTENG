<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RoadInventory;
use Barryvdh\DomPDF\Facade\Pdf;

class RoadInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.inventarisJalan.index", ["datas" => RoadInventory::all(), 'title' => 'Inventaris Jalan']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.inventarisJalan.create', ['title' => 'Tambah Inventaris Jalan', 'users' => User::where('role', '!=', 'admin')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            '_token' => 'required|string',
            'namaProvinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'noProvinsi' => 'required|numeric',
            'DRP' => 'nullable|numeric',
            'LRP' => 'nullable|numeric',
            'CHN' => 'nullable|numeric',
            'noRuas' => 'required|string|max:9',
            'namaRuas' => 'required|string|max:255',
            'dariPatokKm' => 'required|string|max:255',
            'date' => 'required|date',
            'kePatokKm' => 'required|string|max:255',
            'surveyor' => 'required',
        ], [
            '_token.required' => 'Token diperlukan.',
            'namaProvinsi.required' => 'Nama provinsi harus diisi.',
            'namaProvinsi.string' => 'Nama provinsi harus berupa teks.',
            'namaProvinsi.max' => 'Nama provinsi tidak boleh lebih dari 255 karakter.',
            'kabupaten.required' => 'Kabupaten harus diisi.',
            'kabupaten.string' => 'Kabupaten harus berupa teks.',
            'kabupaten.max' => 'Kabupaten tidak boleh lebih dari 255 karakter.',
            'noProvinsi.required' => 'Nomor provinsi harus diisi.',
            'noProvinsi.numeric' => 'Nomor provinsi harus berupa angka.',
            'DRP.numeric' => 'DRP harus berupa angka.',
            'LRP.numeric' => 'LRP harus berupa angka.',
            'CHN.numeric' => 'CHN harus berupa angka.',
            'noRuas.required' => 'Nomor ruas harus diisi.',
            'noRuas.string' => 'Nomor ruas harus berupa teks.',
            'noRuas.max' => 'Nomor ruas tidak boleh lebih dari 9 karakter.',
            'namaRuas.required' => 'Nama ruas harus diisi.',
            'namaRuas.string' => 'Nama ruas harus berupa teks.',
            'namaRuas.max' => 'Nama ruas tidak boleh lebih dari 255 karakter.',
            'dariPatokKm.required' => 'Dari Patok Km harus diisi.',
            'dariPatokKm.string' => 'Dari Patok Km harus berupa teks.',
            'dariPatokKm.max' => 'Dari Patok Km tidak boleh lebih dari 255 karakter.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'kePatokKm.required' => 'Ke Patok Km harus diisi.',
            'kePatokKm.string' => 'Ke Patok Km harus berupa teks.',
            'kePatokKm.max' => 'Ke Patok Km tidak boleh lebih dari 255 karakter.',
            'surveyor.required' => 'Surveyor harus diisi.',
        ]);
        RoadInventory::create($validatedData);
        return redirect()->route('inventarisJalan.index')->with('success', '');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoadInventory $roadInventory)
    {
        $roadInventories = RoadInventory::with('dataRoadInventory.asphaltStreet', 'dataRoadInventory.soilsStreet')->get();
        $data = [];

        foreach ($roadInventories as $roadInventory) {
            if ($roadInventory->dataRoadInventory) { // Check if dataRoadInventory exists
                foreach ($roadInventory->dataRoadInventory as $roadInventoryData) {
                    $streetData = $roadInventoryData->jenisPerkerasan == 1 ? $roadInventoryData->asphaltStreet : $roadInventoryData->soilsStreet;
                    if ($streetData) { // Check if street data exists
                        foreach ($streetData as $street) {
                            $coordinates = json_decode($street->koordinat, true);
                            $formattedCoordinates = [];
                            if ($coordinates && is_array($coordinates)) {
                                foreach ($coordinates as $coordinate) {
                                    if (is_array($coordinate) && count($coordinate) == 2) {
                                        $formattedCoordinates[] = [
                                            'longitude' => $coordinate[0],
                                            'latitude' => $coordinate[1],
                                        ];
                                    }
                                }
                            }
                            $data[] = [
                                'dari_patok' => $street->dariPatok ?? '',
                                'ke_patok' => $street->kePatok ?? '',
                                'tipe_jalan' => $roadInventoryData->tipeJalan ?? '',
                                'median' => $roadInventoryData->median ?? '',
                                'lapis_permukaan_tahun' => $roadInventoryData->lapisPermukaanTahun ?? '',
                                'lapis_permukaan_jenis' => $roadInventoryData->lapisPermukaanJenis ?? '',
                                'lapis_permukaan_lebar' => $roadInventoryData->lapisPermukaanLebar ?? '',
                                'bahu_kiri_jenis' => $roadInventoryData->bahuKiriJenis ?? '',
                                'bahu_kiri_lebar' => $roadInventoryData->bahuKiriLebar ?? '',
                                'bahu_kanan_jenis' => $roadInventoryData->bahuKananJenis ?? '',
                                'bahu_kanan_lebar' => $roadInventoryData->bahuKananLebar ?? '',
                                'saluran_kiri_jenis' => $roadInventoryData->saluranKiriJenis ?? '',
                                'saluran_kiri_lebar' => $roadInventoryData->saluranKiriLebar ?? '',
                                'saluran_kiri_dalam' => $roadInventoryData->saluranKiriDalam ?? '',
                                'saluran_kanan_jenis' => $roadInventoryData->saluranKananJenis ?? '',
                                'saluran_kanan_lebar' => $roadInventoryData->saluranKananLebar ?? '',
                                'saluran_kanan_dalam' => $roadInventoryData->saluranKananDalam ?? '',
                                'terrain_kiri' => $roadInventoryData->terrainKiri ?? '',
                                'terrain_kanan' => $roadInventoryData->terrainKanan ?? '',
                                'alinyemen_vertical' => $roadInventoryData->alinyemenVertical ?? '',
                                'alinyemen_horizontal' => $roadInventoryData->alinyemenHorizontal ?? '',
                                'tata_kiri' => $roadInventoryData->tataKiri ?? '',
                                'tata_kanan' => $roadInventoryData->tataKanan ?? '',
                            ];
                        }
                    }
                }
            }
        }

        // Sort the data by 'dari_patok' in ascending order
        usort($data, function ($a, $b) {
            return $a['dari_patok'] <=> $b['dari_patok'];
        });

        // Limit the results to a maximum of 10 entries
        $data = array_slice($data, 0, 10);

        // Check if surveyor ID(s) exist before querying
        $surveyorIds = $roadInventory->surveyor ?? '';
        $users = $surveyorIds ? User::whereIn('id', explode(',', $surveyorIds))->get() : collect();

        // Generate PDF
        $pdf = Pdf::loadView('pages.dataInventarisJalan.show', [
            'data' => $roadInventory,
            'streets' => $data,
            'title' => 'Detail Jalan Aspal',
            'users' => $users,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Detail Data Inventaris Jaringan Jalan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoadInventory $roadInventory)
    {
        return view('pages.inventarisJalan.edit', ['title' => 'Edit Inventaris Jalan', 'users' => User::where('role', '!=', 'admin')->get(), 'data' => $roadInventory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoadInventory $roadInventory)
    {
        $validatedData = $request->validate([
            '_token' => 'required|string',
            'namaProvinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'noProvinsi' => 'required|numeric',
            'DRP' => 'nullable|numeric',
            'LRP' => 'nullable|numeric',
            'CHN' => 'nullable|numeric',
            'noRuas' => 'required|string|max:9',
            'namaRuas' => 'required|string|max:255',
            'dariPatokKm' => 'required|string|max:255',
            'date' => 'required|date',
            'kePatokKm' => 'required|string|max:255',
            'surveyor' => 'required',
        ], [
            '_token.required' => 'Token diperlukan.',
            'namaProvinsi.required' => 'Nama provinsi harus diisi.',
            'namaProvinsi.string' => 'Nama provinsi harus berupa teks.',
            'namaProvinsi.max' => 'Nama provinsi tidak boleh lebih dari 255 karakter.',
            'kabupaten.required' => 'Kabupaten harus diisi.',
            'kabupaten.string' => 'Kabupaten harus berupa teks.',
            'kabupaten.max' => 'Kabupaten tidak boleh lebih dari 255 karakter.',
            'noProvinsi.required' => 'Nomor provinsi harus diisi.',
            'noProvinsi.numeric' => 'Nomor provinsi harus berupa angka.',
            'DRP.numeric' => 'DRP harus berupa angka.',
            'LRP.numeric' => 'LRP harus berupa angka.',
            'CHN.numeric' => 'CHN harus berupa angka.',
            'noRuas.required' => 'Nomor ruas harus diisi.',
            'noRuas.string' => 'Nomor ruas harus berupa teks.',
            'noRuas.max' => 'Nomor ruas tidak boleh lebih dari 9 karakter.',
            'namaRuas.required' => 'Nama ruas harus diisi.',
            'namaRuas.string' => 'Nama ruas harus berupa teks.',
            'namaRuas.max' => 'Nama ruas tidak boleh lebih dari 255 karakter.',
            'dariPatokKm.required' => 'Dari Patok Km harus diisi.',
            'dariPatokKm.string' => 'Dari Patok Km harus berupa teks.',
            'dariPatokKm.max' => 'Dari Patok Km tidak boleh lebih dari 255 karakter.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'kePatokKm.required' => 'Ke Patok Km harus diisi.',
            'kePatokKm.string' => 'Ke Patok Km harus berupa teks.',
            'kePatokKm.max' => 'Ke Patok Km tidak boleh lebih dari 255 karakter.',
            'surveyor.required' => 'Surveyor harus diisi.',
        ]);
        $roadInventory->update($validatedData);
        return redirect()->route('inventarisJalan.index')->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoadInventory $roadInventory)
    {
        $roadInventory->delete();
        return redirect()->route('inventarisJalan.index')->with('success', '');
    }
}
