<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ActivationController; // Importa tu controlador de activación
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Chofer\DashboardController as ChoferDashboard;
use App\Http\Controllers\Pasajero\DashboardController as PasajeroDashboard;
use App\Http\Controllers\Chofer\VehiculoController;
use App\Http\Controllers\Chofer\RideController;
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
});

// Ruta para activar la cuenta mediante token (publica)
Route::get('/activar-cuenta/{token}', [ActivationController::class, 'activarCuenta'])
    ->name('activar.cuenta');

require __DIR__.'/auth.php';


// RUTAS EXCLUSIVAS PARA ADMIN
Route::middleware(['auth', 'rol:admin'])->prefix('admin')->group(function () {

    // Dashboard del administrador
    Route::get('/', [AdminDashboard::class, 'index'])
        ->name('admin.panel');

    // Cambiar estado de usuarios (activar / desactivar)
    Route::patch('/usuarios/{id}/estado', [AdminDashboard::class, 'cambiarEstado'])
        ->name('admin.usuarios.estado');

});


Route::middleware(['auth','rol:pasajero'])->get('/pasajero', [PasajeroDashboard::class, 'index'])->name('pasajero.panel');

// Rutas exclusivas para CHOFER
Route::middleware(['auth', 'rol:chofer'])->group(function () {

    Route::get('/chofer', [ChoferDashboard::class, 'index'])
        ->name('chofer.panel');

    // CRUD Vehículos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])
        ->name('vehiculos.index');

    Route::get('/vehiculos/create', [VehiculoController::class, 'create'])
        ->name('vehiculos.create');

    Route::post('/vehiculos', [VehiculoController::class, 'store'])
        ->name('vehiculos.store');

    Route::get('/vehiculos/{vehiculo}/edit', [VehiculoController::class, 'edit'])
        ->name('vehiculos.edit');

    Route::put('/vehiculos/{vehiculo}', [VehiculoController::class, 'update'])
        ->name('vehiculos.update');

    Route::delete('/vehiculos/{vehiculo}', [VehiculoController::class, 'destroy'])
        ->name('vehiculos.destroy');

    /* ============================
       CRUD RIDES
    ============================ */
    Route::get('/rides', [RideController::class, 'index'])
        ->name('rides.index');

    Route::get('/rides/create', [RideController::class, 'create'])
        ->name('rides.create');

    Route::post('/rides', [RideController::class, 'store'])
        ->name('rides.store');

    Route::get('/rides/{ride}/edit', [RideController::class, 'edit'])
        ->name('rides.edit');

    Route::put('/rides/{ride}', [RideController::class, 'update'])
        ->name('rides.update');

    Route::delete('/rides/{ride}', [RideController::class, 'destroy'])
        ->name('rides.destroy');   
});



/*Route::get('/hora', function () {
    return now()->format('Y-m-d H:i:s');
});

Route::get('/phptime', function () {
    return date('Y-m-d H:i:s');
});*/



