<?php

namespace App\Http\Controllers\Admin;



use App\Models\User;
use App\Models\Foto;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class ArtDeportController extends Controller{
    /* Página inicio *
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.articulosDeportivos.index', compact('categorias', 'articulos', 'calzados', 'artDeportivos', 'title','deportes'));

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
    /* *
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /* Crear artículo deportivo *
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Crear artículo nuevo
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
            'tipo_producto' => $request->tipoProducto
        ]);
    
        // Verificar y guardar múltiples fotos si están presentes
        if($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $filename = $file->getClientOriginalName();
                $carpetaDestino = storage_path('productos');
                $file->move($carpetaDestino, $filename);
    
                // Crear una entrada en la tabla 'fotos' relacionada con el artículo
                $articuloNuevo->fotos()->create(['ruta' => $filename]);
            }
        }
    
        // Obtener y procesar las etiquetas asociadas (deportes)
        $idsDeportes = $request->input('etiquetas');
        if ($idsDeportes) {
            foreach ($idsDeportes as $idDeporte) {
                $deporte = Deporte::find($idDeporte);
                if ($deporte) {
                    $articuloNuevo->deportes()->attach($deporte->id);
                }
            }
        }
    
        // Lógica de unión para calzados si el producto es un calzado
        $tipoProducto = $request->input('tipoProducto');
        if ($tipoProducto == "calzado") {
            $calzados = $request->input('calzados');
            $stocks = $request->input('stocks');
            $precios = $request->input('precios');
    
            foreach ($calzados as $indice => $calzado) {
                if (isset($stocks[$indice]) && $stocks[$indice] > 0) {
                    $calzadoExistente = Calzado::where('calzado', $calzado)->first();
    
                    if ($calzadoExistente) {
                        $stock = $stocks[$indice];
                        $precio = $precios[$indice];
                        $articuloNuevo->calzados()->attach($calzadoExistente->id, [
                            'stocks' => $stock,
                            'precio' => $precio
                        ]);
                    }
                }
            }
        }
    
        // Después de agregar el artículo exitosamente
        Session::flash('mensaje', true);
        return redirect()->back()->with('success', 'Producto creado exitosamente.');
    }
    

    /* Mostrar artículo deportivo *
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /* Editar artículo deportivo *
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $articulo = Articulo::findOrFail($id);
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $calzados = Calzado::all();
        $title = "Editando artículo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.articulosDeportivos.edit', compact('articulo', 'calzados', 'title', 'deportes'));
    }

    /* Actualizar artículo deportivo *
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Recibir el id del articulo a actualizar
        $articulo = Articulo::findOrFail($id);

        // Verificar si tipo de producto (si es que es relacion muchos a muchos o no)
        $tipoProducto = $request->input('tipoProducto');
        
        // Tipo de producto "Calzado" toma en en cuenta el sig. código.
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

        // Intentar hacer la relación con cada etiqueta/deporta
        try {
            $deportesSeleccionados = $request->input('deportes', []);
        
            // Obtiene los IDs de los deportes seleccionados en el formulario
            $deporteIdsSeleccionados = Deporte::whereIn('deporte', $deportesSeleccionados)->pluck('id')->toArray();
        
            // Actualiza las etiquetas en la relación, eliminando las no seleccionadas y agregando nuevas
            $articulo->deportes()->sync($deporteIdsSeleccionados);
        
        } catch (\Exception $e) {
            return abort(404, 'Algo salió mal.');
        }
        
        
        
        
        
        
        // Actualización datos de tabla articulos
        $articulo->update([
            'nombre' => $request->nombre_producto,
            'genero' => $request->genero,
            'dirigido_a' => $request->publico_dirigido,
            'tipo_producto' => $request->tipoProducto,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'color' => $request->color,
            'precio' => $request->precio,
        ]);
        
        // Mensaje de actualización exitosa
        Session::flash('mensaje', true);
        
        // Una vez finalizado, el redireccionamiento
        return redirect()->back()->with('success', 'Calzados actualizados correctamente.');
    }


    /* Eliminar artículo deportivo *
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
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
}
