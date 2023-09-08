<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class tiendaController extends Controller
{
    public function home(){
        $title = "Tienda - Inicio";
        return view('index', compact('title'));
    }
    public function admin(){
        $user = Auth::user();
        // Si no es admin, volvé a casa che.
        if (!Auth::check() || !Auth::user()->administrator) {
            return redirect()->route('pagina_inicio'); 
        }
        $title = "Tienda - Admin";
        return view('admin.admin', compact('title'));
    }
}
