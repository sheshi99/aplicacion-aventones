<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Chofer\DashboardController as ChoferDashboard;
use App\Http\Controllers\Pasajero\DashboardController as PasajeroDashboard;
use App\Http\Controllers\Chofer\VehiculoController;
use App\Http\Controllers\Chofer\RideController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RidePublicoController;
use Illuminate\Support\Facades\Route;


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





// ===================================
//          ADMIN
// ===================================
Route::middleware(['auth', 'rol:admin'])->prefix('admin')->group(function () {

    // Dashboard del admin
    Route::get('/', [AdminDashboard::class, 'index'])
        ->name('admin.panel');
    
    // Formulario crear admin
    Route::get('/usuarios/create', [AdminDashboard::class, 'createAdmin'])
    ->name('admin.usuarios.create');

    // Guardar admin nuevo  
    Route::post('/usuarios', [AdminDashboard::class, 'storeAdmin'])
    ->name('admin.usuarios.store');

    // Cambiar estado de usuarios (activar / desactivar)
    Route::patch('/usuarios/{id}/estado', [AdminDashboard::class, 'cambiarEstado'])
        ->name('admin.usuarios.estado');

});


// ===================================
//          PASAJERO
// ===================================
Route::middleware(['auth','rol:pasajero'])->group(function () {

    Route::get('/pasajero', [PasajeroDashboard::class, 'index'])
        ->name('pasajero.panel');

    // Crear reserva
    Route::post('/reservas/{ride}', [ReservaController::class, 'store'])
        ->name('reservas.store');

    // Cancelar reserva
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'cancelar'])
        ->name('reservas.cancelar');

    // Ver reservas del pasajero
    Route::get('/mis-reservas', [ReservaController::class, 'reservasPasajero'])
        ->name('reservas.mias');

    
});


// ===================================
// PÁGINA PÚBLICA
// ===================================
Route::get('/', [RidePublicoController::class, 'index'])
    ->name('rides.publicos');


Route::post('/reservas/intento/{ride}', 
    [\App\Http\Controllers\RidePublicoController::class, 'intento']
)->name('reservas.intento');


// ===================================
//          CHOFER
// ===================================
Route::middleware(['auth', 'rol:chofer'])->group(function () {

    Route::get('/chofer', [ChoferDashboard::class, 'index'])
        ->name('chofer.panel');

    /* ============================
       VEHICULOS
    ============================ */

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
         RIDES
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

    /* ===========================
           RESERVAS 
    =========================== */

    // Ver reservas recibidas para sus rides
    Route::get('/reservas-chofer', [ReservaController::class, 'reservasChofer'])
        ->name('reservas.chofer');

    // Aceptar
    Route::post('/reservas/{reserva}/aceptar', [ReservaController::class, 'aceptar'])
        ->name('reservas.aceptar');

    // Rechazar
    Route::post('/reservas/{reserva}/rechazar', [ReservaController::class, 'rechazar'])
        ->name('reservas.rechazar');
});






