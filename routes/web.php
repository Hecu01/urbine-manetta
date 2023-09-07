<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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
    return view('welcome');
});

// CONTROLLER [MenuController::class]
Route::get('tarea', [MenuController::class, 'tarea'])->name('tarea');

Route::get('calendario', [MenuController::class, 'calendario'])->name('calendario');

Route::get('carreras' , [MenuController::class, 'carreras'])->name('carreras');

Route::get('logistica' , [MenuController::class, 'logistica'])->name('logistica');

Route::get('syh' , [MenuController::class, 'seguridad_higiene'])->name('syh');

Route::get('mantenimiento' , [MenuController::class, 'mantenimiento'])->name('mantenimiento');

Route::get('administracion' , [MenuController::class, 'administracion'])->name('administracion');

Route::get('analista' , [MenuController::class, 'analista_sistemas'])->name('analista');
/*
Route::get('calendario', function () {
    return view('calendario/calendario');
})->name('calendario');


Route::get('carrera', function () {
    return view('carreras/carreras');
})->name('carreras');


Route::get('carrera/logistica', function () {
    return view('carreras/logistica');   
})->name('logistica');

*/