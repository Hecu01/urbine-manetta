<?php

use App\Http\Controllers\AdminController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');
    
    // articulos deportivos
    Route::get('/admin/agregar-articulo-deportivo', [AdminController::class, 'nuevo_articulo'])->name('nuevo_articulo');
    Route::get('/admin/agregar-articulo-deportivo', [AdminController::class, 'nuevo_articulo'])->name('nuevo_articulo');
    Route::post('/admin/agregar-articulo-deportivo', [AdminController::class, 'agregar_articulo'])->name('añadir_articulo');
    Route::delete('/admin/agregar-articulo-deportivo/{id}',[AdminController::class, 'eliminar_articulo'] )->name('eliminar_articulo');
});