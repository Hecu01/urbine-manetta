<?php

use App\Http\Controllers\AdminController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');
    
    // Articulos deportivos
    Route::get('/admin/articulo-deportivo', [AdminController::class, 'IndexArticuloDeportivo'])->name('nuevo_articulo');
    Route::post('/admin/articulo-deportivo', [AdminController::class, 'agregar_articulo_deportivo'])->name('añadir_articulo');
    Route::delete('/admin/articulo-deportivo/{id}',[AdminController::class, 'eliminar_articulo'] )->name('eliminar_articulo');
    Route::get('/admin/articulo-deportivo/editar/{id}', [AdminController::class, 'EditArtDeport'])->name('EditarArtDep');

    Route::put('/articulos/{id}', [AdminController::class, 'actualizarArtDeport'])->name('articulos.actualizar');

    // Ropa deportiva
    Route::get('/admin/ropa-deportiva', [AdminController::class, 'IndexRopaDeportiva'])->name('nuevo_ropa');
    Route::post('/admin/ropa-deportiva', [AdminController::class, 'añadir_ropa'])->name('añadir_ropa');
    
    // Admines
    Route::get('/admines', [AdminController::class, 'VerAdmines'])->name('admins');
    Route::put('/habilitar-admin/{usuario}', [AdminController::class, 'HabilitarAdmin'])->name('habilitar_admin');
});