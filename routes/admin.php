<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ArtDeportController;
use App\Http\Controllers\DescuentoController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    // Inicio admin
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');

    // Clientes
    Route::get('/admin/clientes-activos', [AdminController::class, 'clientes'])->name('clientes');
    
    // Suplementos y Dieta
    Route::get('/admin/suplementos-y-dieta', [AdminController::class, 'suplementos'])->name('suplementos');
    
    // Reposición de mercadería
    Route::get('/admin/reposicion-mercaderia', [AdminController::class, 'mercaderia'])->name('mercaderia');
    
    // Compras pendientes online
    Route::get('/admin/compras-pendientes-online', [AdminController::class, 'compras_online'])->name('compras_online');
    
    // Descuentos
    Route::get('/admin/descuentos', [DescuentoController::class, 'descuentos'])->name('descuentos');
    Route::get('/descuento', [DescuentoController::class, 'buscarArtParaDescuento']);
    Route::get('/admin/descuento/producto/{id}', [DescuentoController::class, 'aplicarDescuento'])->name('aplicarDescuento');
    Route::post('/articulo/descuento/{articuloId}', [DescuentoController::class, 'crear'])->name('crearDescuento');
    Route::put('cambiar-estado-descuento/{id}', [DescuentoController::class, 'cambiarEstadoDescuento'])->name('cambiar.estado.descuento');
    Route::delete('/eliminar/{id}', [DescuentoController::class, 'eliminarDescuento'])->name('eliminar.descuento');



    // Articulos deportivos
    Route::get('/admin/articulo-deportivo', [ArtDeportController::class, 'IndexArticuloDeportivo'])->name('nuevo_articulo');
    Route::post('/admin/articulo-deportivo', [ArtDeportController::class, 'agregar_articulo_deportivo'])->name('añadir_articulo');
    Route::delete('/admin/articulo-deportivo/{id}',[ArtDeportController::class, 'eliminar_articulo'] )->name('eliminar_articulo');
    Route::get('/admin/articulo-deportivo/editar/{id}', [ArtDeportController::class, 'EditArtDeport'])->name('EditarArtDep');
    Route::put('/articulos/{id}', [ArtDeportController::class, 'actualizarArtDeport'])->name('articulos.actualizar');
    Route::get('/accesorio', [ArtDeportController::class, 'busquedaAjaxArtDeportAccesorio']);
    Route::get('/calzado', [ArtDeportController::class, 'busquedaAjaxArtDeportCalzado']);

    // Ropa deportiva
    Route::get('/admin/ropa-deportiva', [AdminController::class, 'IndexRopaDeportiva'])->name('nuevo_ropa');
    Route::post('/admin/ropa-deportiva', [AdminController::class, 'añadir_ropa'])->name('añadir_ropa');
    
    // Admines
    Route::get('/admines', [AdminController::class, 'VerAdmines'])->name('admins');
    Route::put('/habilitar-admin/{usuario}', [AdminController::class, 'HabilitarAdmin'])->name('habilitar_admin');


    // Ventas
    Route::prefix('admin')->group(function(){
        Route::resource('ventas', VentaController::class);
    });
});