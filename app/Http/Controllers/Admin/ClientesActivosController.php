<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DescuentoUsuario;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ClientesActivosController extends Controller
{
    /* Index */
    public function index()
    {
        $title = "Sportivo - Clientes Activos";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.index', compact('title'));
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
    /* Asignar porcentaje descuentos */
    public function porcentajeDescuentos()
    {
        $title = "Sportivo - Porcentaje descuentos";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.PorcentajeDescuentos', compact('title', 'usuarios'));
    }
    /* Página aceptar o rechazar descuentos */
    public function pagDescuentosEspeciales()
    {
        $title = "Sportivo - Descuentos Especiales";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.Habilitar&InhabilitarDescuento', compact('title', 'usuarios'));
    }
    
    // Aceptar descuento especial
    public function habilitarInhabilitarDescuento($id)
    {
        $DeshabilitarDescuento = DescuentoUsuario::findOrFail($id);       

        // Cambiar el estado de la tupla
        $DeshabilitarDescuento->descuento_activo = !$DeshabilitarDescuento->descuento_activo;
        $DeshabilitarDescuento->save();

        return redirect()->back()->with('success', 'Se cambió el estado');
    }

    // Aceptar descuento especial
    public function aceptarDescuento($id)
    {
        $HabilitarDescuento = DescuentoUsuario::findOrFail($id);
        
        // Cambiar el estado de la tupla
        $HabilitarDescuento->aceptado = true;
        $HabilitarDescuento->descuento_activo = true;
        $HabilitarDescuento->save();

        return redirect()->back()->with('success', 'Aceptado con exito el descuento');
    }
    // Rechazar descuento especial
    public function rechazarDescuento($id)
    {
        $RechazarDescuento = DescuentoUsuario::findOrFail($id);
        
        // Cambiar el estado de la tupla
        $RechazarDescuento->aceptado = false;
        $RechazarDescuento->save();
        
        return redirect()->back()->with('success', 'Rechazado con exito el descuento');
    }
    
    // Pág. asignar descuento
    public function pagAsignarDescuento($id){
        $DescuentoUsuario = DescuentoUsuario::findOrFail($id);
        $title = "Sportivo - Descuento porcentaje";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.PaginaAsignarDescuento', compact('title', 'DescuentoUsuario'));

    }
    // Pág. asignar descuento
    public function adjuntarDescuento(Request $request, string $id){
        $DescuentoUsuario = DescuentoUsuario::findOrFail($id);
        $DescuentoUsuario->update([
            'porcentaje_descuento' => $request->porcentaje_descuento,
        ]);
        // Una vez finalizado, el redireccionamiento
        return redirect()->back()->with('success', 'Porcentaje asignado con éxito.');
    }

}
