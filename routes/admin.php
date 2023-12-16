<?php

use App\Http\Controllers\AdminController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');
    
    // Articulos deportivos
    Route::get('/admin/articulo-deportivo', [AdminController::class, 'IndexArticuloDeportivo'])->name('nuevo_articulo');
    Route::post('/admin/articulo-deportivo', [AdminController::class, 'agregar_articulo'])->name('añadir_articulo');
    Route::delete('/admin/articulo-deportivo/{id}',[AdminController::class, 'eliminar_articulo'] )->name('eliminar_articulo');

    Route::get('/admin/articulo-deportivo/editar/{id}', [AdminController::class, 'EditArtDeport'])->name('EditarArtDep');
    Route::put('/admin/articulo-deportivo/editar/{id}', [AdminController::class, 'update_EditArtDeport'])->name('UpdateEditarArtDep');


    // Route::get('/editar-registro/{id}', [isftController::class, 'editar'])->name('registro.editar');
    // Route::put('/editar-registro/{id}', [isftController::class, 'update'])->name('registro.actualizar');


    // Ropa deportiva
    Route::get('/admin/ropa-deportiva', [AdminController::class, 'IndexArticuloDeportivo'])->name('nuevo_ropa');
});