<?php

use App\Models\Complain;
use App\Models\Surveyor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebgisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\HandlingController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\SoilsStreetController;
use App\Http\Controllers\AsphaltStreetController;
use App\Http\Controllers\RoadInventoryController;
use App\Http\Controllers\SoilsStreetDataController;
use App\Http\Controllers\AsphaltStreetDataController;
use App\Http\Controllers\RoadInventoryDataController;

Route::get('/', [ComplainController::class, 'create'])->name('aspirasi.create');
Route::post('/laporan', [ComplainController::class, 'store'])->name('aspirasi.store');


Route::get('/dashboard', function () {
    return view('dashboard', [
        'title' => 'Dashboard',
        'newComplains' => Complain::where('status', '=', 'Pending')->count(),
        'onProgressComplains' => Complain::where('status', '=', 'On Progress')->count(),
        'completedComplains' => Complain::where('status', '=', 'Completed')->count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/dashboard/aspirasi', ComplainController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::get('/dashboard/webgis/json', [ComplainController::class, 'json'])->name('dashboard.webgis.json');
    Route::resource('/dashboard/webgis', WebgisController::class);
    Route::resource('/dashboard/jalanAspal', AsphaltStreetController::class)->parameter('jalanAspal', 'asphaltStreet');
    Route::resource('/dashboard/jalanTanah', SoilsStreetController::class)->parameter('jalanTanah', 'soilsStreet');
    Route::resource('/dashboard/dataJalanAspal', AsphaltStreetDataController::class)->parameter('dataJalanAspal', 'asphaltStreetData');
    Route::resource('/dashboard/dataJalanTanah', SoilsStreetDataController::class)->parameter('dataJalanTanah', 'soilsStreetData');
    Route::resource('/dashboard/inventarisJalan', RoadInventoryController::class)->parameter('inventarisJalan', 'roadInventory');
    Route::resource('/dashboard/dataInventarisJalan', RoadInventoryDataController::class)->parameter('dataInventarisJalan', 'roadInventoryData');
});

require __DIR__ . '/auth.php';
