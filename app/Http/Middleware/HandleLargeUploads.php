<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleLargeUploads
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si la requête contient des fichiers
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            
            // Vérifier si le fichier a été uploadé avec succès
            if (!$file->isValid()) {
                $errorMessage = $this->getUploadErrorMessage($file->getError());
                return redirect()->back()
                    ->with('error', $errorMessage);
            }
            
            // Vérifier la taille du fichier (512MB max)
            if ($file->getSize() > 512 * 1024 * 1024) {
                return redirect()->back()
                    ->with('error', 'Le fichier est trop volumineux. Taille maximale : 512MB (limite serveur actuelle). Veuillez réduire la taille de votre vidéo ou contacter l\'administrateur pour augmenter les limites.');
            }
            
            // Vérifier le type MIME
            $allowedMimes = ['video/mp4', 'video/mov', 'video/avi', 'video/webm'];
            if (!in_array($file->getMimeType(), $allowedMimes)) {
                return redirect()->back()
                    ->with('error', 'Type de fichier non autorisé. Formats acceptés : MP4, MOV, AVI, WEBM.');
            }
        }
        
        return $next($request);
    }
    
    /**
     * Obtenir le message d'erreur d'upload
     */
    private function getUploadErrorMessage($errorCode): string
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'Le fichier dépasse la limite upload_max_filesize du serveur (actuellement 512MB). Veuillez réduire la taille de votre vidéo.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Le fichier dépasse la limite post_max_size du serveur (actuellement 8MB). Veuillez réduire la taille de votre vidéo.';
            case UPLOAD_ERR_PARTIAL:
                return 'Le fichier n\'a été que partiellement uploadé. Veuillez réessayer.';
            case UPLOAD_ERR_NO_FILE:
                return 'Aucun fichier n\'a été sélectionné.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Erreur serveur : répertoire temporaire manquant.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Erreur serveur : impossible d\'écrire le fichier.';
            case UPLOAD_ERR_EXTENSION:
                return 'Erreur serveur : extension PHP bloquée.';
            default:
                return 'Erreur d\'upload inconnue. Veuillez réessayer.';
        }
    }
} 