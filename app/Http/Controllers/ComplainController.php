<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    protected $complain;
    public function __construct()
    {
        $this->complain = new Complain();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.aspirasi.index', ['datas' => Complain::all()]);
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
        return redirect(route("complain.create"));
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
