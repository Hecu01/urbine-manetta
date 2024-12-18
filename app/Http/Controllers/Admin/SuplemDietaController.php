<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Deporte;
use App\Models\Descuento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuplemDietaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $suplementos = Articulo::where('tipo_producto', 'suplemento')->orWhere('tipo_producto', 'comida')->count();
        $articulos = Articulo::all();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $title = "Suplementos y dieta";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin/suplementosDieta/index', compact('title','articulos','deportes','suplementos'));

    }
    /**
     * Display a listing of the resource.
     */
    public function tabla()
    {
        $user = Auth::user();
        $suplementos = Articulo::where('tipo_producto', 'suplemento')->orWhere('tipo_producto', 'comida')->count();
        $articulos = Articulo::where('id_categoria', '3')->get();
        $title = "Suplementos y dieta";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin/suplementosDieta/tabla', compact('title','articulos','suplementos'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $articulos = Articulo::all();
        $suplementos = Articulo::where('tipo_producto', 'suplemento')->orWhere('tipo_producto', 'comida')->count();

        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $title = "Subir nuevo suplemento";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin/suplementosDieta/formulario', compact('title','articulos','deportes', 'suplementos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'precio' => [
                'required',
                'lt:2147483648', // Menor que el valor máximo para INT con signo
            ],
            'stock' => 'required|lt:2147483648',


        ]);

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
            'tipo_producto' => $request->tipoProducto,
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
        $idsDeportes = $request->input('etiquetas'); 

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
        Session::flash('mensaje', true);
        return redirect()->route('suplementos-dieta.index')->with('success', 'Suplemento o comida agregado con éxito');

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
        $suplementos = Articulo::where('id_categoria', '3')->count();
        $title = "Editando ropa";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.suplementosDieta.edit', compact('articulo', 'title', 'deportes','suplementos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Recibir el id del articulo a actualizar
        $articulo = Articulo::findOrFail($id);
 
        // Verificar si tipo de producto (si es que es relacion muchos a muchos o no)
        $tipoProducto = $request->input('tipoProducto');
        

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
