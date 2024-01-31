<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /*
    |------------------------------------------------------------------------
    | Página Index del admin 
    |------------------------------------------------------------------------
    */
    public function admin(){
        $user = Auth::user();
        $artDeportivos = Articulo::where('id_categoria', '1')->count();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $adminesActivos = User::where('administrator', true)->count();

        $title = "Sportivo - Admin";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.Admin', compact('title', 'artDeportivos', 'adminesActivos', 'ropaDeportivas'));

    }
    
    /*
    |------------------------------------------------------------------------
    | Página Clientes Activos
    |------------------------------------------------------------------------
    */
    public function clientes(){
        $user = Auth::user();
        $title = "Sportivo - Clientes";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ClientesActivos', compact('title'));
        
    }

    /*
    |------------------------------------------------------------------------
    | Página Ventas realizadas
    |------------------------------------------------------------------------
    */
    public function ventas(){
        $user = Auth::user();
        $title = "Sportivo - Ventas";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.Ventas', compact('title'));
    }

    /*
    |------------------------------------------------------------------------
    | Página Dietas y Suplementos
    |------------------------------------------------------------------------
    */
    public function suplementos(){
        $user = Auth::user();
        $title = "Sportivo - Suplementos";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.SuplementosDieta', compact('title'));
        
    }

    /*
    |------------------------------------------------------------------------
    | Página Mercadería
    |------------------------------------------------------------------------
    */
    public function mercaderia(){
        $user = Auth::user();
        $title = "Sportivo - Mercadería";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ReposicionMercaderia', compact('title'));
        
    }

    /*
    |------------------------------------------------------------------------
    | Página Compras pendientes online
    |------------------------------------------------------------------------
    */
    public function compras_online(){
        $user = Auth::user();
        $title = "Compras pendientes";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ComprasPendientesOnline', compact('title'));
    }

    /*
    |------------------------------------------------------------------------
    | Controladores de Admines
    |------------------------------------------------------------------------
    */
    public function VerAdmines(){ 
        $user = Auth::user();
        $usuarios = User::where('administrator', false)->get();
        $title = "Sportivo - Admines";

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.AdminesActivos', compact('title', 'usuarios'));
    }



    public function HabilitarAdmin(Request $request, $id) {
        $usuario = User::findOrFail($id);
        $cambioValor = 1;
        $usuario->administrator = $cambioValor;
        $usuario->save();
        return redirect()->route('admins');
    }

    
    /*
    |------------------------------------------------------------------------
    | Página Descuentos
    |------------------------------------------------------------------------
    */
    public function descuentos(){
        $user = Auth::user();
        $title = "Sportivo - Descuentos";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.Descuentos', compact('title'));
    }

    /*
    |------------------------------------------------------------------------
    | Controladores de Artículos deportivos
    |------------------------------------------------------------------------
    */
    public function IndexArticuloDeportivo(Request $request){
        // Mostrar btn "Volver"
        $artDeportivos = Articulo::where('id_categoria', '1')->count();
        $title="Sportivo - Articulos Deportivos";

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images'); // Almacenar la imagen en la carpeta 'images' en el almacenamiento
                $product->images()->create(['path' => $path]);
            }
        }
    
        // Importamos modelos 
        $calzados = Calzado::all();
        $categorias = Categoria::all(); 
        $articulos = Articulo::paginate(4);

        // Si no es admin, redirija a la página de inicio
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ArticulosDeportivos', compact('categorias', 'articulos', 'calzados', 'artDeportivos', 'title'));
    }

    public function EditArtDeport($id){
        $articulo = Articulo::findOrFail($id);
        $calzados = Calzado::all();

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.editar.ArtDep_edit', compact('articulo', 'calzados'));

    }

    public function eliminar_articulo($id){
        $articulos = Articulo::find($id); 
        $articulos->delete();
        // Después de agregar el artículo exitosamente
        Session::flash('eliminado', true);
        return redirect()->route('nuevo_articulo');
    }

    public function agregar_articulo_deportivo(Request $request){

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
        // Después de agregar el artículo exitosamente
        Session::flash('mensaje', true);
        return redirect()->route('nuevo_articulo');
    }



    // En tu controlador o donde proceses el formulario
    public function actualizarArtDeport(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        // Sincronizar las relaciones muchos a muchos$stocks = $request->stocks ?? 0; // Si $request->stocks es nulo, asigna 0
        $stocks = $request->stocks ?? 0; // Si $request->stocks es nulo, asigna 0
        $articulo->calzados()->sync($request->calzado_ids, ['stocks' => $stocks]);
        

        // Resto de la lógica para procesar el formulario...

        return redirect()->back()->with('success', 'Calzados actualizados correctamente.');
    }



    /*
    |------------------------------------------------------------------------
    | Controladores de Ropa deportiva
    |------------------------------------------------------------------------
    */
    public function IndexRopaDeportiva(){
        // Importamos modelos 
        $talles = Talle::all();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $articulos = Articulo::paginate(5);
        $categorias = Categoria::all(); 
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.RopasDeportivas', compact( 'talles', 'ropaDeportivas', 'articulos', 'categorias'));
    }

    public function añadir_ropa(Request $request){

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


        // Obtén los datos del array de tallas y el array de stock
        $talles = $request->input('talles');      // Acceder al array 
        $stocks = $request->input('stocks');          // Acceder al array 
        $tallesIds = $request->input('talle_ids'); // Acceder al array

        // Itera sobre las tallas y sus stocks y guarda la relación con el producto en la tabla pivot
        foreach ($talles as $indice => $talle) {

            if (isset($stocks[$indice]) > 0) {
                // Obtén la instancia de talla existente
                $talle = Talle::where('talle_ropa', $talle)->first(); 

                $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0; // Verifica si 'stock' está definido

                // Asegúrate de tener la relación definida en tu modelo Producto y tu modelo Calzado
                $articuloNuevo->talles()->attach($talle->id, ['stocks' => $stock]);

            }
        }
        return back()->with('mensaje', 'Artículo agregado con éxito.');
    }
}
