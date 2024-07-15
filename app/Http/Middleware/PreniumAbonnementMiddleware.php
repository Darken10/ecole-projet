<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreniumAbonnementMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->payment()->where('montant','>',150)->exists()) 
            return $next($request);
        
        abort(403,"Il vous faut un Abonement Prenium pour acceder a cette fonctionnaliter");
    }
}
