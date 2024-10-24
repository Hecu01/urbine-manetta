<?php

namespace App\Http\Controllers;


use App\Models\Domicilio;
use Illuminate\Http\Request;
use App\Models\DescuentoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
   

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

    // Usuario está agregando domicilio
    public function agregar_domicilio(Request $request){
        // Crear o actualizar la dirección del usuario
        $domicilio = Domicilio::updateOrCreate([
            'user_id' => auth()->user()->id,
            'calle' => $request->calle, 
            'barrio' => $request->barrio, 
            'departamento' => $request->dpto, 
            'piso' => $request->piso, 
            'ciudad' => $request->distrito, 
            'provincia' => $request->provincia, 
            'pais' => $request->pais, 
            'codigo_postal' => $request->cod_postal 
        ]);
        Session::flash('mensaje', true);
        return redirect()->route('mi-perfil.index')->with('mensaje', 'Dirección guardada exitosamente.');
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
        // // Validar los datos del formulario
        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'dni' => 'required|int|max:255',
        //     // Validación para el domicilio
        //     'calle' => 'required|string|max:255',
        //     'ciudad' => 'required|string|max:255',
        //     'codigo_postal' => 'required|string|max:10',
        // ]);

        $usuario = auth()->user();
        $usuario->update([
            'name' => $request->input('nombre'),
            'lastname' => $request->input('apellido'),
            'dni' => $request->input('dni')
        ]);

        $usuario->domicilio()->update([
            'calle' => $request->input('calle'),
            'barrio' => $request->input('barrio'),
            'ciudad'=> $request->input('ciudad'),
            'codigo_postal'=> $request->input('codigo_postal'),
            'departamento'=> $request->input('departamento'),
            'piso' => $request->input('piso'),
            'provincia' => $request->input('provincia'),
            'pais' => $request->input('pais')
        ]);
        Session::flash('mensaje', true);

        return redirect()->back()->with('mensaje', 'Se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
