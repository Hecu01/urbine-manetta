<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('articulo-buscado');
        $orderDirection = $request->input('orderDirection', 'asc');
        $selectedBrands = $request->input('brands', []);

        $resultados = Articulo::where(function($q) use ($query) {
                                    $q->where('nombre', 'LIKE', "%$query%")
                                      ->orWhere('marca', 'LIKE', "%$query%");
                                })
                                ->when(!empty($selectedBrands), function ($q) use ($selectedBrands) {
                                    $q->whereIn('marca', $selectedBrands);
                                })
                                ->orderBy('precio', $orderDirection)
                                ->get();

        $contar_resultados = $resultados->count();
        $allBrands = Articulo::select('marca')->distinct()->get();

        return view('busquedas', compact('resultados', 'query', 'contar_resultados', 'orderDirection', 'selectedBrands', 'allBrands'));
    }
    
    public function verDetalles($id){
        $elemento = Articulo::find($id);
        return view('detalles', ['elemento' => $elemento]);
    }
}
