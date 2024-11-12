<?php

namespace App\Http\Controllers;

use App\Models\AsphaltStreetData;
use App\Models\RoadInventory;
use App\Models\RoadInventoryData;
use App\Models\SoilsStreetData;
use Illuminate\Http\Request;

class RoadInventoryDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == "staff" || auth()->user()->role == "admin") { {
                $userId = auth()->user()->id;
                $roadInvetories = RoadInventory::all()->filter(function ($raodInventory) use ($userId) {
                    $surveyors = explode(',', $raodInventory->surveyor); // Split surveyors into an array
                    return in_array($userId, $surveyors); // Check if user ID is in the array
                });
                // Get all matching soils_streets_id values
                $raodInventoryIds = $roadInvetories->pluck('id')->toArray();
                // Retrieve all raodInventoryData records for the matching IDs
                $data = RoadInventoryData::whereIn('road_inventory_id', $raodInventoryIds)->latest()->get();
                return view("pages.dataInventarisJalan.index", ["datas" => $data, 'title' => 'Data Inventaris Jaringan Jalan']);
            }
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
            $roadInvetories = RoadInventory::all()->filter(function ($roadInventory) use ($userId) {
                $surveyors = explode(',', $roadInventory->surveyor); // Split surveyors into an array
                return in_array($userId, $surveyors); // Check if user ID is in the array
            });
            return view('pages.dataInventarisJalan.create', [
                'title' => 'Tambah Data Inventaris Jaringan Jalan',
                // 'aspals' => AsphaltStreetData::where('noRuas', $roadInvetories->noRuas),
                // 'tanahs' => SoilsStreetData::where('noRuas', $roadInvetories->noRuas),
                'inventarisJalans' => $roadInvetories
            ]);
        } else {
            return view('401');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'road_inventory_id' => 'required|integer',
            'dariSta' => 'required|regex:/^\d+\+\d{3}$/',
            'tipeJalan' => 'required|integer|in:0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15',
            'keSta' => 'required|regex:/^\d+\+\d{3}$/',
            'lapisPermukaanTahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'lapisPermukaanJenis' => 'required|integer|between:0,15',
            'lapisPermukaanLebar' => 'required|numeric|min:0|max:100',
            'median' => 'required|integer|in:0,1,2',
            'bahuKiriTahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'bahuKananTahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'bahuKiriLebar' => 'required|numeric|min:0|max:100',
            'bahuKananLebar' => 'required|numeric|min:0|max:100',
            'bahuKiriJenis' => 'required|integer|between:0,15',
            'bahuKananJenis' => 'required|integer|between:0,15',
            'saluranKiriLebar' => 'required|numeric|min:0|max:100',
            'saluranKananLebar' => 'required|numeric|min:0|max:100',
            'saluranKiriDalam' => 'required|numeric|min:0|max:100',
            'saluranKananDalam' => 'required|numeric|min:0|max:100',
            'saluranKiriJenis' => 'required|integer|in:0,1,2',
            'saluranKananJenis' => 'required|integer|in:0,1,2',
            'tataKiri' => 'required|integer|in:0,1,2',
            'tataKanan' => 'required|integer|in:0,1,2',
            'alinyemenVertical' => 'required|integer|in:0,1,2',
            'alinyemenHorizontal' => 'required|integer|in:0,1,2',
            'terrainKiri' => 'required|string|in:T1,T2,T3,L1,L2,L3',
            'terrainKanan' => 'required|string|in:T1,T2,T3,L1,L2,L3',
        ], [
            'road_inventory_id.required' => 'ID inventaris jalan wajib diisi.',
            'road_inventory_id.integer' => 'ID inventaris jalan harus berupa angka.',
            'tipeJalan.required' => 'Tipe jalan wajib diisi.',
            'tipeJalan.integer' => 'Tipe jalan harus berupa angka.',
            'dariSta.required' => 'Dari STA wajib diisi.',
            'dariSta.regex' => 'Format Dari STA tidak sesuai. Gunakan format 0+000.',
            'keSta.required' => 'Ke STA wajib diisi.',
            'keSta.regex' => 'Format Ke STA tidak sesuai. Gunakan format 0+000.',
            'lapisPermukaanTahun.required' => 'Tahun lapis permukaan wajib diisi.',
            'lapisPermukaanTahun.digits' => 'Tahun lapis permukaan harus berupa 4 digit.',
            'lapisPermukaanTahun.integer' => 'Tahun lapis permukaan harus berupa angka.',
            'lapisPermukaanTahun.min' => 'Tahun lapis permukaan tidak valid.',
            'lapisPermukaanTahun.max' => 'Tahun lapis permukaan tidak boleh lebih dari tahun saat ini.',
            'lapisPermukaanJenis.required' => 'Jenis lapis permukaan wajib diisi.',
            'lapisPermukaanJenis.integer' => 'Jenis lapis permukaan harus berupa angka.',
            'lapisPermukaanJenis.between' => 'Jenis lapis permukaan harus antara 0 hingga 15.',
            'lapisPermukaanLebar.required' => 'Lebar lapis permukaan wajib diisi.',
            'lapisPermukaanLebar.numeric' => 'Lebar lapis permukaan harus berupa angka.',
            'lapisPermukaanLebar.min' => 'Lebar lapis permukaan tidak boleh kurang dari 0.',
            'lapisPermukaanLebar.max' => 'Lebar lapis permukaan tidak boleh lebih dari 100.',
            'median.required' => 'Median wajib diisi.',
            'median.integer' => 'Median harus berupa angka.',
            'median.in' => 'Median harus berupa salah satu dari nilai 0, 1, atau 2.',
            'bahuKiriTahun.required' => 'Tahun bahu kiri wajib diisi.',
            'bahuKiriTahun.digits' => 'Tahun bahu kiri harus berupa 4 digit.',
            'bahuKiriTahun.integer' => 'Tahun bahu kiri harus berupa angka.',
            'bahuKiriTahun.min' => 'Tahun bahu kiri tidak valid.',
            'bahuKiriTahun.max' => 'Tahun bahu kiri tidak boleh lebih dari tahun saat ini.',
            'bahuKananTahun.required' => 'Tahun bahu kanan wajib diisi.',
            'bahuKananTahun.digits' => 'Tahun bahu kanan harus berupa 4 digit.',
            'bahuKananTahun.integer' => 'Tahun bahu kanan harus berupa angka.',
            'bahuKananTahun.min' => 'Tahun bahu kanan tidak valid.',
            'bahuKananTahun.max' => 'Tahun bahu kanan tidak boleh lebih dari tahun saat ini.',
            'bahuKiriLebar.required' => 'Lebar bahu kiri wajib diisi.',
            'bahuKiriLebar.numeric' => 'Lebar bahu kiri harus berupa angka.',
            'bahuKiriLebar.min' => 'Lebar bahu kiri tidak boleh kurang dari 0.',
            'bahuKiriLebar.max' => 'Lebar bahu kiri tidak boleh lebih dari 100.',
            'bahuKananLebar.required' => 'Lebar bahu kanan wajib diisi.',
            'bahuKananLebar.numeric' => 'Lebar bahu kanan harus berupa angka.',
            'bahuKananLebar.min' => 'Lebar bahu kanan tidak boleh kurang dari 0.',
            'bahuKananLebar.max' => 'Lebar bahu kanan tidak boleh lebih dari 100.',
            'bahuKiriJenis.required' => 'Jenis bahu kiri wajib diisi.',
            'bahuKiriJenis.integer' => 'Jenis bahu kiri harus berupa angka.',
            'bahuKiriJenis.between' => 'Jenis bahu kiri harus antara 0 hingga 15.',
            'bahuKananJenis.required' => 'Jenis bahu kanan wajib diisi.',
            'bahuKananJenis.integer' => 'Jenis bahu kanan harus berupa angka.',
            'bahuKananJenis.between' => 'Jenis bahu kanan harus antara 0 hingga 15.',
            'saluranKiriLebar.required' => 'Lebar saluran kiri wajib diisi.',
            'saluranKiriLebar.numeric' => 'Lebar saluran kiri harus berupa angka.',
            'saluranKiriLebar.min' => 'Lebar saluran kiri tidak boleh kurang dari 0.',
            'saluranKiriLebar.max' => 'Lebar saluran kiri tidak boleh lebih dari 100.',
            'saluranKananLebar.required' => 'Lebar saluran kanan wajib diisi.',
            'saluranKananLebar.numeric' => 'Lebar saluran kanan harus berupa angka.',
            'saluranKananLebar.min' => 'Lebar saluran kanan tidak boleh kurang dari 0.',
            'saluranKananLebar.max' => 'Lebar saluran kanan tidak boleh lebih dari 100.',
            'saluranKiriDalam.required' => 'Dalam saluran kiri wajib diisi.',
            'saluranKiriDalam.numeric' => 'Dalam saluran kiri harus berupa angka.',
            'saluranKiriDalam.min' => 'Dalam saluran kiri tidak boleh kurang dari 0.',
            'saluranKiriDalam.max' => 'Dalam saluran kiri tidak boleh lebih dari 100.',
            'saluranKananDalam.required' => 'Dalam saluran kanan wajib diisi.',
            'saluranKananDalam.numeric' => 'Dalam saluran kanan harus berupa angka.',
            'saluranKananDalam.min' => 'Dalam saluran kanan tidak boleh kurang dari 0.',
            'saluranKananDalam.max' => 'Dalam saluran kanan tidak boleh lebih dari 100.',
            'saluranKiriJenis.required' => 'Jenis saluran kiri wajib diisi.',
            'saluranKiriJenis.integer' => 'Jenis saluran kiri harus berupa angka.',
            'saluranKiriJenis.in' => 'Jenis saluran kiri harus salah satu dari nilai 0, 1, atau 2.',
            'saluranKananJenis.required' => 'Jenis saluran kanan wajib diisi.',
            'saluranKananJenis.integer' => 'Jenis saluran kanan harus berupa angka.',
            'saluranKananJenis.in' => 'Jenis saluran kanan harus salah satu dari nilai 0, 1, atau 2.',
            'tataKiri.required' => 'Tata kiri wajib diisi.',
            'tataKiri.integer' => 'Tata kiri harus berupa angka.',
            'tataKiri.in' => 'Tata kiri harus salah satu dari nilai 0, 1, atau 2.',
            'tataKanan.required' => 'Tata kanan wajib diisi.',
            'tataKanan.integer' => 'Tata kanan harus berupa angka.',
            'tataKanan.in' => 'Tata kanan harus salah satu dari nilai 0, 1, atau 2.',
            'alinyemenVertical.required' => 'Alinyemen vertikal wajib diisi.',
            'alinyemenVertical.integer' => 'Alinyemen vertikal harus berupa angka.',
            'alinyemenVertical.in' => 'Alinyemen vertikal harus salah satu dari nilai 0, 1, atau 2.',
            'alinyemenHorizontal.required' => 'Lengkung horizontal wajib diisi.',
            'alinyemenHorizontal.integer' => 'Lengkung horizontal harus berupa angka.',
            'alinyemenHorizontal.in' => 'Lengkung horizontal harus salah satu dari nilai 0, 1, atau 2.',
            'terrainKiri.required' => 'Jenis medan kiri wajib diisi.',
            'terrainKiri.string' => 'Jenis medan kiri harus berupa teks.',
            'terrainKiri.in' => 'Jenis medan kiri harus salah satu dari nilai T1, T2, T3, L1, L2, atau L3.',
            'terrainKanan.required' => 'Jenis medan kanan wajib diisi.',
            'terrainKanan.string' => 'Jenis medan kanan harus berupa teks.',
            'terrainKanan.in' => 'Jenis medan kanan harus salah satu dari nilai T1, T2, T3, L1, L2, atau L3.',
        ]);
        RoadInventoryData::create($validatedData);
        return redirect()->route('dataInventarisJalan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoadInventoryData $roadInventoryData) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoadInventoryData $roadInventoryData)
    {
        return view('pages.dataInventarisJalan.edit', ['title' => 'Edit Data Inventaris Jaringan Jalan', 'data' => $roadInventoryData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoadInventoryData $roadInventoryData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoadInventoryData $roadInventoryData)
    {
        //
    }
}
