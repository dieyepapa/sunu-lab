<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\QcmQuestion; // Added this import for QcmQuestion

class VideoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'video' => 'required|file|mimes:mp4,mov,avi,webm|max:524288' // 512MB max (nouvelle limite)
            ]);

            $file = $request->file('video');

            $user = Auth::user();
            if (!$user) {
                return redirect()->route('videos.index')->with('error', 'Utilisateur non authentifié.');
            }

            $path = $file->store('videos', 'public');

            Video::create([
                'user_id' => $user->idUser ?? $user->id ?? null,
                'title' => $file->getClientOriginalName(),
                'file_path' => $path
            ]);

            return redirect()->route('videos.index')
                   ->with('success', 'Vidéo publiée avec succès!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                   ->withErrors($e->errors())
                   ->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la publication de la vidéo', ['exception' => $e]);
            return redirect()->back()
                   ->with('error', 'Erreur lors de la publication de la vidéo. Veuillez réessayer.');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $videos = Video::where('user_id', $user->idUser)->latest()->get();
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
        
        // Nombre de QCM créés par ce professeur
        $qcmCount = QcmQuestion::where('professeur_id', $user->idUser)->count();
        
        // Nombre de simulations disponibles
        $simulationsCount = 8;
        
        return response()->json([
            'videos_publiees' => $videosCount,
            'eleves_actifs' => $elevesActifs,
            'qcm_crees' => $qcmCount,
            'simulations' => $simulationsCount
        ]);
    }
}