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
        // $idResultados = Articulo::where('nombre', 'LIKE', "%$query%")->get();
        $contar_resultados = Articulo::where('nombre', 'LIKE', "%$query%")->count();
        // $consultarTalles=DB::statement('SELECT articulos.id,articulos.nombre, articulos.precio,  calzados.calzado as calzado_disponible FROM articulos join articulo_calzado on articulos.id = articulo_calzado.articulo_id join calzados on articulo_calzado.calzado_id = calzados.id');
        // SELECT articulos.id,articulos.nombre, articulos.precio,  calzados.calzado as calzado_disponible FROM articulos join articulo_calzado on articulos.id = articulo_calzado.articulo_id join calzados on articulo_calzado.calzado_id = calzados.id;

        $talles = Articulo::select('articulos.id', 'articulos.nombre', 'articulos.precio',  'calzados.calzado as calzado_disponible', 'articulo_calzado.stocks', 'articulo_calzado.articulo_id')
            ->join('articulo_calzado', 'articulos.id', '=', 'articulo_calzado.articulo_id')
            ->join('calzados', 'articulo_calzado.calzado_id', '=', 'calzados.id')
            ->get();

        $productos = Articulo::all();


        return view('busquedas', compact('resultados', 'query', 'contar_resultados', 'talles', 'productos'));
    }
    public function verDetalles($id){
        $elemento = Articulo::find($id);
        return view('detalles', ['elemento' => $elemento]);
    }
}
