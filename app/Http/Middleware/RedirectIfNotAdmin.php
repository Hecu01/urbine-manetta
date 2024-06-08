<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            return redirect('/mi-primer-registro'); // Reemplaza '/ruta-de-redireccionamiento' con la ruta que desees.
        }

        return $next($request);
    }
}
