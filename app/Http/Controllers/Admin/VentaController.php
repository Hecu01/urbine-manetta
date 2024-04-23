<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Talle;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $articulos = Articulo::orderBy('nombre', 'asc')->get();
        $deportes = Deporte::orderBy('deporte', 'asc')->get();
        $usuarios = User::where('administrator', false)->get();
        $user = Auth::user();
        $title = "Sportivo - Ventas";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.ventas.index', compact('title', 'articulos','deportes', 'usuarios'));
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
        $id_cliente = $request->cliente;
        $ventaNueva = New Venta;
        if(!isset($id_cliente)){
            $nombre = $request->nombre;
            $apellido = $request->apellido;
            $dni = $request->dni;
        }
        // Obtener el array enviado desde el formulario
        $ventasArray = json_decode($request->input('ventasArray'), true);
        
        $importe_total = 0;
        $unidades_total = 0;
        // dd($ventasArray);
        foreach ($ventasArray as $venta) {
            $precio_unitario = $venta['precio_unitario'];
            // Sumar el importe
            $importe = $venta['importe'];
            $importe_total += $importe;
            // Sumar las unidades
            $unidades = $venta['unidades'];
            $unidades_total += $unidades;
        }

        $ventaNueva = Venta::create([
            'user_id' => $id_cliente,
            'unidades' => $unidades_total,
            'total' => $importe_total,
            // 'nombre' => $nombre,
            // 'apellido' => $apellido,
            // 'dni' => $dni,
        ]);


      
        // Iterar sobre cada elemento del array de ventas
        foreach ($ventasArray as $venta) {
            // Obtener el artículo correspondiente
            $articulo = Articulo::find($venta['articulo_id']);
            $calzado = Calzado::find($venta['articulo_id']);

            // Verificar el tipo de artículo
            if ($venta['tipoProducto'] == 'calzado') {
                
                // Si el artículo es un calzado, asociarlo a la venta de calzados
                // $calzado = $articulo->calzados()->first(); // Suponiendo que la relación se llama "calzados" y obtenemos el primer calzado asociado
                // dd($calzado);
                $ventaNueva->articulos()->attach($articulo->id, [
                    'cantidad' => $venta['unidades'],
                    'precio_unitario' => $venta['precio_unitario']
                ]);
            } else {
                // Si no es un calzado, asociarlo a la venta de otros artículos
                $ventaNueva->articulos()->attach($articulo->id, [
                    'cantidad' => $venta['unidades'],
                    'precio_unitario' => $venta['precio_unitario']
                ]);

                // Calcular el nuevo stock
                $nuevoStock = $articulo->stock - $venta['unidades'];

                // Actualizar el stock del artículo
                $articulo->update(['stock' => $nuevoStock]);
            }
        }

        // Redirigir a una ruta específica o devolver una respuesta si es necesario
        return redirect()->route('ventas.index')->with('');
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
