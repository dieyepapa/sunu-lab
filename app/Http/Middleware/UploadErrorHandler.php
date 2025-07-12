<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadErrorHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Vérifier s'il y a des erreurs d'upload dans la session
        if (session()->has('upload_error')) {
            // Ajouter l'erreur aux erreurs de validation
            $errors = session()->get('errors', new \Illuminate\Support\ViewErrorBag);
            $errors->add('video', session()->get('upload_error'));
            session()->forget('upload_error');
        }
        
        return $response;
    }
} 