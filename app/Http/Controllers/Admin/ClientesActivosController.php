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
        $title = "Admin - Clientes Activos";
        $clientes = User::where('administrator', false)
                    ->with('compras')
                    ->get();
        
        $recuentoClientes = User::where('administrator', false)->count();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.index', compact('title', 'clientes', 'recuentoClientes'));

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
    /* Tabla de clientes activos */
    public function tablaClientesActivos()
    {
        $title = "Admin - Tabla Clientes Activos";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.Clientes.index', compact('title', 'usuarios'));
    }
    /* index cargar saldo */
    public function pagCargarSaldo()
    {
        $title = "Admin - Saldos";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.Saldos.index', compact('title', 'usuarios'));
    }

    /* Pagina de usuario - cargar saldo */
    public function asigarSaldoUsuario($id)
    {
        $user = User::findOrFail($id);
        $title = "Admin - Cargar saldo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.Saldos.CargarSaldo', compact('title', 'user'));
    }

    // Cargar virtual de saldo
    public function carga_virtual_saldo(Request $request, string $id){
        $cargaSaldo = User::findOrFail($id);
        $cargaSaldo->update([
            'dinero_en_cuenta' => $request->plata,
        ]);
        // Una vez finalizado, el redireccionamiento
        return redirect()->back()->with('success', 'Carga de saldo realizada');
    }
    

    /* Asignar porcentaje descuentos */
    public function porcentajeDescuentos()
    {
        $title = "Admin - Porcentaje descuentos";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.DescuentoEspecial.PorcentajeDescuentos', compact('title', 'usuarios'));
    }
    /* Página aceptar o rechazar descuentos */
    public function pagDescuentosEspeciales()
    {
        $title = "Admin - Descuentos Especiales";
        $usuarios = User::where('administrator', false)->get();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.DescuentoEspecial.Habilitar&InhabilitarDescuento', compact('title', 'usuarios'));
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
        $HabilitarDescuento->aceptado = "si";
        $HabilitarDescuento->descuento_activo = true;
        $HabilitarDescuento->save();

        return redirect()->back()->with('success', 'Aceptado con exito el descuento');
    }
    // Rechazar descuento especial
    public function rechazarDescuento($id)
    {
        $RechazarDescuento = DescuentoUsuario::findOrFail($id);
        
        // Cambiar el estado de la tupla
        $RechazarDescuento->aceptado = "no";
        $RechazarDescuento->save();
        
        return redirect()->back()->with('success', 'Rechazado con exito el descuento');
    }
    
    // Pág. asignar descuento
    public function pagAsignarDescuento($id){
        $DescuentoUsuario = DescuentoUsuario::findOrFail($id);
        $title = "Admin - Descuento porcentaje";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.clientesActivos.DescuentoEspecial.PaginaAsignarDescuento', compact('title', 'DescuentoUsuario'));

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
