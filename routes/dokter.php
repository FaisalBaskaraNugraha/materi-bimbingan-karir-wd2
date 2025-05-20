<?php

use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::prefix('profile')->group(function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('dokter.profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('dokter.profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('dokter.profile.destroy');
    });

    Route::prefix('jadwal-periksa')->group(function(){
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });

    Route::prefix('memeriksa')->group(function(){
        Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
    });

    Route::prefix('obat')->group(function(){
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });
});
