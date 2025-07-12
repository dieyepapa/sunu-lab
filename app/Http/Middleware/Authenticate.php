<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Ajouter un message pour informer l'utilisateur
            session()->flash('error', 'Vous devez être connecté pour accéder à cette page.');
            return route('labo'); // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
        }
    }
}