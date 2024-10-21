<?php

use App\Models\Complain;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplainController;

Route::get('/', [ComplainController::class, 'create'])->name('complain.create');


Route::get('/dashboard', function () {
    return view('dashboard',);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/aspirasi', [ComplainController::class, 'index'])->name('complain.index');
    Route::post('/', [ComplainController::class, 'store'])->name('complain.store');
});

require __DIR__ . '/auth.php';
