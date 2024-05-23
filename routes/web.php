<?php

use Illuminate\Support\Facades\Route;
use App\Models\Prestamo;
use App\Models\Persona;
use App\Models\Objeto;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\PrestamoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $prestamos = Prestamo::latest()->paginate(10);

    return view ('index', ['prestamos' => $prestamos]);
});

Route::resource('persona', PersonaController::class);
Route::resource('objeto', ObjetoController::class);
Route::resource('prestamo', PrestamoController::class);

