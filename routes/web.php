<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ActivationController; // Importa tu controlador de activación
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta para activar la cuenta mediante token (publica)
Route::get('/activar-cuenta/{token}', [ActivationController::class, 'activarCuenta'])
    ->name('activar.cuenta');

require __DIR__.'/auth.php';
