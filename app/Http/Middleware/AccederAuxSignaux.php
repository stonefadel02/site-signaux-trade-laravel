<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AccederAuxSignaux
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (auth()->user() && !auth()->user()->hasAccessToSignals())) {
            return redirect()->route('mon-abonnement')->with('error', 'Vous n\'avez pas accès aux signaux.');
        }
        // Si l'utilisateur a accès, continuer la requête
        // Log::info('Accès aux signaux autorisé pour l\'utilisateur : ' . auth()->user()->id);
        return $next($request);
    }
}
