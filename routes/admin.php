<?php

use App\Http\Controllers\AdminController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    // Inicio admin
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');

    // Clientes
    Route::get('/admin/clientes-activos', [AdminController::class, 'clientes'])->name('clientes');
    
    // Ventas
    Route::get('/admin/ventas-realizadas', [AdminController::class, 'ventas'])->name('ventas');
    
    // Suplementos y Dieta
    Route::get('/admin/suplementos-y-dieta', [AdminController::class, 'suplementos'])->name('suplementos');
    
    // Reposición de mercadería
    Route::get('/admin/reposicion-mercaderia', [AdminController::class, 'mercaderia'])->name('mercaderia');
    
    // Compras pendientes online
    Route::get('/admin/compras-pendientes-online', [AdminController::class, 'compras_online'])->name('compras_online');
    
    // Descuentos
    Route::get('/admin/descuentos', [AdminController::class, 'descuentos'])->name('descuentos');
    
    // Articulos deportivos
    Route::get('/admin/articulo-deportivo', [AdminController::class, 'IndexArticuloDeportivo'])->name('nuevo_articulo');
    Route::post('/admin/articulo-deportivo', [AdminController::class, 'agregar_articulo_deportivo'])->name('añadir_articulo');
    Route::delete('/admin/articulo-deportivo/{id}',[AdminController::class, 'eliminar_articulo'] )->name('eliminar_articulo');
    Route::get('/admin/articulo-deportivo/editar/{id}', [AdminController::class, 'EditArtDeport'])->name('EditarArtDep');
    Route::put('/articulos/{id}', [AdminController::class, 'actualizarArtDeport'])->name('articulos.actualizar');

    Route::get('/accesorio', [AdminController::class, 'busquedaAjaxArtDeportAccesorio']);
    Route::get('/calzado', [AdminController::class, 'busquedaAjaxArtDeportCalzado']);

    // Ropa deportiva
    Route::get('/admin/ropa-deportiva', [AdminController::class, 'IndexRopaDeportiva'])->name('nuevo_ropa');
    Route::post('/admin/ropa-deportiva', [AdminController::class, 'añadir_ropa'])->name('añadir_ropa');
    
    // Admines
    Route::get('/admines', [AdminController::class, 'VerAdmines'])->name('admins');
    Route::put('/habilitar-admin/{usuario}', [AdminController::class, 'HabilitarAdmin'])->name('habilitar_admin');
});