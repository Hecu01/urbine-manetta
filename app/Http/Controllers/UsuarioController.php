<?php

namespace App\Http\Controllers;

use App\Models\Domicilio;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function domicilio()
    {
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
        
        return redirect()->route('home')->with('mensaje', 'Dirección guardada exitosamente.');
    }
}
