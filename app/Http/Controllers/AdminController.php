<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Categoria;
use App\Models\Articulo;
use App\Models\Calzado;

class AdminController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Página Index del admin 
    |------------------------------------------------------------------------
    */
    public function admin(){
        $volver = false; 
        $user = Auth::user();
        $artDeportivos = Articulo::where('id_categoria', '1')->count();
        // Si no es admin, volvé a casa che.
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        $title = "Sportivo - Admin";
        return view('admin.Admin', compact('title', 'artDeportivos','volver'));
    }
    

    /*
    |------------------------------------------------------------------------
    | Controladores de Artículos deportivos
    |------------------------------------------------------------------------
    */
    public function IndexArticuloDeportivo(Request $request){
        // Mostrar btn "Volver"
        $volver = true;
        $artDeportivos = Articulo::where('id_categoria', '1')->count();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images'); // Almacenar la imagen en la carpeta 'images' en el almacenamiento
                $product->images()->create(['path' => $path]);
            }
        }
    
        
        // Importamos modelos 
        $calzados = Calzado::all();
        $categorias = Categoria::all(); 
        $articulos = Articulo::paginate(5);
        // Si no es admin, regrese a home  
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        return view('admin.ArticulosDeportivos', compact('categorias', 'articulos', 'volver', 'calzados', 'artDeportivos'));
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
            'descripcion' => $request->descripcion,
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
            $calzados = $request->input('calzados');      // Acceder al array 
            $stocks = $request->input('stocks');          // Acceder al array 
            $calzadoIds = $request->input('calzado_ids'); // Acceder al array

            // Itera sobre las tallas y sus stocks y guarda la relación con el producto en la tabla pivot
            foreach ($calzados as $indice => $calzado) {
    

                if (isset($stocks[$indice]) > 0) {
                    // Obtén la instancia de talla existente
                    $calzado = Calzado::where('calzado', $calzado)->first(); 

                    $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0; // Verifica si 'stock' está definido

                    // Asegúrate de tener la relación definida en tu modelo Producto y tu modelo Calzado
                    $articuloNuevo->calzados()->attach($calzado->id, ['stocks' => $stock]);
       
                }
            }
        }
        return back()->with('mensaje', 'Artículo agregado con éxito.');
    }

    /*
    |------------------------------------------------------------------------
    | Controladores de Ropa deportiva
    |------------------------------------------------------------------------
    */

    public function IndexRopaDeportiva(){
        return view('admin.RopasDeportivas');
    }
}
