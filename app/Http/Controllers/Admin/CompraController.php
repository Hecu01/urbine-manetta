<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
    */ 
    public function index()
    {
        $articulos = Articulo::orderBy('nombre', 'asc')->get();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $usuarios = User::where('administrator', false)->get();
        $comprasRealizadas = Compra::all()->count();
        $user = Auth::user();
        $title = "Sportivo - Compras";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.compras.index', compact('title', 'articulos','deportes', 'usuarios', 'comprasRealizadas'));
    }

    public function tabla()
    {
        $compras = Compra::paginate(8);
        $usuarios = User::where('administrator', false)->get();
        $comprasRealizadas = Compra::all()->count();
        $user = Auth::user();
        $title = "Sportivo - Tabla compras";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.compras.tabla', compact('title', 'compras', 'usuarios', 'comprasRealizadas'));
    }

    public function pdf(string $id){
        $compra = Compra::find($id);
        $cliente = Compra::with('user')->get();

        $detalleVenta = Compra::with('articulos')->find($id);
        $pdf = Pdf::loadView('admin.compras.pdf', compact('compra', 'cliente', 'detalleVenta'));
        // return $pdf->download('invoice.pdf');
        return $pdf->stream();
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
