<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;

class ArtDeportController extends Controller
{

    /* Página principal */
    public function IndexArticuloDeportivo(Request $request){
        $artDeportivos = Articulo::where('id_categoria', '1')->count();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $title="Sportivo - Articulos Deportivos";

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images'); 
                // $product->images()->create(['path' => $path]);
            }
        }
    
        // Importamos modelos 
        $calzados = Calzado::all();
        $categorias = Categoria::all(); 
        $articulos = Articulo::paginate(6);

        // Si no es admin, redirija a la página de inicio
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ArticulosDeportivos', compact('categorias', 'articulos', 'calzados', 'artDeportivos', 'title','deportes'));
    }

    /* Búsqueda AJAX accesorio */
    public function busquedaAjaxArtDeportAccesorio (Request $request){
        $searchTerm = $request->input('searchTerm');

        
        // Realiza la lógica de búsqueda en tu modelo y obtén los resultados
        $results = Articulo::where(function($query) use ($searchTerm) {
            $query->where('nombre', 'like', '%'.$searchTerm.'%')
                ->orWhere('marca', 'like', '%'.$searchTerm.'%')
                ->orWhere('id', 'like', '%'.$searchTerm.'%');
        })->where('id_categoria', 1)->where('tipo_producto', 'accesorio')->orderBy('nombre', 'asc')->get();

        return response()->json($results);
    }

    /* Búsqueda AJAX calzados */
    public function busquedaAjaxArtDeportCalzado (Request $request){
        $searchTerm2 = $request->input('searchTerm2');

        // Realiza la lógica de búsqueda en tu modelo y obtén los resultados
        $results2 = Articulo::where(function($query) use ($searchTerm2) {
            $query->where('nombre', 'like', '%'.$searchTerm2.'%')
                ->orWhere('marca', 'like', '%'.$searchTerm2.'%')
                ->orWhere('id', 'like', '%'.$searchTerm2.'%');
        })->where('id_categoria', 1)->where('tipo_producto', 'calzado')->get();
        
        return response()->json($results2);
    }

    /* Editar articulo deportivo */
    public function EditArtDeport($id){
        $articulo = Articulo::findOrFail($id);
        $calzados = Calzado::all();
        $title = "Editando artículo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.editar.ArtDep_edit', compact('articulo', 'calzados', 'title'));
    }

    /* Eliminar artículo deportivo */
    public function eliminar_articulo($id){
        $articulo = Articulo::find($id); 
        if($articulo){
            $articulo->delete();
            // Después de eliminar el artículo exitosamente
            Session::flash('eliminado', true);
        }
        // Obtiene la URL anterior con la pestaña actual como fragmento
        $url = url()->previous() . '#' . request()->input('nav-link'); // 'tab' es el nombre del campo que almacena el ID de la pestaña
        // Redirige al usuario a la URL anterior con el fragmento
        return redirect($url);
    }
    

    /* Nuevo artículo deportivo */
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
            'color' => $request->color,
            'id_categoria' => $request->categoria,
            'dirigido_a' => $request->publico_dirigido,
            'tipo_producto' => $request->tipoProducto,
            'foto' => $filename
        ]);


        $idsDeportes = $request->input('etiquetas'); // Obtener el array de valores desde el formulario

        // Convertir el array en una cadena de texto separada por comas
        $idsDeportesString = implode(',', $idsDeportes);
        
        // Ahora puedes usar la función explode()
        $etiquetasArray = explode(',', $idsDeportesString);
        $cantidad = $articuloNuevo->stock;
        $length = count($etiquetasArray); // Obtener la longitud del array

        for ($i = 0; $i < $length; $i++) {
            // Accede al elemento del array en la posición $i
            $idDeporte = $etiquetasArray[$i];
            
            // Aquí puedes realizar las acciones que necesites con cada $idDeporte
            // Por ejemplo:
            $deporte = Deporte::find($idDeporte);
            if ($deporte) {
                // Realiza alguna operación con $deporte
                $articuloNuevo->deportes()->attach($deporte->id, ['cantidad' => $cantidad]);

            }
        }



        // Comienzo de la lógica de unión de muchos a muchos,
        // si es que es un calzado
        $tipoProducto = $request->input('tipoProducto');

        if($tipoProducto == "calzado"){
            // Obtén los datos del array de tallas y el array de stock
            $calzados = $request->input('calzados');      // Acceder al array 
            $stocks = $request->input('stocks');    
            $calzadoIds = $request->input('calzado_ids'); // Acceder al array
            $precios = $request->input('precios');
            // Itera sobre las tallas y sus stocks y guarda la relación con el producto en la tabla pivot
            foreach ($calzados as $indice => $calzado) {
    

                if (isset($stocks[$indice]) > 0) {
                    // Obtén la instancia de talla existente
                    $calzado = Calzado::where('calzado', $calzado)->first(); 

                    $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0; // Verifica si 'stock' está definido
                    $precio = isset($precios[$indice]) ? $precios[$indice] : 0; // Verifica si 'precio' está definido
                    
                    // Asegúrate de tener la relación definida en tu modelo Producto y tu modelo Calzado
                    $articuloNuevo->calzados()->attach($calzado->id, ['stocks' => $stock, 'precio' => $precio]);

                }
            }
        }
        // Después de agregar el artículo exitosamente
        Session::flash('mensaje', true);
        return redirect()->route('nuevo_articulo');
    }

    /* Actualizar articulo deportivo */
    public function actualizarArtDeport(Request $request, $id){
        $articulo = Articulo::findOrFail($id);
        $tipoProducto = $request->input('tipoProducto');
        if($tipoProducto == "calzado"){
            // Obtén los datos del array de tallas y el array de stock
            $calzados = $request->input('calzados');       
            $stocks = $request->input('stocks');          
            $calzadoIds = $request->input('calzado_ids'); 
            $precios = $request->input('precios');
            foreach ($articulo->calzados as $calzado) {
                // Verifica si el calzado existe en la solicitud y si su checkbox está marcado
                $indice = array_search($calzado->id, $calzadoIds);
                $checkbox_checked = $indice !== false && isset($calzados[$indice]);
    
                // Si el calzado existe pero su checkbox está desmarcado, elimínalo de la tabla pivot
                if (!$checkbox_checked) {
                    $articulo->calzados()->detach($calzado->id);
                }
            }
    
            foreach ($calzados as $indice => $calzado) {
                $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0;
                $precio = isset($precios[$indice]) ? $precios[$indice] : 0;
    
                // Busca el ID del calzado
                $calzadoId = Calzado::where('calzado', $calzado)->value('id');
                            
                // Crea un arreglo con los datos del calzado
                $datosCalzado = ['stocks' => $stock, 'precio' => $precio];
    
                // Si el calzado no existe, crea uno nuevo y establece los valores de stock y precio
                if (!$calzadoId) {
                    $nuevoCalzado = Calzado::create(['calzado' => $calzado]);
                    $articulo->calzados()->syncWithoutDetaching([$nuevoCalzado->id => $datosCalzado]);
                } else {
                    // Si el calzado existe y su checkbox está marcado, actualiza los valores de stock y precio en la tabla pivot
                    if (isset($calzadoIds[$indice])) {
                        $articulo->calzados()->syncWithoutDetaching([$calzadoId => $datosCalzado]);
                    }
                }
            }
        }



        $articulo->update([
            'nombre' => $request->nombre_producto,
            'genero' => $request->genero,
            'dirigido_a' => $request->publico_dirigido,
            'tipo_producto' => $request->tipoProducto,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'color' => $request->color,
        ]);
        
        // Resto de la lógica para procesar el formulario...

        return redirect()->back()->with('success', 'Calzados actualizados correctamente.');
    }

}
