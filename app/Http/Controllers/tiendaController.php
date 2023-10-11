<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Categoria;
use App\Models\Articulo;

class tiendaController extends Controller
{
    // Página index
    public function home(){
        $title = "Sportivo - Inicio";
        return view('index', compact('title'));
    }
    public function hombres(){
        $title = "Sportivo - hombres";
        $articulo = Articulo::where('genero', 'M')->get();
        return view('hombres', compact('title', 'articulo'));
    }





















    public function admin(){
        $volver = false; 
        $user = Auth::user();
        $artDeportivos = Articulo::where('id_categoria', '1')->count();
        // Si no es admin, volvé a casa che.
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        $title = "Sportivo - Admin";
        return view('admin.admin', compact('title', 'artDeportivos','volver'));
    }
    
    public function nuevo_articulo(){
        $volver = true; 

        $categorias = Categoria::all(); 
        $articulos = Articulo::all(); 
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        return view('admin.nuevo_articulo', compact('categorias', 'articulos', 'volver'));
    }

    public function agregar_articulo(Request $request){
        $articuloNuevo = new Articulo;
        $articuloNuevo->nombre = $request->nombre_producto;
        $articuloNuevo->genero = $request->genero;
        $articuloNuevo->precio = $request->precio;
        $articuloNuevo->marca = $request->marca;
        $articuloNuevo->color = $request->color;
        $articuloNuevo->stock = $request->stock;
        $articuloNuevo->id_categoria = $request->categoria;
        $nombreArticulo = $request->nombre_producto;

        if($request->hasFile('foto')){
			$file = $request->file('foto');
			$carpetaDestino = storage_path('productos');
			$filename = $file->getClientOriginalName();
			$uploadSuccess = $request->file('foto')->move($carpetaDestino, $filename);
			$articuloNuevo->foto = $filename;
		}

        $articuloNuevo->save();
        return back()->with('mensaje', 'Artículo agregado con éxito.');
    }
}
