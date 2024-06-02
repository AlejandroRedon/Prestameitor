<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Rutas protegidas

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/index', [PrestamoController::class, 'index'])->name('index');
    Route::get('/personas', [PersonaController::class, 'index'])->name('persona.index');
    Route::get('/objetos', [ObjetoController::class, 'index'])->name('objeto.index');
    

       // Prestamo Routes
       Route::get('/prestamos/crear', [PrestamoController::class, 'create'])->name('prestamo.create');
       Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamo.store');
       Route::delete('/prestamos/{prestamo}', [PrestamoController::class, 'destroy'])->name('prestamo.destroy');
       
       // Persona Routes
       Route::get('/personas/crear', [PersonaController::class, 'create'])->name('persona.create');
       Route::post('/personas', [PersonaController::class, 'store'])->name('persona.store');
       Route::get('/personas/editar/{persona}', [PersonaController::class, 'edit'])->name('persona.edit');
       Route::put('/personas/{persona}', [PersonaController::class, 'update'])->name('persona.update');
       Route::delete('/personas/{persona}', [PersonaController::class, 'destroy'])->name('persona.destroy');
   
       // Objeto Routes
       Route::get('/objetos/crear', [ObjetoController::class, 'create'])->name('objeto.create');
       Route::post('/objetos', [ObjetoController::class, 'store'])->name('objeto.store');
       Route::get('/objetos/editar/{objeto}', [ObjetoController::class, 'edit'])->name('objeto.edit');
       Route::put('/objetos/{objeto}', [ObjetoController::class, 'update'])->name('objeto.update');
       Route::delete('/objetos/{objeto}', [ObjetoController::class, 'destroy'])->name('objeto.destroy'); 
   });

require __DIR__.'/auth.php';
