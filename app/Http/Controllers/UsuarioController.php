<?php

namespace App\Http\Controllers;


use App\Models\Domicilio;
use Illuminate\Http\Request;
use App\Models\DescuentoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
   

class UsuarioController extends Controller
{

    // Quiero mi descuento especial

    public function descuentoUsuario()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verificar si el usuario ya llenó el formulario
            if ($user->descuentoUsuario) {
                return redirect()->route('mi-perfil.index');
            }
        }

        return view('users.descuentoEspecial');
    }
 
    public function storeDescuentoEspecial(Request $request)
    {
        // Path para guardar la imagen en storage
        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $carpetaDestino = storage_path('certificados');
            $filename3 = $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($carpetaDestino, $file->getClientOriginalName());
        }
        // Crear o actualizar la dirección del usuario
        $descuentoEspecial = DescuentoUsuario::updateOrCreate([
            'user_id' => auth()->user()->id,
            'profesion_usuario' => $request->profesion,
            'descuento_activo' => false, 
            'porcentaje_descuento' => 0,
            'motivo_descuento' => $request->motivo,
            'foto_certificado' => $filename3
        ]);

        return redirect()->back()->with('mensaje', 'Descuento solicitado!');
    }

    // Voy a brindar mis datos de domicilio

    public function domicilio()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verificar si el usuario ya tiene datos de domicilio registrados
            if ($user->domicilio) {
                return redirect()->route('mi-perfil.index');
            }
        }

        return view('users.AddAddress');
    }

    public function agregar_domicilio(Request $request){
        // Crear o actualizar la dirección del usuario
        $domicilio = Domicilio::updateOrCreate([
            'user_id' => auth()->user()->id,
            'calle' => $request->calle, 
            'barrio' => $request->barrio, 
            'departamento' => $request->dpto, 
            'piso' => $request->piso, 
            'ciudad' => $request->distrito, 
            'codigo_postal' => $request->cod_postal 
        ]);
        
        return redirect()->back()->with('mensaje', 'Dirección guardada exitosamente.');
    }
    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Sportivo - Perfil";
        $user = Auth::user();
        return view('users.mi_perfil', compact('title', 'user'));
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Editar Perfil";
        $user = Auth::user();
        return view('users.EditarPerfil', compact('title', 'user'));
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
