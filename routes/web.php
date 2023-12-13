<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiendaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarritoController;

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
Route::get('/home', [tiendaController::class, 'home'])->name('pagina_inicio');
Route::get('/', [tiendaController::class, 'home'])->name('home');

// Búsquedas
Route::get('/buscar', [BusquedaController::class, 'buscar'])->name('buscar');
Route::get('/detalles/{id}',[BusquedaController::class, 'verDetalles'])->name('detalles');

// Rutas que acceden los admins
Route::group([], __DIR__ . '/admin.php');

// Agregar al carrito
Route::get('/carrito-de-compras', [CarritoController::class, 'mi_carrito'])->name('carrito.index');
Route::post('/carrito/añadir', [CarritoController::class, 'añadirAlCarrito'])->name('carrito.añadir');



// IGNORAR
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

















// Route::group(['middleware' => 'administrator'], function () {
//     Rutas que solo los administradores pueden acceder. (incompleto)
// });
Auth::routes();