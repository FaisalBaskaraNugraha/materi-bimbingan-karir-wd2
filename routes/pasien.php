<?php

use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Pasien\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::prefix('profile')->group(function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('pasien.profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('pasien.profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('pasien.profile.destroy');
    });

    // Route buat janji periksa
    Route::prefix('janji-periksa')->group(function(){
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
    });
});
