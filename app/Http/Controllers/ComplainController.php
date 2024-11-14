<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\RoadInventory;
use App\Models\SoilsStreetData;
use App\Models\AsphaltStreetData;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.complain.index', ['datas' => Complain::all(), 'title' => 'Aspirasi']);
    }

    public function json()
    {
        $roadInventories = RoadInventory::with('dataRoadInventory.asphaltStreet', 'dataRoadInventory.soilsStreet')->get();
        $complaints = Complain::all();
        $data = [];
        foreach ($roadInventories as $roadInventory) {
            foreach ($roadInventory->dataRoadInventory as $roadInventoryData) {
                $streetData = $roadInventoryData->jenisPerkerasan == 1 ? $roadInventoryData->asphaltStreet : $roadInventoryData->soilsStreet;
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
                        'street_id' => $street->id,
                        'no_ruas' => $roadInventory->noRuas,
                        'kondisiJalan' => $street->kondisiJalan,
                        'penanganan' => $street->penanganan,
                        'coordinates' => $formattedCoordinates,
                        'nama_ruas' => $roadInventory->namaRuas,
                        'jenis_perkerasan' => $roadInventoryData->jenisPerkerasan,
                        'dari_patok' => $street->dariPatok,
                        'ke_patok' => $street->kePatok,
                        // Add other fields as needed
                    ];
                }
            }
        }
        foreach ($complaints as $complain) {
            $data[] = [
                'complain_id' => $complain->id,
                'description' => $complain->aspirasi,
                'lat' => $complain->lat,
                'long' => $complain->long,
                'status' => $complain->status,
                'image' => $complain->image,
            ];
        }
        return response()->json($data);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("welcome");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "nik" => "required|numeric",
            "phone" => "required|numeric|min:11",
            "lat" => "required",
            "long" => "required",
            "address" => "required|string|max:255",
            "aspirasi" => "required|string",
            "image" => "required|max:2048",
        ]);
        if ($request->hasFile('image')) {
            // Process the file
            $data['image'] = $request->file('image')->store('complain_images');
        } else {
            dd('No file uploaded'); // Or log this message
        }
        Complain::create($data);
        return redirect(route("aspirasi.create"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Complain $complain)
    {
        return 123123;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complain $complain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complain $complain)
    {
        if (auth()->user()->role == "admin") {
            $validatedData = $request->validate([
                'status' => 'required|string',
            ]);
            $complain->update($validatedData);
            return redirect()->route('aspirasi.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complain $complain)
    {
        //
    }
}
