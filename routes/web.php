<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Trabajo final PP3 
|--------------------------------------------------------------------------
|
| Programadores: Luciana Manetta, Urbine Valentin
| Curso: 3° Análisis de Sistemas
|
*/
// página de inicio
// Route::group()
Route::get('/', [TiendaController::class, 'home'])->name('home');
Route::get('/home', [TiendaController::class, 'home'])->name('pagina_inicio');
Route::get('/pagos', [TiendaController::class, 'pago'])->name('pago');

// Búsquedas
Route::get('/buscar', [BusquedaController::class, 'buscar'])->name('buscar');
Route::get('/detalles/{id}',[BusquedaController::class, 'verDetalles'])->name('detalles');

// Rutas de usuarios
Route::middleware(['auth'])->group(function(){
    // Agregar domicilio
    Route::get('/domicilios', [UsuarioController::class, 'domicilio'])->name('domicilio');
    Route::post('/domicilios', [UsuarioController::class, 'agregar_domicilio'])->name('agregar_direccion');
    
    // Perfil
    Route::get('/mi-perfil', [TiendaController::class, 'mi_perfil'])->name('mi_perfil');

    // Agregar al carrito
    Route::get('/carrito-de-compras', [CarritoController::class, 'mi_carrito'])->name('carrito.index');
    Route::post('/carrito/añadir', [CarritoController::class, 'añadirAlCarrito'])->name('carrito.añadir');
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
Auth::routes();