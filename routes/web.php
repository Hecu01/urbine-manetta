<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiendaController;

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
Route::get('/', [tiendaController::class, 'home']);

// Rutas que acceden los registrados
Route::middleware(['auth'])->group(function(){
    Route::get('/administrador', [tiendaController::class, 'admin'])->name('ir_admin');
});
// Route::group(['middleware' => 'administrator'], function () {
//     Rutas que solo los administradores pueden acceder. (incompleto)
// });
Auth::routes();