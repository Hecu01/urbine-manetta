<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function tarea(){
        return view ('tarea');
    }
    
    public function calendario(){
        return view ('calendario/calendario');
    }

    public function carreras(){
        return view ('carreras/carreras');
    }

    public function logistica(){
        return view ('carreras/logistica');
    }

    public function seguridad_higiene(){
        return view ('carreras/syh');
    }

    public function mantenimiento(){
        return view ('carreras/mantenimiento');
    }

    public function administracion(){
        return view ('carreras/administracion');
    }

    public function analista_sistemas(){
        return view ('carreras/analista');
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
