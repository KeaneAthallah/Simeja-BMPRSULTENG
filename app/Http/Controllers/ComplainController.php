<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Models\AsphaltStreet;
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
        // Get all complaints and asphalt street data
        $complaints = Complain::all();
        $asphaltStreets = AsphaltStreet::with('asphaltStreetData')->get(); // Eager load related asphaltStreetData
        $data = [];  // Initialize an empty array to hold the response data

        // Loop through each asphalt street record
        foreach ($asphaltStreets as $asphaltStreet) {
            // Loop through each asphalt street data for the current street
            foreach ($asphaltStreet->asphaltStreetData as $asphaltStreetData) {
                // Decode the coordinates from JSON
                $coordinates = json_decode($asphaltStreetData->koordinat, true);

                // If the coordinates are valid, process them
                if ($coordinates && is_array($coordinates)) {
                    $formattedCoordinates = [];
                    // Loop through each pair of coordinates
                    foreach ($coordinates as $coordinate) {
                        if (is_array($coordinate) && count($coordinate) == 2) {
                            $formattedCoordinates[] = [
                                'longitude' => $coordinate[0],
                                'latitude' => $coordinate[1],
                            ];
                        }
                    }
                    // Add asphalt street data along with coordinates to the response
                    $data[] = [
                        'asphaltStreet_id' => $asphaltStreet->id,
                        'asphaltStreetData_id' => $asphaltStreetData->id, // Include the street data ID
                        'coordinates' => $formattedCoordinates,
                    ];
                }
            }
        }

        // Now include the complaints in the data array
        foreach ($complaints as $complain) {
            $data[] = [
                'complain_id' => $complain->id,
                'description' => $complain->aspirasi,  // Assuming 'aspirasi' is the complaint description
                'lat' => $complain->lat,
                'long' => $complain->long,
                'status' => $complain->status,
                'image' => $complain->image,
            ];
        }

        // Return the data as a JSON response
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complain $complain)
    {
        //
    }
}
