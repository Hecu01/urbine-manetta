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
        $articulos = Articulo::all();
        $deportes = Deporte::all();
        $title = "Suplementos y dieta";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin/suplementosDieta/index', compact('title','articulos','deportes'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Path para guardar la imagen en storage
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $carpetaDestino = storage_path('productos');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($carpetaDestino, $file->getClientOriginalName());
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
            'tipo_producto' => $request->tipoProducto,
            'foto' => $filename
        ]);

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
        return redirect()->route('suplementos-dieta.index');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
