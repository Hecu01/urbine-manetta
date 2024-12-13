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
    public function index()
    {
        $user = Auth::user();
        $title = "Admin - Mercadería";
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();
        $repPendArtDeport = ReposicionMercaderia::where('id_categoria', '1')->count();
        $repPendRopas = ReposicionMercaderia::where('id_categoria', '2')->count();
        $repPendSupDiet = ReposicionMercaderia::where('id_categoria', '3')->count();
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.index', compact('title', 'reposicionesPendientes', 'repPendArtDeport', 'repPendSupDiet', 'repPendRopas'));
    }

    /*
    |--------------------------------------------------------------------------
    | Reposicion de Articulos deportivos
    |--------------------------------------------------------------------------
    */

    // Index 
    public function indexSoliciarArtDeport()
    {
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();

        $artDeportivos = Articulo::where('id_categoria', '1')->orderBy('stock', 'asc')->with('reposiciones')->get();
        $title = "Solicitar articulos deportivos";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.index', compact('title', 'artDeportivos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaArticulosDeportivos()
    {
        $user = Auth::user();
        $reposiciones = ReposicionMercaderia::where('id_categoria', '1')
            ->with('articulos.calzados')
            ->orderBy('id', 'desc')
            ->get();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();
        $title = "Tabla reposicion de ropas deportivas";

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerArtDeportivos.tabla', compact('title', 'reposiciones', 'reposicionesPendientes'));
    }


    /*
    |--------------------------------------------------------------------------
    | Reposicion de Ropas deportivas
    |--------------------------------------------------------------------------
    */


    // Index 
    public function indexSoliciarRopDeport()
    {
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();

        $articulos = Articulo::where('id_categoria', '2')->orderBy('stock', 'asc')->with('reposiciones')->get();
        $title = "Solicitar ropas deportivas";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerRopaDeportiva.index', compact('title', 'articulos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaRopasDeportivas()
    {
        $user = Auth::user();
        $reposiciones = ReposicionMercaderia::where('id_categoria', '2')
                                            ->with('articulos.talles')  
                                            ->with('articulos.fotos')
                                            ->get();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();
        $title = "Tabla reposicion de ropas deportivas";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerRopaDeportiva.tabla', compact('title', 'reposiciones', 'reposicionesPendientes'));
    }


    /*
    |--------------------------------------------------------------------------
    | Reposicion de Suplementos y dieta
    |--------------------------------------------------------------------------
    */


    // Index 
    public function indexSoliciarSupDieta()
    {
        $user = Auth::user();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();

        $articulos = Articulo::where('id_categoria', '3')
            ->orderBy('stock', 'asc')
            ->with('reposiciones')
            ->get();
        $title = "Solicitar suplementos y dieta";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerSuplemYDieta.index', compact('title', 'articulos', 'reposicionesPendientes'));
    }

    // Tabla 
    public function tablaSupDieta()
    {
        $user = Auth::user();
        $artDeportivos = ReposicionMercaderia::where('id_categoria', '3')->with('articulos')->get();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->where('id_categoria', 3)->count();
        $title = "Tabla reposicion de Suplementos y dieta";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ReponerSuplemYDieta.tabla', compact('title', 'artDeportivos', 'reposicionesPendientes'));
    }

   /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    */


    // Pagina verificar unidades llegadas 
    public function paginaVerificacion($id)
    {
        $user = Auth::user();

        $reposicionesPendientes = ReposicionMercaderia::all()->count();

        $reposicion = ReposicionMercaderia::findOrFail($id);

        $title = "Verificar reposicion";

        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.verificar', compact('title' , 'reposicion', 'reposicionesPendientes'));
    }


    // Pagina para solicitar mercadería
    public function solicitarMercaderia($id)
    {
        $user = Auth::user();
        $articulos = Articulo::findOrFail($id);
        $calzados = Calzado::all();
        $talles = Talle::all();
        $reposicionesPendientes = ReposicionMercaderia::where('estado', 'Pendiente')->count();

        $title = "ID reposicion mercaderia";
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ID_Articulo', compact('title', 'articulos', 'calzados', 'reposicionesPendientes', 'talles'));
    }

    

    // Solicitud POST enviada a la Database
    public function enviarSolicitudReponerMercaderia(Request $request)
    {

        /* Categoría importante si es: 1 (articulo deportivo) y calzado // 2 (ropa deportiva, puramente con relacion)
           // 3 (suplementos y dieta), sin relacion */
        $categoria = $request->input('id_categoria'); 
        
        // Unidades a reponer (sin relacion)
        $unidades = $request->input('unidades_reposicion'); 
        
        // Importante, si es calzado más que nada (hay relacion)
        $tipo_producto = $request->input('tipo_producto');
        
        // Id del producto a reponer 
        $id_articulo = $request->input('id_articulo'); 

        // Booleano para reposición de articulos con relacion
        $relacionMuchos = $request->input('muchos_a_muchos_bool'); 
        
        // Stock para reponer cada talle o calzado
        $stockMuchos = $request->input('stock_solicitado_muchos_a_muchos');

        // Respectivos ids de los talles a reponer
        $idMuchos = $request->input('art_id_muchos_a_muchos');

        // Respectivo valor de los talles a reponer (XL, XXL, 38, 40, etc)
        $valorCalzadoTalles = $request->input('valorCalzadoTalle');


        // Creamos la nueva reposicion, agregamos estado pendiente
        $reposicion = ReposicionMercaderia::create([
            'estado' => 'Pendiente',
            'id_categoria' => $categoria,
        ]);


        // Si tiene relación, entra al bloque de código (si es false, se ahorra mucho código)
        if ($relacionMuchos == 'true') {

            // Dar la cantidad de vueltas necesarias (se usó $idMuchos, podía haber sido $valorCalzadoTalles)
            foreach ($idMuchos as $indice => $idMucho) {

                // Stock a reponer por cada talle/calzado
                $stock = $stockMuchos[$indice];

                // Carga el valor del talle/calzado
                $valorCalzadoTalle = $valorCalzadoTalles[$indice];


                // Verificamos si se solicito stock -si se envió un 0 lo ignora. Simple.       
                if ($stock > 0) {

                    // ¿Es calzado? Sí => entra; No => va al 'else';
                    if ($tipo_producto == "calzado") {

                        // Carga el id de cada calzado
                        $idCalzado = $idMuchos[$indice];

                        $reposicion->articulos()->attach($id_articulo, [
                            'cantidad' => $stock,
                            'calzado_id' => $idCalzado,  
                            'valor_calzado_talle' => $valorCalzadoTalle,
                            'unidades_aceptadas' => 0,
                        ]);


                    } else {

                        // Carga el id de cada talle
                        $idRopa = $idMuchos[$indice];

                        $reposicion->articulos()->attach($id_articulo, [
                            'cantidad' => $stock,
                            'talla_id' => $idRopa, 
                            'valor_calzado_talle' => $valorCalzadoTalle,
                            'unidades_aceptadas' => 0,
                        ]);

                    }
                }
            }

        } else {

            // Por aca si no tiene relacion
            $reposicion->articulos()->attach($id_articulo, [ 
                'cantidad' => $unidades,
                'unidades_aceptadas' => 0
            ]);


        }
        return redirect()->back()->with('success', 'Solicitud de reposición creada');
    }

    // Aceptar pedido
    public function aceptarPedido(Request $request, $id)
    {
        $artDeportivo = ReposicionMercaderia::with(['articulos.calzados', 'articulos.talles'])->find($id);
        
        // Validar para evitar que la profe lo rompa
        // $request->validate([
        //     'cantidadLlegada.*' => [
        //         'required', 
        //         'integer', 
        //         'min:0', 
        //         'max:' . $artDeportivo->pivot->cantidad
        //     ],
        // ]);

        // Verifica si tiene relacion (si es ropa o calzado)
        $tipoProducto= $request->input('tipo_producto'); 

        // Array de la cantidad recibida 
        $cantidadRecibida = $request->input('cantidadRecibida', []); 

        // La cantidad recibida pasa a ser int
        $cantidadRecibida2 = array_map('intval', $cantidadRecibida); // Los datos pasan a ser int

        // Sumatoria del array 
        $totalRecibidas = array_sum($cantidadRecibida2); // Calcular la suma total
        
        // Unidades aceptadas (cuando no tiene relacion)
        $unidadesAceptadas = $request->input('unidades_aceptadas', 0);
        // dd($unidadesAceptadas);
        // $stockIncrementArray = []; No se usa más, $totalRecibidas ocupará su lugar        
        // $talleStockIncrementArray = []; Tampoco se usa más, array $cantidadRecibida toma su lugar
        

        // Recorremos los talles solicitados (si no tiene relacion, dará una sola vuelta)
        foreach ($artDeportivo->articulos as $index => $articulo) {

            // Pregunta ¿El articulo tiene relacion?
            if ($tipoProducto == 'ropa' || $tipoProducto == 'calzado') {

                $tallaIdArray[] = intval($articulo->pivot->talla_id);

                $calzadoIdArray[] = intval($articulo->pivot->calzado_id);
                
                $articulo->pivot->unidades_aceptadas = $cantidadRecibida[$index];
                
                $articulo->stock += $totalRecibidas; 
            } else {

                // Sumar las unidades aceptadas al stock
                $articulo->stock += intval($unidadesAceptadas);
                DB::table('articulo_reposicion_mercaderia')
                    ->where('reposicion_mercaderia_id', $artDeportivo->id)
                    ->increment('unidades_aceptadas', intval($unidadesAceptadas));
            }

            $articulo->save();

    
        }

        // Incrementar stock de calzados o tallas ropa
        if ($tipoProducto == 'ropa' || $tipoProducto == 'calzado') {

            // Filtro entre ropa y calzado
            if ($articulo->id_categoria == 1) {

                foreach ($calzadoIdArray as $index => $calzadoId) {
                    // Actualizar en la tabla pivot de articulo_talle
                    DB::table('articulo_calzado')
                        ->where('calzado_id', $calzadoId)
                        ->increment('stocks', $cantidadRecibida[$index]);
                    
                    // Actualizar en articulo_reposicion_mercaderia
                    DB::table('articulo_reposicion_mercaderia')
                        ->where('calzado_id', $calzadoId)
                        ->where('reposicion_mercaderia_id', $artDeportivo->id)
                        ->increment('unidades_aceptadas', $cantidadRecibida[$index]);
                }
            } else {

                foreach ($tallaIdArray as $index => $tallaId) {

                    // Actualizar en la tabla pivot de articulo_talle
                    DB::table('articulo_talle')
                        ->where('talle_id', $tallaId)
                        ->increment('stocks', $cantidadRecibida[$index]);
                    
                    // Actualizar en articulo_reposicion_mercaderia
                    DB::table('articulo_reposicion_mercaderia')
                        ->where('talla_id', $tallaId)
                        ->where('reposicion_mercaderia_id', $artDeportivo->id)
                        ->increment('unidades_aceptadas', $cantidadRecibida[$index]);
                }

            }
        }

        $artDeportivo->estado = 'Finalizado';
        $artDeportivo->save();

        switch ($articulo->id_categoria) {
            case 1:
                return redirect()->route('tablaArticulosDeportivos')->with('success', 'Pedido aceptado y stock actualizado correctamente.');
                break;
            case 2:
                return redirect()->route('tablaRopasDeportivas')->with('success', 'Pedido aceptado y stock actualizado correctamente.');
                break;
            case 3:
                return redirect()->route('tablaSupDieta')->with('success', 'Pedido aceptado y stock actualizado correctamente.');
                break;
            
            default:
        }
    
    }

    // Visualizar las unidades aceptadas
    // public function mostrarUnidadesAceptadas($articuloId)
    // {
    //     // Obtener el registro de la tabla pivote para el artículo específico
    //     $articulo = ReposicionMercaderia::with(['articulos' => function ($query) use ($articuloId) {
    //         $query->where('articulos.id', $articuloId);
    //     }])->first();

    //     // Obtener el valor de unidades_aceptadas desde la relación pivote
    //     $unidadesAceptadas = $articulo->articulos->first()->pivot->unidades_aceptadas ?? 'No disponible';

    //     // Pasar los datos a la vista
    //     return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.reponerMercaderia.ID_Articulo', compact('unidadesAceptadas', 'articuloId'));
    // }

    public function mostrarUnidadesAceptadas($articuloId)
    {
        $reposicion = ReposicionMercaderia::find($articuloId); // o cualquier método de consulta que utilices

        // Pasar los datos a la vista
        return view('admin.reponerMercaderia.ReponerArtDeportivos.mostrarUnidadesAceptadas', compact('reposicion'));
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
