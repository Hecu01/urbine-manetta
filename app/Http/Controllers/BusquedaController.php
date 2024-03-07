<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusquedaController extends Controller
{
    public function buscar(Request $request){
        
        $query = $request->input('articulo-buscado');
        $resultados = Articulo::where('nombre', 'LIKE', "%$query%")->get();
        $contar_resultados = Articulo::where('nombre', 'LIKE', "%$query%")->count();
        return view('busquedas', compact('resultados', 'query', 'contar_resultados'));
    }
    public function verDetalles($id){
        $elemento = Articulo::find($id);
        return view('detalles', ['elemento' => $elemento]);
    }
}
