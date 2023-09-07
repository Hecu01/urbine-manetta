<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tiendaController extends Controller
{
    public function home(){
        $title = "Tienda - Inicio";
        return view('index', compact('title'));
    }
    public function admin(){
        $title = "Tienda - Admin";
        return view('admin.admin', compact('title'));
    }
}
