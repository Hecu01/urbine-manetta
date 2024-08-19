<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Calzado;
use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $title = "Admin - Solicitar articulo deportivo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.index', compact('title', 'artDeportivos'));
    }
    // Pagina donde se acepta o rechaza la reposicion de la mercaderia
    public function pagAceptarRechazarMercaderia(){
        $user = Auth::user();
        $artDeportivos = ReposicionMercaderia::with('articulos.calzados')->get();
        $contarReposiciones = ReposicionMercaderia::count();
        $title = "Admin - Aceptar o rechazar mercaderia";
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
        $valorCalzadoTalles = $request->input('valorCalzadoTalle');
        // dd($valorCalzadoTalle);
        
        // Creamos la nueva reposicion, agregamos estado pendiente
        $reposicion = ReposicionMercaderia::create([
            'estado' => 'pendiente',
        ]);


        // Hacemos un if logico entre un producto array o no
        if($relacionMuchos == 'true'){

            // Camino sobre relacion de muchos a muchos
            foreach($idMuchos as $indice => $idMucho){
                $stock = $stockMuchos[$indice];
                $idCalzado = $idMuchos[$indice];
                $idRopa = $idMuchos[$indice];
                $valorCalzadoTalle = $valorCalzadoTalles[$indice];

                // Verificamos si se solicito stock                
                if($stock > 0){

                    // if entre calzado y ropa
                    if($tipo_producto == "calzado"){
                        $reposicion->articulos()->attach($id_artDeport, [
                            'cantidad' => $stock,
                            'calzado_id' => $idCalzado,  // Aquí usas el $idCalzado dinámico
                            'valor_calzado_talle' => $valorCalzadoTalle  
                        ]);
                    }else{
                        $reposicion->articulos()->attach($id_artDeport, [
                            'cantidad' => $stock,
                            'talla_id' => $idRopa, // Puedes llenar esto según tu lógica
                            'valor_calzado_talle' => $valorCalzadoTalle  
                        ]);
                    }
                }
            }
            

        } else{
            // Por aca si no es relacion de muchos a muchos
            $reposicion->articulos()->attach(
                ['id' => $id_artDeport],
                ['cantidad' => $unidades]
            );

        }
        return redirect()->back()->with('success', 'Solicitud de reposición creada.');


    }


    public function aceptarPedido(Request $request, $id)
    {
        $artDeportivo = ReposicionMercaderia::with(['articulos.calzados', 'articulos.talles'])->find($id);

        if ($artDeportivo) {
            $stockIncrementArray = [];
            $talleIdArray = [];
            $talleStockIncrementArray = [];
            $stockPrincipal = 0;
            foreach ($artDeportivo->articulos as $articulo) {
                // Incrementar stock del artículo si no tiene relación de muchos a muchos
                if ($articulo->calzados->isEmpty() && $articulo->talles->isEmpty()) {
                    $articulo->stock += intval($articulo->pivot->cantidad);
                } else {
                    
                    $calzadoIdArray[] = intval($articulo->pivot->calzado_id);
                    $stockIncrementArray[] = intval($articulo->pivot->cantidad);
                    $stockPrincipal += intval($articulo->pivot->cantidad);
                    $articulo->stock += $stockPrincipal; 


                }
            }
            $articulo->save();
            // dd($calzadoIdArray);
            // Incrementar stock de calzados
            if (!$articulo->calzados->isEmpty() || !$articulo->talles->isEmpty()) {
                foreach ($calzadoIdArray as $index => $calzadoId) {
                    DB::table('articulo_calzado')
                        ->where('calzado_id', $calzadoId)
                        ->increment('stocks', $stockIncrementArray[$index]);
    
                }
            }


            $artDeportivo->estado = 'Finalizado';
            $artDeportivo->save();

            return redirect()->back()->with('success', 'Pedido aceptado y stock actualizado correctamente.');
        }

        return redirect()->back()->with('danger', 'Pedido no encontrado.');
    }

    





    // rechazar pedido
    public function rechazarPedido(Request $request, $id)
    {
        // Encuentra la relación pivot específica y actualiza el estado
        $artDeportivo = ReposicionMercaderia::find($id);
        $artDeportivo->estado = "Cancelado";
        $artDeportivo->save(); 

        return redirect()->back()->with('danger', 'Pedido cancelado exitosamente');
    }
    public function eliminarPedido(Request $request, $id)
    {
        // Encuentra la relación pivot específica y actualiza el estado
        $artDeportivo = ReposicionMercaderia::find($id);
        $artDeportivo->delete(); 

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
