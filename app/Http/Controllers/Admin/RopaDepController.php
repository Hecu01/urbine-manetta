<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Descuento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ropasDeportivas.index', compact( 'talles', 'ropaDeportivas', 'articulos', 'categorias', 'deportes'));
 
    }
    public function hola(){
        return view('admin.ropasDeportivas.hola');
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
        //
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
