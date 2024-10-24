<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BusquedaController;

/*
|--------------------------------------------------------------------------
| Trabajo final PP3 
|--------------------------------------------------------------------------
|
| Programadores: Luciana Manetta, Urbine Valentin
| Curso: 3° Análisis de Sistemas
|
*/
// Index
Route::controller(TiendaController::class)->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/home', 'home')->name('pagina_inicio');
    Route::get('/pagos', 'pago')->name('pago');
    Route::post('/process-payment', 'processPayment')->name('processPayment');
    // Route::get('/compras-realizadas', 'comprasRealizadas')->name('comprasRealizadas');
    // Route::get('/compras-realizadas', 'comprasRealizadas')->name('compras.realizadas');

});

// Compras realizadas
Route::get('/compras-realizadas', [TiendaController::class, 'comprasRealizadas'])->name('compras.realizadas');


// Búsquedas
Route::controller(BusquedaController::class)->group(function(){
    Route::get('/buscar', 'buscar')->name('buscar');
    Route::get('/detalles/{id}', 'verDetalles')->name('detalles');
    Route::delete('/buscar/{id}', 'destroy')->name('buscar.destroy');
});

// Rutas de usuarios
Route::middleware(['auth'])->group(function(){
    Route::prefix('usuario')->group(function(){
        Route::controller(UsuarioController::class)->group(function(){
            Route::get('/editar-perfil/{id}', 'descuentoUsuario')->name('descuento-usuario');


            // Descuento especial
            Route::get('/solicito-mi-descuento', 'descuentoUsuario')->name('descuento-usuario');
            Route::post('/solicito-mi-descuento', 'storeDescuentoEspecial')->name('store-descuento-usuario');
    
            // Route::get('/mi-primer-registro', 'bienvenida')->name('usuario-registrado');
    
            // Brindar domicilios
            Route::get('/domicilios',  'domicilio')->name('domicilio');
            Route::post('/domicilios', 'agregar_domicilio')->name('agregar_direccion');
        });
        Route::resource('mi-perfil', UsuarioController::class);
    });

    // Perfil

    // Agregar domicilio
    Route::controller(TiendaController::class)->group(function(){

    });

    // Agregar al carrito
    Route::controller(CarritoController::class)->group(function(){
        Route::get('/carrito-de-compras','mi_carrito')->name('carrito.index');
        Route::post('/carrito/añadir','añadirAlCarrito')->name('carrito.añadir');
        Route::delete('/carrito/remove/{id}', 'remove')->name('cart.remove');
        Route::patch('/carrito/update/{id}',  'update')->name('carrito.update');

    });

    Route::get('/preg-frecuentes', function() {
        return view('users.askedQuestions');
    })->name('preg-frecuentes');
});



// Rutas que acceden los admins
Route::group([], __DIR__ . '/admin.php');




/* |-------------------- IGNORAR --------------------| */
Route::get('producto/{filename}', function ($filename){
    $path = storage_path('productos/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('usuario/{filename}', function ($filename1){
    $path = storage_path('usuarios/' . $filename1);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});


Route::get('certificados/{filename}', function ($filename2){
    $path = storage_path('certificados/' . $filename2);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});


Auth::routes(['verify' => true]);
