<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarTokenUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Si tiene una cookie con el token, lo dejamos pasar
        if ($request->cookie('tokenUsuarioCodeLink')) {
            return $next($request);
        }
        // Si no tiene una cookie con el token, lo redirigimos al login
        return redirect('/');

    }
}
