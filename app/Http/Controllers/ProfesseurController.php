<?php

namespace App\Http\Controllers;
use App\Models\Professeur;
use App\Models\Video;
use App\Models\QcmQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesseurController extends Controller
{
    public function store(Request $request) {
        $request->validate(['user_id' => 'required|exists:users,id']);
        return Professeur::create($request->all());
    }

    /**
     * Afficher le dashboard du professeur avec les vraies statistiques
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Statistiques réelles
        $stats = [
            'eleves_actifs' => User::where('status', 'eleve')->count(),
            'videos_publiees' => Video::where('user_id', $user->idUser)->count(),
            'qcm_crees' => QcmQuestion::where('professeur_id', $user->idUser)->count(),
            'simulations' => 8 // Nombre fixe de simulations disponibles
        ];

        // Ressources récentes
        $videos_recentes = Video::where('user_id', $user->idUser)
            ->latest()
            ->take(3)
            ->get();

        $qcm_recents = QcmQuestion::where('professeur_id', $user->idUser)
            ->latest()
            ->take(3)
            ->get();

        return view('professeur', compact('stats', 'videos_recentes', 'qcm_recents'));
    }
}
