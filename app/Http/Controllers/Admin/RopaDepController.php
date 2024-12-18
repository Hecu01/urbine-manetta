<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\Ropa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class RopaDepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Importamos modelos 
        $talles = Talle::all();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $articulos = Articulo::paginate(5);
        $categorias = Categoria::all();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ropasDeportivas.index', compact('talles', 'ropaDeportivas', 'articulos', 'categorias', 'deportes'));
    }

    public function formulario()
    {
        // Importamos modelos 
        $talles = Talle::all();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $articulos = Articulo::paginate(5);
        $categorias = Categoria::all();
        $ropas = Ropa::orderBy('nombre', 'asc')->pluck('nombre');
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ropasDeportivas.formulario', compact('talles', 'ropaDeportivas', 'articulos', 'categorias', 'deportes', 'ropas'));
    }

    public function tabla()
    {
        // Importamos modelos 
        $talles = Talle::all();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $categorias = Categoria::all();
        $articulos = Articulo::where('id_categoria', '2')->with('fotos')->paginate(5);

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ropasDeportivas.tabla', compact('talles', 'ropaDeportivas', 'articulos', 'categorias', 'deportes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /* Crear ropa deportiva */
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'precio' => [
                'required', 
                'max:2147483647', // Valor máximo para un INT con signo en MySQL
            ],
            'tipoProducto' => 'required',
            'otroTipoProducto' => 'nullable|string|max:20',
            'stock' => 'required|integer',
        ], [
            'stock.required' => 'Debes colocar los talles',
        ]);

    

        // Al momento de seleccionar el tipo de producto
        if ($request->tipoProducto === 'otro') {
            $tipoProducto = $request->otro_tipo_producto; // Usar el texto del campo

            // Verificar si el tipo de ropa ya existe en la tabla 'ropas'
            $ropaExistente = Ropa::where('nombre', $tipoProducto)->first();

            // Si no existe, insertarlo en la tabla 'ropas'
            if (!$ropaExistente) {
                Ropa::create(['nombre' => $tipoProducto]);
            }
        } else {
            $tipoProducto = $request->tipoProducto; // Usar la opción seleccionada
        }

        // Verificar que tipoProducto no sea null o vacío
        if (empty($tipoProducto)) {
            return back()->withErrors(['tipoProducto' => 'El tipo de producto es obligatorio.']);
        }



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
            // 'tipo_producto' => $request->tipoProducto,
            'tipo_producto' => $tipoProducto,
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
        // Obtener el array de valores desde el formulario
        // $idsDeportes = $request->input('etiquetas');
        $idsDeportes = $request->input('select_deportes', []);
        
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
                $articuloNuevo->deportes()->attach($deporte->id);
            }
        }

        // Obtén los datos del array de tallas y el array de stock
        $stocks = $request->input('stocks', []);
        
        $tallesIds = array_map('intval', $request->input('talles', []));
        $talle_ropa = [];

        // Consultar la tabla 'talles' para obtener los valores de la columna 'talle_ropa'
        $talle_ropa = Talle::whereIn('id', $tallesIds)->pluck('talle_ropa')->toArray();
        

        // Itera sobre las tallas y sus stocks y guarda la relación con el producto en la tabla pivot
        foreach ($tallesIds as $indice => $talleId) {
            $stock = $stocks[$indice]; // Obtén el stock correspondiente al índice

            // Crea la relación en la tabla pivot
            $articuloNuevo->talles()->attach($talleId, [
                'stocks' => $stock,
            ]);
        }

        // Después de agregar el artículo exitosamente
        Session::flash('mensaje', true);
        return redirect()->route('ropa-deportiva.index')->with('success', 'Ropa creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $articulo = Articulo::findOrFail($id);
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $talles = Talle::all();
        $ropaDeportivas = Articulo::where('id_categoria', '2')->count();
        $title = "Editando ropa";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ropasDeportivas.edit', compact('articulo', 'talles', 'title', 'deportes','ropaDeportivas'));
    }

    /* Actualizar ropa deportiva *
        * Update the specified resource in storage.
        */
    public function update(Request $request, string $id)
    {
        // Recibir el id del articulo a actualizar
        $articulo = Articulo::findOrFail($id);

        // Verificar si tipo de producto (si es que es relacion muchos a muchos o no)
        $tipoProducto = $request->input('tipoProducto');
        
            // Obtén los datos del array de tallas y el array de stock
            $talles = $request->input('talles');       
            $stocks = $request->input('stocks');          
            $talleIds = $request->input('talle_ids'); 
            $precios = $request->input('precios');
            
            foreach ($articulo->talles as $talle) {

                // Verifica si el talle existe en la solicitud y si su checkbox está marcado
                $indice = array_search($talle->id, $talleIds);
                $checkbox_checked = $indice !== false && isset($talles[$indice]);

                // Si el calzado existe pero su checkbox está desmarcado, elimínalo de la tabla pivot
                if (!$checkbox_checked) {
                    $articulo->talles()->detach($talle->id);
                }
            }

            $contenidoTalleIdSeleccionados = [];

            // dd($talles);
            foreach ($talles as $indice => $talle) {
                $stock = isset($stocks[$indice]) ? $stocks[$indice] : 0;

                // Busca el ID del talle
                $talleId = Talle::where('id', $talle)->value('id');
                $contenidoTalleIdSeleccionados[] = $talleId; 

                // Crea un arreglo con los datos del calzado
                $datosTalle = ['stocks' => $stock];

                // Si el calzado no existe, crea uno nuevo y establece los valores de stock y precio
                if (!$talleId) {
                    $nuevoTalle = Talle::create(['talle' => $talle]);
                    $articulo->talles()->syncWithoutDetaching([$nuevoTalle->id => $datosTalle]);
                } else {
                    // Si el calzado existe y su checkbox está marcado, actualiza los valores de stock y precio en la tabla pivot
                    if (isset($talleIds[$indice])) {
                        $articulo->talles()->syncWithoutDetaching([$talleId => $datosTalle]);
                        
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

    /*     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
