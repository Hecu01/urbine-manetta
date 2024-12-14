<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Publicidad;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PublicidadController extends Controller
{
    // Mostrar la lista de publicidades
    public function index()
    {
        // Obtener todas las publicidades de la base de datos
        $publicidades = Publicidad::all();

        // Cambia la ruta de la vista a la carpeta correcta
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.publicidad.index', compact('publicidades'));
    }

    public function mostrarPublicidades()
    {
        // Obtener todas las publicidades
        $publicidades = Publicidad::all();

        // Cargar la vista donde se mostrarán las publicidades
        return view('index', compact('publicidades')); // Asegúrate de que la ruta sea la correcta
    }

    public function store(Request $request)
{
    // Validar la entrada
    $request->validate([
        'titulo' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'url' => 'required|url',
    ]);

    // Crear nueva entrada de publicidad
    $publicidadNueva = Publicidad::create([
        'nombre' => $request->titulo, // Asigna el título al campo 'nombre'
        'url' => $request->url,       // Asigna la URL
        'foto' => $request->foto,
    ]);

    // Verificar y guardar la foto si está presente
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension(); // Nombre único

        // Guardar la imagen en la carpeta public/publicidades
        $carpetaDestino = public_path('publicidades'); // Carpeta en public/
        
        // Crear la carpeta si no existe
        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0755, true);
        }

        // Mover la imagen a la carpeta de destino
        $file->move($carpetaDestino, $filename);

        // Guardar la ruta de la imagen en el modelo
        $publicidadNueva->foto = 'publicidades/' . $filename; // Guardamos la ruta relativa
        $publicidadNueva->save();
    }

    // Mensaje de éxito
    Session::flash('mensaje', 'Publicidad creada exitosamente.');
    return redirect()->route('publicidad.index');
}




    public function destroy($id)
    {
        // Busca la publicidad por su ID
        $publicidad = Publicidad::find($id);

        // Verifica si la publicidad existe
        if ($publicidad) {
            // Elimina la publicidad
            $publicidad->delete();

            // Redirecciona con un mensaje de éxito
            return redirect()->route('publicidad.index')->with('eliminado', 'Publicidad eliminada con éxito.');
        }

        // Si no se encuentra, redirige con un mensaje de error
        return redirect()->route('publicidad.index')->with('error', 'Publicidad no encontrada.');
    }
}
