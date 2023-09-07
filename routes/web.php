<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiendaController;

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

Route::get('/home', [tiendaController::class, 'home'])->name('pagina_inicio');
Route::get('/', [tiendaController::class, 'home']);

Route::middleware(['auth'])->group(function(){
    Route::get('/crud', [tiendaController::class, 'admin'])->name('ir_admin');
});

Auth::routes();