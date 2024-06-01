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
        $query = $request->input('articulo-buscado');
    
        // Buscar en los artículos por nombre y marca
        $resultados = Articulo::where('nombre', 'LIKE', "%$query%")
                              ->orWhere('marca', 'LIKE', "%$query%")
                              ->get();
        $contar = $resultados->count();
        // Buscar categorías que coincidan con la consulta
        $categorias = Deporte::where('deporte', 'LIKE', "%$query%")->get();
    
        // Obtener los artículos que pertenecen a esas categorías
        $articulosPorCategoria = Articulo::whereHas('deportes', function ($q) use ($query) {
            $q->where('deporte', 'LIKE', "%$query%");
        })->get();
    
        // Combinar los resultados
        $resultados = $resultados->merge($articulosPorCategoria);
    
        // Contar los resultados únicos
        $contar_resultados = $resultados->unique('id')->count();
    
        // Eliminar duplicados
        $resultados = $resultados->unique('id');
    
        return view('busquedas', compact('resultados', 'query', 'contar_resultados', 'contar'));
    }
    
    public function verDetalles($id){
        $elemento = Articulo::find($id);
        return view('detalles', ['elemento' => $elemento]);
    }
}
