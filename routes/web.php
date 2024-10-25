<?php

use App\Http\Controllers\HandlingController;
use App\Models\Complain;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebgisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SurveyDataController;

Route::get('/', [ComplainController::class, 'create'])->name('aspirasi.create');
Route::post('/laporan', [ComplainController::class, 'store'])->name('aspirasi.store');


Route::get('/dashboard', function () {
    return view('dashboard', [
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
    Route::resource('/dashboard/survey', SurveyDataController::class);
    Route::resource('/dashboard/webgis', WebgisController::class);
    Route::resource('/dasboard/handling', HandlingController::class);
    Route::resource('/dashboard/laporan', ReportController::class);
});

require __DIR__ . '/auth.php';
