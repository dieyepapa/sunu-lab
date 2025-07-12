<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'video' => 'required|file|mimes:mp4,mov,avi,webm|max:2048' // 2MB max (limite actuelle)
            ]);

            $file = $request->file('video');
            
            // Vérification supplémentaire de la taille
            if ($file->getSize() > 2 * 1024 * 1024) {
                return redirect()->back()
                    ->with('error', 'Le fichier est trop volumineux. Taille maximale : 2MB (limite serveur actuelle)');
            }

            $path = $file->store('videos', 'public');
            
            Video::create([
                'user_id' => Auth::id(),
                'title' => $file->getClientOriginalName(),
                'file_path' => $path
            ]);

            return redirect()->route('professeur.dashboard')
                   ->with('success', 'Vidéo publiée avec succès!');
                   
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                   ->withErrors($e->errors())
                   ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                   ->with('error', 'Erreur lors de la publication de la vidéo. Veuillez réessayer.');
        }
    }

    public function index()
    {
        $videos = Video::where('user_id', Auth::id())->latest()->get();
        return view('video', compact('videos'));
    }

    // Méthode pour obtenir les statistiques du professeur
    public function getStats()
    {
        $user = Auth::user();
        
        // Nombre de vidéos publiées par ce professeur
        $videosCount = Video::where('user_id', $user->idUser)->count();
        
        // Nombre d'élèves actifs (utilisateurs avec status 'eleve')
        $elevesActifs = User::where('status', 'eleve')->count();
        
        return response()->json([
            'videos_publiees' => $videosCount,
            'eleves_actifs' => $elevesActifs
        ]);
    }
}