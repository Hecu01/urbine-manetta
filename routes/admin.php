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
use App\Http\Controllers\Admin\SuplemDietaController;

// Rutas que acceden los admins
Route::middleware(['auth'])->group(function(){
    
    // Inicio admin
    Route::get('/admin', [AdminController::class, 'admin'])->name('ir_admin');

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

        // Suplmentos y dieta
        Route::resource('suplementos-dieta', SuplemDietaController::class);
        
        // Clientes activos
        Route::resource('clientes-activos', ClientesActivosController::class);

        /* Clientes activos gropo de páginas */
        Route::controller(ClientesActivosController::class)->group(function(){

            // Clientes activos 
            Route::get('/tabla-clientes-activos', 'tablaClientesActivos')->name('tablaClientesActivos');

            
            // Páginas de carga de saldo
            Route::get('/cargar-saldo', 'pagCargarSaldo')->name('RouteCargarSaldo');
            Route::get('/cargar-saldo/{id}', 'asigarSaldoUsuario')->name('asigarSaldoUsuario');
            Route::put('/carga-virtual-saldo/{id}', 'carga_virtual_saldo')->name('carga_virtual_saldo');
            
            
            // Páginas del descuento especial
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
        Route::controller(ReponerMercaderiaController::class)->group(function(){

            // Articulos deportivos
            Route::get('/reposicion/articulos-deportivos', 'indexSoliciarArtDeport')->name('solicitar-art-deport-index');
            Route::get('/reposicion/tabla/articulos-deportivos', 'tablaArticulosDeportivos')->name('tablaArticulosDeportivos');
            
            // Ropas deportivas
            Route::get('/reposicion/ropa-deportivas', 'indexSoliciarRopDeport')->name('solicitar-rop-deport-index');
            Route::get('/reposicion/tabla/ropas-deportivas', 'tablaRopasDeportivas')->name('tablaRopasDeportivas');
            
            // Suplementos y dieta
            Route::get('/reposicion/suplementos-y-dieta', 'indexSoliciarSupDieta')->name(' ');
            Route::get('/reposicion/tabla/suplementos-dieta', 'tablaSupDieta')->name('tablaSupDieta');


            // Id del producto a reponer
            Route::get('/reponer-mercaderia/{id}', 'solicitarMercaderia')->name('solicitarMercaderia');
            
            // Peticion al servidor
            Route::post('/reponer-mercaderia/{id}', 'enviarSolicitudReponerMercaderia')->name('reponer_mercaderia');
            
            // Aceptar pedido
            Route::put('/articulos/aceptar/{id}', 'aceptarPedido')->name('articulos.aceptar');
            Route::post('/articulos/rechazar/{id}', 'rechazarPedido')->name('articulos.rechazar');
            Route::delete('/articulos/eliminar/{id}', 'eliminarPedido')->name('articulos.eliminar');
        });
        
        // Los admines
        Route::resource('AdminesActivos', AdminesActivosController::class);
        Route::put('/habilitar-admin/{usuario}', [AdminesActivosController::class, 'HabilitarAdmin'])->name('habilitar_admin');
    });


});
