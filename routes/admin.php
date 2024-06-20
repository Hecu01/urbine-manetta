<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\RopaDepController;
use App\Http\Controllers\Admin\ArtDeportController;
use App\Http\Controllers\Admin\DescuentoController;
use App\Http\Controllers\Admin\AdminesActivosController;
use App\Http\Controllers\Admin\ClientesActivosController;
use App\Http\Controllers\Admin\ReponerMercaderiaController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    // Inicio admin
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');



    // Suplementos y Dieta
    Route::get('/admin/suplementos-y-dieta', [AdminController::class, 'suplementos'])->name('suplementos');
    
    
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

        // Route::get('/accesorio', 'busquedaAjaxArtDeportAccesorio');
        // Route::get('/calzado', 'busquedaAjaxArtDeportCalzado');
    });
    
    // Admines
    Route::get('/admines', [AdminController::class, 'VerAdmines'])->name('admins');
    
    Route::prefix('admin')->group(function(){
        // Clientes activos
        Route::resource('clientes-activos', ClientesActivosController::class);
        Route::controller(ClientesActivosController::class)->group(function(){
            Route::get('/solicitudes-descuentos-especiales', 'pagDescuentosEspeciales')->name('RouteDescuentosEspeciales');
            Route::get('/porcentaje-descuentos-especiales', 'porcentajeDescuentos')->name('RoutePorcentajeDescEspeciales');

            Route::get('/pagina-asignar-descuento/{id}', 'pagAsignarDescuento')->name('pagAsignarDescuento');


            Route::put('/aceptar-descuento-especial/{id}', 'aceptarDescuento')->name('AceptarDescuentoEspecial');
            Route::put('/rechazar-descuento-especial/{id}', 'rechazarDescuento')->name('RechazarDescuentoEspecial');

            Route::put('/hab-inhab-descuento-especial/{id}', 'habilitarInhabilitarDescuento')->name('HabilitarInhabilitarDescuento');

            Route::put('/asignar-porcentaje-descuento/{id}', 'adjuntarDescuento')->name('adjuntarDescuento');
        });


        // Ropa deportiva

        Route::resource('ropa-deportiva', RopaDepController::class);

        Route::controller(RopaDepController::class)->group(function() {
            Route::get('/ropa-deportiva-tabla','tabla')->name('ropa-deportiva.tabla');
            Route::get('/ropa-deportiva-tablaTalles','tablaTalles')->name('ropa-deportiva.tabla-talles');
            Route::get('/ropa-deportiva-formulario','formulario')->name('ropa-deportiva.formulario');
        });

        // Articulos Deportivos
        Route::resource('articulos-deportivos', ArtDeportController::class);
        Route::delete('/articulo-deportivo/{id}', [ArtDeportController::class, 'destroy']);
        
        // Ventas
        Route::resource('ventas', VentaController::class);

        // Reposicion de mercadería -- resource
        Route::resource('reposicion-mercaderia', ReponerMercaderiaController::class);
        
        // Los admines
        Route::resource('AdminesActivos', AdminesActivosController::class);
        Route::put('/habilitar-admin/{usuario}', [AdminesActivosController::class, 'HabilitarAdmin'])->name('habilitar_admin');
    });

    // Reposicion de mercaderia
    Route::controller(ReponerMercaderiaController::class)->group(function(){
        Route::get('/admin/reponer-mercaderia-articulos', 'indexSoliciarArtDeport')->name('solicitar-art-deport-index');
    });
});
