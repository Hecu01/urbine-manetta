<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiendaController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [tiendaController::class, 'admin'])->name('ir_admin');
    Route::get('/admin/agregar-articulo-deportivo', [tiendaController::class, 'nuevo_articulo'])->name('nuevo_articulo');
    Route::post('/agregar-articulo-deportivo', [tiendaController::class, 'agregar_articulo'])->name('añadir_articulo');
});