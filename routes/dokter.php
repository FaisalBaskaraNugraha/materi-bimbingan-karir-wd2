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
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal-periksa.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });

    Route::prefix('obat')->group(function(){
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });
});
