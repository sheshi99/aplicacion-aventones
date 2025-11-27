<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $rol
     * @return \Symfony\Component\HttpFoundation\Response
     */
    
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        // Verifica si hay sesión
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Verifica rol
        if (Auth::user()->rol !== $rol) {
            return redirect('/')->with('error', 'No tiene permiso para acceder.');
        }

        return $next($request);
    }
}
