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
        $admines = User::where('administrator', true)->get();
        
        $usuariosAdmines = User::where('administrator', true)
                                ->where('super_administrator', false)
                                ->get();

        $title = "Sportivo - Admines";
        $adminesActivos = User::where('administrator', true)->count();

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.adminesActivos.index', compact('title', 'usuarios', 'adminesActivos', 'usuariosAdmines', 'admines'));
    }

    /**
     * Habilitar un nuevo admin
     */
    public function HabilitarAdmin(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        $cambioValor = 1; // True
        $usuario->administrator = $cambioValor;
        $usuario->save();

        // Obtener el nombre del usuario
        $nombreCompleto = $usuario->name . ' ' . $usuario->lastname;
        return redirect()->route('AdminesActivos.index')->with('success', "Se ha habilitado al admin: $nombreCompleto");
    }

    public function QuitarAdmin(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        $cambioValor = 0; // false
        $usuario->administrator = $cambioValor;
        $usuario->save();

        // Obtener el nombre del usuario
        $nombreCompleto = $usuario->name . ' ' . $usuario->lastname;
        return redirect()->route('AdminesActivos.index')->with('danger', "Se le ha quitado el admin a: $nombreCompleto");
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
