<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsProfMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->roles()->where('name','prof')->exists() or $request->user()->roles()->where('name','root')->exists()) 
            return $next($request);
        
        abort(403,"Desole vous n'avez pas acès a cette page");
    }
}
