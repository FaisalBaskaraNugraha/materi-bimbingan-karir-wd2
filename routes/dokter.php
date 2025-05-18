<?php

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
});
