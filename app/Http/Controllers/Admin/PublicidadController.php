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
        return (!Auth::user()->administrator) ? redirect()->route('pagina_inicio') : view('admin.articulosDeportivos.publicidad', compact('publicidades'));
    }

    public function mostrarPublicidades()
    {
        // Obtener todas las publicidades
        $publicidades = Publicidad::all();

        // Cargar la vista donde se mostrarán las publicidades
        return view('index', compact('publicidades')); // Asegúrate de que la ruta sea la correcta
    }


    // public function subir(Request $request)
    // {
    //     // Validar que el archivo sea una imagen
    //     $request->validate([
    //         'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Obtener el archivo de la imagen
    //     $file = $request->file('imagen');

    //     // Definir la carpeta de destino
    //     $carpetaDestino = storage_path('/publicidades');

    //     // Obtener el nombre original del archivo
    //     $filename = $file->getClientOriginalName();

    //     // Mover el archivo a la carpeta de destino
    //     $uploadSuccess = $request->file('imagen')->move($carpetaDestino, $file->getClientOriginalName());

    //     // Verificar si el archivo se subió correctamente
    //     if (!$uploadSuccess) {
    //         return back()->with('error', 'Error al subir la imagen');
    //     }

    //     // Crear una nueva entrada en la base de datos
    //     $publicidad = new Publicidad();
    //     $publicidad->ruta = $filename; // Almacenar solo la ruta relativa
    //     $publicidad->save();

    //     // Mensaje de actualización exitosa
    //     Session::flash('mensaje', true);

    //     return redirect()->route('index.publicidad')->with('success', 'Publicidad subida correctamente');
    // }
    // public function subir(Request $request)
    // {
    //     $request->validate([
    //         'imagen' => 'required|image'
    //     ]);

    //     // Almacenar la imagen en una carpeta específica
    //     $rutaImagen = $request->file('foto')->store('/publicidades');

    //     // Guardar la ruta en la base de datos (sin la parte "public/")
    //     $publicidad = new Publicidad();
    //     $publicidad->foto = basename($rutaImagen);
    //     $publicidad->save();

    //     return redirect()->route('index.publicidad');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'required|url',
        ]);


        // Path para guardar la imagen en storage
        $filename = null; // Inicializa la variable para el nombre del archivo
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $carpetaDestino = storage_path('publicidades');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($carpetaDestino, $file->getClientOriginalName());


            // Verifica si la imagen se subió correctamente
            if (!$uploadSuccess) {
                return back()->with('error', 'Error al subir la imagen');
            }
        }


        // Crear nueva entrada en la base de datos
        $publicidadNueva = new Publicidad();
        $publicidadNueva->nombre = $request->titulo; // Asigna el título al campo 'nombre'
        $publicidadNueva->foto = $filename; // Asigna la ruta de la imagen
        $publicidadNueva->url = $request->url; // Asigna la URL
        $publicidadNueva->save(); // Guarda la publicidad en la base de datos

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
