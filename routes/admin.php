<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\ArtDeportController;
use App\Http\Controllers\Admin\DescuentoController;
use App\Http\Controllers\Admin\AdminesActivosController;

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
    Route::controller(DescuentoController::class)->group(function(){
        Route::get('/admin/descuentos','index')->name('descuentos');
        Route::get('/descuento', 'buscarArtParaDescuento'); // AJAX - Busqueda
        Route::get('/admin/descuento/producto/{id}', 'aplicarDescuento')->name('aplicarDescuento');
        Route::post('/articulo/descuento/{articuloId}', 'crear')->name('crearDescuento');
        Route::put('cambiar-estado-descuento/{id}','cambiarEstadoDescuento')->name('cambiar.estado.descuento');
        Route::delete('/eliminar/{id}','eliminarDescuento')->name('eliminar.descuento');
    });

    // Articulos deportivos
    Route::controller(ArtDeportController::class)->group(function(){

        // Route::post('/admin/articulo-deportivo', 'agregar_articulo_deportivo')->name('añadir_articulo');
        // Route::get('/admin/articulo-deportivo/editar/{id}', 'EditArtDeport')->name('EditarArtDep');
        // Route::put('/articulos/{id}', 'actualizarArtDeport')->name('articulos.actualizar');
        // Route::get('/accesorio', 'busquedaAjaxArtDeportAccesorio');
        // Route::get('/calzado', 'busquedaAjaxArtDeportCalzado');
    });

    // Ropa deportiva
    Route::get('/admin/ropa-deportiva', [AdminController::class, 'IndexRopaDeportiva'])->name('nuevo_ropa');
    Route::post('/admin/ropa-deportiva', [AdminController::class, 'añadir_ropa'])->name('añadir_ropa');
    
    // Admines
    Route::get('/admines', [AdminController::class, 'VerAdmines'])->name('admins');

    Route::prefix('admin')->group(function(){
        // Articulos Deportivos
        Route::resource('articulos-deportivos', ArtDeportController::class);
        Route::delete('/articulo-deportivo/{id}', [ArtDeportController::class, 'destroy']);

        
        // Ventas
        Route::resource('ventas', VentaController::class);
        
        // Los admines
        Route::resource('AdminesActivos', AdminesActivosController::class);
        Route::put('/habilitar-admin/{usuario}', [AdminesActivosController::class, 'HabilitarAdmin'])->name('habilitar_admin');
    });
});
