<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Descuento;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class DescuentoController extends Controller
{
    // Index
    public function index(){
        $articulos = Articulo::all();
        $descuentos = Descuento::all();
        $descuentosActivos = Descuento::all()->count();
        
        $user = Auth::user();
        $title = "Sportivo - Descuentos";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.descuentos.index', compact('title', 'articulos', 'descuentosActivos', 'descuentos'));
    }

    
    /* Búsqueda AJAX para descuentos */

    public function buscarArtParaDescuento(Request $request)
    {
        $searchTerm3 = $request->input('searchTerm3');

        // Retornar temprano si el campo de búsqueda está vacío
        
        if (empty($searchTerm3)) {
            return response()->json(['results3' => []]);
        }


        // Continuar solo si hay datos en el campo de búsqueda

        $results3 = Articulo::query()
            ->where('nombre', 'like', '%' . $searchTerm3 . '%')
            ->orWhere('precio', 'like', '%' . $searchTerm3 . '%')
            ->orWhere('id', 'like', '%' . $searchTerm3 . '%')
            ->with(['descuento', 'fotos'])
            ->get()
            ->map(function ($articulo) {
                // Agregar la propiedad descuento_existe directamente al resultado
                $articulo->descuento_existe = $articulo->descuento !== null;
                return $articulo;
            });

        return response()->json(['results3' => $results3]);
    }

   

    public function cambiarEstadoDescuento($id)
    {
        $Descuento = Descuento::findOrFail($id);
        
        // Cambiar el estado de la tupla
        $Descuento->activo = !$Descuento->activo; // Cambiar de activo a inactivo o viceversa
        $Descuento->save();

        return redirect()->back()->with('success', 'Estado del Descuento cambiado correctamente');
    }
    
    public function eliminarDescuento($id)
    {
        $Descuento = Descuento::findOrFail($id);
        $Descuento->delete();

        return redirect()->back()->with('success', 'Tupla eliminada correctamente');
    }

    /* Editar articulo deportivo */
    public function aplicarDescuento($id){
        $articulo = Articulo::findOrFail($id);
        $calzados = Calzado::all();        
        $title = "Aplicando descuento";

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.descuentos.AplicarDescuento', compact('articulo', 'calzados', 'title'));
    }

    /* Nuevo descuento */
    public function crear(Request $request, $articuloId)
    {
        // Encuentra el artículo al que deseas aplicar el descuento
        $articulo = Articulo::findOrFail($articuloId);

        // Crea un nuevo descuento para el artículo
        $descuento = new Descuento();
        $descuento->porcentaje = $request->input('porcentaje');
        $descuento->plata_descuento = $request->input('descuento');
        $descuento->activo = $request->input('activo', true); // Valor predeterminado es true
        
        // Asocia el descuento con el artículo
        $articulo->descuento()->save($descuento);

        // Redirecciona o muestra un mensaje de éxito
        return redirect()->route('descuentos', ['id' => $articuloId])->with('success', 'Descuento creado con éxito');
    }

}