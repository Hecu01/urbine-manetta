<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiendaController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    Route::get('/administrador', [tiendaController::class, 'admin'])->name('ir_admin');
    Route::get('/agregar-articulo', [tiendaController::class, 'nuevo_articulo'])->name('nuevo_articulo');
    Route::post('/agregar-articulo', [tiendaController::class, 'agregar_articulo'])->name('añadir_articulo');
});