<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Talle;
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
    /* Reponer mercaderia */

    // Index
    public function index(){
        $user = Auth::user();
        $title = "Admin - Mercadería";
        $reposicionesPendientes = ReposicionMercaderia::count();
        $repPendArtDeport = ReposicionMercaderia::where('id_categoria', '1')->count();
        return(!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.index', compact('title', 'reposicionesPendientes','repPendArtDeport'));
    }

    /*
    |--------------------------------------------------------------------------
    | Reposicion de Articulos deportivos
    |--------------------------------------------------------------------------
    */

    // Index 
    public function indexSoliciarArtDeport(){
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::count();

        $artDeportivos = Articulo::where('id_categoria', '1')->orderBy('stock', 'asc')->with('reposiciones')->get();
        $title = "Admin - Solicitar articulo deportivo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.index', compact('title', 'artDeportivos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaArticulosDeportivos(){
        $user = Auth::user();
        $artDeportivos = ReposicionMercaderia::where('id_categoria', '1')
                                              ->with('articulos.calzados')
                                              ->orderBy('id', 'desc')
                                              ->get();
        $reposicionesPendientes = ReposicionMercaderia::count();
        $title = "Admin - Aceptar o rechazar mercaderia";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.tabla', compact('title', 'artDeportivos','reposicionesPendientes'));
    }

    /*
    |--------------------------------------------------------------------------
    | Reposicion de Ropas deportivas
    |--------------------------------------------------------------------------
    */


    // Index 
    public function indexSoliciarRopDeport(){
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::count();

        $articulos = Articulo::where('id_categoria', '2')->orderBy('stock', 'asc')->with('reposiciones')->get();
        $title = "Solicitar ropas deportivas";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerRopaDeportiva.index', compact('title', 'articulos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaRopasDeportivas(){
        $user = Auth::user();
        $reposiciones = ReposicionMercaderia::where('id_categoria', '2')->with('articulos.talles')->get();
        $reposicionesPendientes = ReposicionMercaderia::count();
        $title = "Admin - Aceptar o rechazar mercaderia";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerRopaDeportiva.tabla', compact('title', 'reposiciones','reposicionesPendientes'));
    }


    /*
    |--------------------------------------------------------------------------
    | Reposicion de Suplementos y dieta
    |--------------------------------------------------------------------------
    */


    // Index 
    public function indexSoliciarSupDieta(){
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::count();

        $articulos = Articulo::where('id_categoria', '3')
                                  ->orderBy('stock', 'asc')
                                  ->with('reposiciones')
                                  ->get();
        $title = "Solicitar suplementos y dieta";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerSuplemYDieta.index', compact('title', 'articulos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaSupDieta(){
        $user = Auth::user();
        $artDeportivos = ReposicionMercaderia::where('id_categoria', '3')->with('articulos')->get();
        $reposicionesPendientes = ReposicionMercaderia::count();
        $title = "Admin - Aceptar o rechazar mercaderia";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.tabla', compact('title', 'artDeportivos','reposicionesPendientes'));
    }
    

    // Pagina para reponer por id
    public function solicitarMercaderia($id){
        $user = Auth::user();
        $artDeportivos = Articulo::findOrFail($id);
        $calzados = Calzado::all();
        $talles = Talle::all();
        $reposicionesPendientes = ReposicionMercaderia::count();

        $title = "Admin - ID Articulo Deportivo";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ID_Articulo', compact('title', 'artDeportivos','calzados','reposicionesPendientes'));
    }

    // Solicitud enviada a la Database
    public function enviarSolicitudReponerMercaderia(Request $request){

        $categoria = $request->input('id_categoria'); // categoria: 1 artDeport 2 ropDeport 3 supDeport
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
            'estado' => 'Pendiente',
            'id_categoria' => $categoria,
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
                            'valor_calzado_talle' => $valorCalzadoTalle,
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
        return redirect()->back()->with('success', 'Solicitud de reposición creada');


    }

    // Aceptar pedido
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

        return redirect()->back()->with('danger', 'Pedido cancelado');
    }

    // Una vez aceptado o rechazado, eliminar pedido
    public function eliminarPedido(Request $request, $id)
    {
        // Encuentra la relación pivot específica y actualiza el estado
        $artDeportivo = ReposicionMercaderia::find($id);
        $artDeportivo->delete(); 

        return redirect()->back()->with('danger', 'Pedido eliminado');
    }
    
}
