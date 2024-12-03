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


    /* Crear artículo deportivo */
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'tipoProducto' => 'required',
            'otroTipoProducto' => 'nullable|string|max:20',
            'stock' => 'required|integer|min:1',
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
        $talles = $request->input('talles');      // Acceder al array 
        $stocks = $request->input('stocks');
        $calzadoIds = $request->input('talle_ids'); // Acceder al array

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
