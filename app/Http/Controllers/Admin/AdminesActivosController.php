<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminesActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $usuarios = User::where('administrator', false)->get();
        $title = "Sportivo - Admines";

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.adminesActivos.index', compact('title', 'usuarios'));
    }

    // Habilitar nuevo administrador
    public function HabilitarAdmin(Request $request, $id) {
        $usuario = User::findOrFail($id);
        $cambioValor = 1; // True
        $usuario->administrator = $cambioValor;
        $usuario->save();
        return redirect()->route('admins');
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
