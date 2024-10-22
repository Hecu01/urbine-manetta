<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        // Obtener los parámetros de búsqueda y filtros
        $query = $request->input('articulo-buscado');
        $orderDirection = $request->input('orderDirection', 'asc');
        $selectedGeneros = $request->input('generos', []);
        $selectedBrands = $request->input('brands', []);
        $selectedDeporte = $request->input('deportes', []); // Cambiado a 'deportes'
        $selectedDirigidoA = $request->input('publico_dirigido', []);

        // Si no es un array, conviértelo en uno
        if (!is_array($selectedGeneros)) {
            $selectedGeneros = [$selectedGeneros];
        }
        
        if (!is_array($selectedBrands)) {
            $selectedBrands = [$selectedBrands];
        }

        if (!is_array($selectedDeporte)) {
            $selectedDeporte = [$selectedDeporte];
        }

        if (!is_array($selectedDirigidoA)) {
            $selectedDirigidoA = [$selectedDirigidoA]; 
        }

        // 1. Obtener todas las opciones de filtros (sin aplicar filtros de búsqueda)
        $allGeneros = Articulo::pluck('genero')->unique()->sort()->values();
        $allBrands = Articulo::pluck('marca')->unique()->sort()->values();
        $allDeportes = Deporte::pluck('deporte')->unique()->sort();

        // 2. Filtrar los artículos según el término de búsqueda
        $baseQuery = Articulo::where(function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('marca', 'LIKE', "%{$query}%")
                ->orWhereHas('deportes', function ($q) use ($query) {
                    $q->where('deporte', 'LIKE', "%{$query}%");
                });
        });

        // 3. Aplicar los filtros seleccionados si existen
        if (!empty($selectedGeneros)) {
            $baseQuery->whereIn('genero', $selectedGeneros);
        }

        if (!empty($selectedBrands)) {
            $baseQuery->whereIn('marca', $selectedBrands);
        }

        if (!empty($selectedDeporte)) {
            // Si hay deportes seleccionados, filtrar por ellos
            $baseQuery->whereHas('deportes', function ($q) use ($selectedDeporte) {
                $q->whereIn('deporte', $selectedDeporte);
            });
        }

        if (!empty($selectedDirigidoA)) {
            $baseQuery->whereIn('dirigido_a', $selectedDirigidoA);
        }

        // 4. Obtener los resultados filtrados con la relación 'descuento'
        $resultados = $baseQuery->with('descuento')->get();

        // 5. Ordenar los resultados por (precio - descuento)
        $resultados = $resultados->sortBy(function ($articulo) {
            $precioBase = $articulo->precio;
            $descuento = $articulo->descuento ? $articulo->descuento->plata_descuento : 0;
            return $precioBase - $descuento;
        });

        // 6. Invertir el orden si la dirección es 'desc'
        if ($orderDirection === 'desc') {
            $resultados = $resultados->reverse();
        }

        // 7. Contar los resultados
        $contar_resultados = $resultados->count();

        // 8. Retornar la vista con las variables necesarias
        return view('busquedas', compact('resultados', 'query', 'contar_resultados', 'orderDirection', 'selectedBrands', 'selectedGeneros', 'selectedDeporte', 'selectedDirigidoA', 'allBrands', 'allGeneros', 'allDeportes'));
    }


    public function destroy($id)
{
    // Busca el artículo por su ID
    $articulo = Articulo::find($id);

    if (!$articulo) {
        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }

    // Aquí puedes eliminar la foto si tienes su ruta almacenada
    if($articulo){
        $imagenPath = storage_path('producto/' . $articulo->foto); 
        if (file_exists($imagenPath)) {
            unlink($imagenPath); // Elimina la imagen asociada si la hay
        }

        $articulo->delete(); //Elimina el articulo de la base de datos
        // Después de eliminar el artículo exitosamente
        Session::flash('eliminado', true);
    }

    // Elimina el artículo
    $articulo->delete();

    return response()->json(['success' => 'Artículo eliminado con éxito']);
}

        // if($articulo){
        //     $imagenPath = storage_path('producto/' . $articulo->foto); 
        //     if (file_exists($imagenPath)) {
        //         unlink($imagenPath); // Elimina la imagen asociada si la hay
        //     }

        //     $articulo->delete(); //Elimina el articulo de la base de datos
        //     // Después de eliminar el artículo exitosamente
        //     Session::flash('eliminado', true);
        // }
        // // Obtiene la URL anterior con la pestaña actual como fragmento
        
        // return redirect()->route('articulos-deportivos.index')->with('success', 'Eliminado correctamente.');
}
