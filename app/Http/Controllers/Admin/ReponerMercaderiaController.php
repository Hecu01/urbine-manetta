<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;


class ReponerMercaderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $title = "Sportivo - Mercadería";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.index', compact('title'));
    }

    public function indexSoliciarArtDeport(){
        $user = Auth::user();
        $artDeportivos = Articulo::where('id_categoria', '1')->orderBy('stock', 'asc')->get();
        $title = "Sportivo - Solicitar art deport";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.SolicitarArticulosDeportivos', compact('title', 'artDeportivos'));
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
