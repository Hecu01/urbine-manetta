<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Categoria;
use App\Models\Articulo;
use App\Models\Calzado;

class AdminController extends Controller
{
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
        // mostrar btn "Volver"
        $volver = true;
        
        // Importamos modelos 
        $calzados = Calzado::all();
        $categorias = Categoria::all(); 
        $articulos = Articulo::all();
        
        // Si es admin, regrese a home  
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        return view('admin.nuevo_articulo_deportivo', compact('categorias', 'articulos', 'volver', 'calzados'));
    }
    public function eliminar_articulo($id){

        $articulos = Articulo::find($id); 
        $articulos->delete();
        return redirect()->back()->with('success', 'Tupla eliminada exitosamente.');

    }

    public function agregar_articulo(Request $request){

    

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $carpetaDestino = storage_path('productos');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($carpetaDestino, $file->getClientOriginalName());
        }
        $articuloNuevo = Articulo::create([
            'nombre' =>  $request->nombre_producto,
            'genero' => $request->genero,
            'precio' => $request->precio,            
            'stock' => $request->stock,
            'marca' => $request->marca,
            'stock' => $request->stock,
            'color' => $request->color,
            'id_categoria' => $request->categoria,
            'dirigido_a' => $request->publico_dirigido,
            'tipo_producto' => $request->tipoProducto,
            'foto' => $filename
        ]);

        // Comienzo de la lógica de unión de muchos a muchos,
        // si es que es un calzado
        $tipoProducto = $request->input('tipoProducto');




        if($tipoProducto == "calzado"){
            // Obtén los datos del array de tallas y el array de stock
            $calzados = $request->input('calzados'); // Acceder al array 
            $stocks = $request->input('stocks'); // Acceder al array 

            // Itera sobre las tallas y sus stocks y guarda la relación con el producto en la tabla pivot
            foreach ($calzados as $indice => $calzado) {
                // Obtén la instancia de talla existente
                $calzado = Calzado::where('calzado', $calzado)->first(); 

                if (!is_null($calzado)) {
                    $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0; // Verifica si 'stock' está definido

                    // Asegúrate de tener la relación definida en tu modelo Producto y tu modelo Calzado
                    $articuloNuevo->calzados()->attach($calzado, ['stocks' => $stock]);
                }            
            }


        }



        

        return back()->with('mensaje', 'Artículo agregado con éxito.');
    }
}
