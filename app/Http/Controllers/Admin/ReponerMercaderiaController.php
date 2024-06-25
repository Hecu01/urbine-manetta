<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReposicionMercaderia;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;


class ReponerMercaderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $user = Auth::user();
        $title = "Admin - Mercadería";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.index', compact('title'));
    }


    // index reponer - articulos deportivo
    public function indexSoliciarArtDeport(){
        $user = Auth::user();
        $artDeportivos = Articulo::where('id_categoria', '1')->orderBy('stock', 'asc')->get();
        $title = "Admin - Solicitar art deport";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.index', compact('title', 'artDeportivos'));
    }


    // pagina para reponer por id - articulo deportivo
    public function solicitarMercaderiaArtDeport($id){
        $user = Auth::user();
        $artDeportivos = Articulo::findOrFail($id);
        $title = "Admin - ID Articulo Deportivo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.ID_ArticuloDeportivo', compact('title', 'artDeportivos'));
    }

    // Solicitud enviada a la db - articulo deportivo
    public function enviarSolicitudReponerArtDeport(Request $request){
        $reposicion = ReposicionMercaderia::create([
            'estado' => 'pendiente',
        ]);


        foreach ($request->articulos as $articulo) {
            $reposicion->articulos()->attach($articulo['id'], [
                'cantidad' => $articulo['cantidad'],
                'talla_id' => $articulo['talla_id'] ?? null,
                'calzado_id' => $articulo['calzado_id'] ?? null,
            ]);
        }
        return redirect()->route('solicitarMercaderiaArtDeport')->with('success', 'Solicitud de reposición creada.');


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
