<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Deporte;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Compartir la variable $allDeportes con todas las vistas
        View::composer('*', function ($view) {
            $allDeportes = Deporte::pluck('deporte')->unique()->sort();
            $view->with('allDeportes', $allDeportes);
        });
    }

    public function register()
    {
        //
    }
}
