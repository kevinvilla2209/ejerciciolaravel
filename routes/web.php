<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/empleados', function () {
//    return view('empleados.index');
// });

// Route::get('empleado/create',[EmpleadoController::class, 'create']);

route::resource('empleado', EmpleadoController::class);