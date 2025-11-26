<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;

// Redirigir al login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard protegido
Route::get('/dashboard', [EmpleadoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas Breeze (login, register, logout, forgot, reset...)
require __DIR__.'/auth.php';

// Rutas protegidas por 'auth'
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Empleados
    Route::resource('empleado', EmpleadoController::class);
});

// Middleware admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
