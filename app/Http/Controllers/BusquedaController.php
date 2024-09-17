<?php

namespace App\Http\Controllers;

use App\Models\Deporte;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        // Obtener los parámetros de búsqueda y filtros
        $query = $request->input('articulo-buscado');
        $orderDirection = $request->input('orderDirection', 'asc');
        $selectedGeneros = $request->input('generos', []); // Obtener los géneros seleccionados
        $selectedBrands = $request->input('brands', []);

        // 1. Filtrar los artículos según el término de búsqueda
        $baseQuery = Articulo::where(function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('marca', 'LIKE', "%{$query}%")
                ->orWhereHas('deportes', function ($q) use ($query) {
                    $q->where('deporte', 'LIKE', "%{$query}%");
                });
        });

        // 2. Obtener todos los géneros únicos que coinciden con la búsqueda
        $allGeneros = clone $baseQuery; // Clonar la consulta para no afectar la original
        $allGeneros = $allGeneros->pluck('genero')->unique()->sort()->values();

        // 3. Obtener todas las marcas únicas que coinciden con la búsqueda
        $allBrands = clone $baseQuery; // Clonar la consulta para no afectar la original
        $allBrands = $allBrands->pluck('marca')->unique()->sort()->values();

        // 4. Aplicar los filtros seleccionados si existen
        if (!empty($selectedGeneros)) {
            $baseQuery->whereIn('genero', $selectedGeneros);
        }
        if (!empty($selectedBrands)) {
            $baseQuery->whereIn('marca', $selectedBrands);
        }

        // 5. Obtener los resultados filtrados con la relación 'descuento'
        $resultados = $baseQuery->with('descuento')->get();

        // 6. Ordenar los resultados por (precio - descuento)
        $resultados = $resultados->sortBy(function ($articulo) {
            $precioBase = $articulo->precio;
            $descuento = $articulo->descuento ? $articulo->descuento->plata_descuento : 0;
            return $precioBase - $descuento;
        });

        // 7. Invertir el orden si la dirección es 'desc'
        if ($orderDirection === 'desc') {
            $resultados = $resultados->reverse();
        }

        // 8. Contar los resultados
        $contar_resultados = $resultados->count();

        // 9. Retornar la vista con las variables necesarias
        return view('busquedas', compact('resultados', 'query', 'contar_resultados', 'orderDirection', 'selectedBrands', 'selectedGeneros', 'allBrands', 'allGeneros'));
    }

    public function verDetalles($id)
    {
        $elemento = Articulo::find($id);
        return view('detalles', ['elemento' => $elemento]);
    }
}
