<?php

use App\Models\Complain;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WebgisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\HandlingController;
use App\Http\Controllers\SoilsStreetController;
use App\Http\Controllers\AsphaltStreetController;
use App\Http\Controllers\RoadInventoryController;

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
    Route::resource('/dasboard/penanganan', HandlingController::class)->parameter('penanganan', 'handling');
    Route::resource('/dashboard/laporan', ReportController::class)->parameter('laporan', 'report');
    Route::resource('/dashboard/jalanAspal', AsphaltStreetController::class)->parameter('jalanAspal', 'asphaltStreet');
    Route::resource('/dashboard/jalanTanah', SoilsStreetController::class)->parameter('jalanTanah', 'soilsStreet');
    Route::resource('/dashboard/inventarisJalan', RoadInventoryController::class)->parameter('inventarisJalan', 'roadInventory');
});

require __DIR__ . '/auth.php';
