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

        // Guardar la imagen en la carpeta 'publicidades' dentro de 'storage/app/public'
        if ($request->hasFile('foto')) {
            // Almacenar la imagen y obtener la ruta relativa
            $rutaImagen = $request->file('foto')->store('publicidades', 'public');

            // Crear nueva entrada en la base de datos
            $publicidadNueva = new Publicidad();
            $publicidadNueva->nombre = $request->titulo; // Asigna el título al campo 'nombre'
            $publicidadNueva->foto = $rutaImagen; // Almacena la ruta de la imagen en el campo 'foto'
            $publicidadNueva->url = $request->url; // Asigna la URL
            $publicidadNueva->save(); // Guarda la publicidad en la base de datos

            // Mensaje de éxito
            Session::flash('mensaje', 'Publicidad creada exitosamente.');
            return redirect()->route('publicidad.index');
        }

        // Mensaje de error si no se subió la imagen
        return back()->with('error', 'Error al subir la imagen.');
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
