<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

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
