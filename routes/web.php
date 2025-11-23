<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth;

// Rutas de autenticación
Auth::routes();  // Esto cargará todas las rutas relacionadas con login, registro, etc.

// Ruta principal (redirige al login si no está autenticado)
Route::get('/', function () {
    return view('auth.login');
});

// Ruta del dashboard, protegida por 'auth' y 'verified' si es necesario
Route::get('/dashboard', [EmpleadoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por el middleware 'auth'
Route::middleware('auth')->group(function () {
    // Rutas del perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas relacionadas con empleados (solo una vez, con el middleware 'auth')
    Route::resource('empleado', EmpleadoController::class);  // Controlador de Empleado
});

// Aquí no es necesario colocar Auth::routes() de nuevo
require __DIR__.'/auth.php';  // Incluir las rutas de autenticación adicionales

