<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Calzado;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReposicionMercaderia;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;


class ReponerMercaderiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $user = Auth::user();
        $title = "Admin - Mercadería";
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.index', compact('title'));
    }


    // index reponer - articulos deportivo
    public function indexSoliciarArtDeport(){
        $user = Auth::user();
        // $artDeportivos = ReposicionMercaderia::with(['articulos' => function ($query) {
        //     $query->orderBy('stock', 'asc');
        // }])->whereHas('articulos', function ($query) {
        //     $query->where('id_categoria', '1');
        // })->get();
        $artDeportivos = Articulo::where('id_categoria', '1')->orderBy('stock', 'asc')->with('reposiciones')->get();
        $title = "Admin - Solicitar art deport";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.index', compact('title', 'artDeportivos'));
    }
    // Pagina donde se acepta o rechaza la reposicion de la mercaderia
    public function pagAceptarRechazarMercaderia(){
        $user = Auth::user();
        $artDeportivos = ReposicionMercaderia::with('articulos')->get();
        $contarReposiciones = ReposicionMercaderia::count();
        $title = "Aceptar o rechazar stock";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.TablaReponerArtDeport', compact('title', 'artDeportivos','contarReposiciones'));
    }


    // pagina para reponer por id - articulo deportivo
    public function solicitarMercaderiaArtDeport($id){
        $user = Auth::user();
        $artDeportivos = Articulo::findOrFail($id);
        $calzados = Calzado::all();
        $title = "Admin - ID Articulo Deportivo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.ID_ArticuloDeportivo', compact('title', 'artDeportivos','calzados'));
    }

    // Solicitud enviada a la db - articulo deportivo
    public function enviarSolicitudReponerArtDeport(Request $request){

        $unidades = $request->input('unidades_reposicion'); // Stock a solicitar
        $tipo_producto = $request->input('tipo_producto'); // Variable tipo producto
        $id_artDeport = $request->input('id_artDeport'); // Variable tipo producto
        $relacionMuchos = $request->input('muchos_a_muchos_bool'); // Booleano muchos a muchos
        $stockMuchos = $request->input('stock_solicitado_muchos_a_muchos');
        $idMuchos = $request->input('art_id_muchos_a_muchos');
        
        // Creamos la nueva reposicion, agregamos estado pendiente
        $reposicion = ReposicionMercaderia::create([
            'estado' => 'pendiente',
        ]);

        /* id 	articulo_id 	reposicion_mercaderia_id 	talla_id 	calzado_id 	cantidad  */
        // Hacemos un if logico entre un producto array o no
        if($relacionMuchos == 'true'){
            // Camino sobre relacion de muchos a muchos
            dd($idMuchos);
            

        } else{
            // Por aca si no es relacion de muchos a muchos
            $reposicion->articulos()->attach(['id' => $id_artDeport], ['cantidad' => $unidades]);

        }
        return redirect()->back()->with('success', 'Solicitud de reposición creada.');


    }

    // aceptar pedido
    public function aceptarPedido(Request $request, $id)
    {
        // Encuentra la relación pivot específica y actualiza el estado
        $artDeportivo = ReposicionMercaderia::with('articulos')->find($id);
    
        if ($artDeportivo) {
            // Incrementar el stock de cada artículo en la relación pivot
            foreach ($artDeportivo->articulos as $articulo) {
                $articulo->stock += $articulo->pivot->cantidad;
                $articulo->save();
            }
    
            $artDeportivo->estado = 'Finalizado'; // Actualiza el estado según tu lógica
            $artDeportivo->save();
    
            return redirect()->back()->with('success', 'Pedido aceptado y stock actualizado correctamente.');
        }
    
        return redirect()->back()->with('danger', 'Pedido no encontrado.');
    }

    // aceptar pedido
    public function eliminarPedido(Request $request, $id)
    {
        // Encuentra la relación pivot específica y actualiza el estado
        $artDeportivo = ReposicionMercaderia::find($id);
        $artDeportivo->delete(); // Actualiza el estado según tu lógica

        return redirect()->back()->with('danger', 'Pedido eliminado exitosamente');
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
