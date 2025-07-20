<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $status
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $status)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $user = Auth::user();
        
        // Vérifier le status de l'utilisateur
        if ($user->status !== $status) {
            // Rediriger vers la page appropriée selon le status
            switch ($user->status) {
                case 'eleve':
                    return redirect()->route('eleve.dashboard')->with('error', 'Accès non autorisé. Vous êtes connecté en tant qu\'élève.');
                case 'professeur':
                    return redirect()->route('professeur.dashboard')->with('error', 'Accès non autorisé. Vous êtes connecté en tant que professeur.');
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Accès non autorisé. Vous êtes connecté en tant qu\'administrateur.');
                default:
                    return redirect()->route('login')->with('error', 'Status utilisateur non reconnu.');
            }
        }

        return $next($request);
    }
} 