<?php

namespace App\Http\Controllers;

use App\Models\QcmQuestion;
use App\Models\QcmResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QcmController extends Controller
{
    /**
     * Afficher la liste des QCM pour le professeur
     */
    public function index()
    {
        $questions = QcmQuestion::where('professeur_id', Auth::id())
            ->with('resultats')
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistiques
        $stats = [
            'total_questions' => $questions->count(),
            'questions_actives' => $questions->where('actif', true)->count(),
            'total_reponses' => $questions->sum(function($q) { return $q->resultats->count(); }),
            'taux_reussite' => $this->calculerTauxReussite($questions)
        ];

        return view('qcm.index', compact('questions', 'stats'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('qcm.create');
    }

    /**
     * Créer une nouvelle question QCM
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'bonne_reponse' => 'required|in:A,B,C,D',
            'matiere' => 'required|string',
            'niveau' => 'required|in:facile,moyen,difficile',
            'explication' => 'nullable|string'
        ]);

        $options = [
            'A' => $request->option_a,
            'B' => $request->option_b,
            'C' => $request->option_c,
            'D' => $request->option_d
        ];

        QcmQuestion::create([
            'titre' => $request->titre,
            'question' => $request->question,
            'options' => $options,
            'bonne_reponse' => $request->bonne_reponse,
            'matiere' => $request->matiere,
            'niveau' => $request->niveau,
            'explication' => $request->explication,
            'professeur_id' => Auth::id()
        ]);

        return redirect()->route('qcm.index')->with('success', 'Question QCM créée avec succès !');
    }

    /**
     * Afficher une question spécifique
     */
    public function show(QcmQuestion $qcmQuestion)
    {
        $resultats = $qcmQuestion->resultats()->with('eleve')->get();
        
        $stats = [
            'total_reponses' => $resultats->count(),
            'reponses_correctes' => $resultats->where('correcte', true)->count(),
            'taux_reussite' => $resultats->count() > 0 ? 
                round(($resultats->where('correcte', true)->count() / $resultats->count()) * 100, 2) : 0
        ];

        return view('qcm.show', compact('qcmQuestion', 'resultats', 'stats'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(QcmQuestion $qcmQuestion)
    {
        return view('qcm.edit', compact('qcmQuestion'));
    }

    /**
     * Mettre à jour une question
     */
    public function update(Request $request, QcmQuestion $qcmQuestion)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'bonne_reponse' => 'required|in:A,B,C,D',
            'matiere' => 'required|string',
            'niveau' => 'required|in:facile,moyen,difficile',
            'explication' => 'nullable|string'
        ]);

        $options = [
            'A' => $request->option_a,
            'B' => $request->option_b,
            'C' => $request->option_c,
            'D' => $request->option_d
        ];

        $qcmQuestion->update([
            'titre' => $request->titre,
            'question' => $request->question,
            'options' => $options,
            'bonne_reponse' => $request->bonne_reponse,
            'matiere' => $request->matiere,
            'niveau' => $request->niveau,
            'explication' => $request->explication
        ]);

        return redirect()->route('qcm.index')->with('success', 'Question QCM mise à jour avec succès !');
    }

    /**
     * Supprimer une question
     */
    public function destroy(QcmQuestion $qcmQuestion)
    {
        $qcmQuestion->delete();
        return redirect()->route('qcm.index')->with('success', 'Question QCM supprimée avec succès !');
    }

    /**
     * Soumettre une réponse d'élève
     */
    public function submitAnswer(Request $request, QcmQuestion $qcmQuestion)
    {
        $request->validate([
            'reponse' => 'required|in:A,B,C,D',
            'temps_reponse' => 'nullable|integer'
        ]);

        $correcte = $request->reponse === $qcmQuestion->bonne_reponse;

        QcmResult::create([
            'eleve_id' => Auth::id(),
            'question_id' => $qcmQuestion->id,
            'reponse_eleve' => $request->reponse,
            'correcte' => $correcte,
            'temps_reponse' => $request->temps_reponse,
            'date_reponse' => now()
        ]);

        return response()->json([
            'correcte' => $correcte,
            'bonne_reponse' => $qcmQuestion->bonne_reponse,
            'explication' => $qcmQuestion->explication
        ]);
    }

    /**
     * Afficher les statistiques globales
     */
    public function stats()
    {
        $questions = QcmQuestion::where('professeur_id', Auth::id())->with('resultats')->get();
        
        $stats = [
            'total_questions' => $questions->count(),
            'total_reponses' => $questions->sum(function($q) { return $q->resultats->count(); }),
            'taux_reussite_global' => $this->calculerTauxReussite($questions),
            'par_matiere' => $this->statsParMatiere($questions),
            'par_niveau' => $this->statsParNiveau($questions)
        ];

        return view('qcm.stats', compact('stats'));
    }

    /**
     * Calculer le taux de réussite
     */
    private function calculerTauxReussite($questions)
    {
        $totalReponses = $questions->sum(function($q) { return $q->resultats->count(); });
        $reponsesCorrectes = $questions->sum(function($q) { return $q->resultats->where('correcte', true)->count(); });
        
        return $totalReponses > 0 ? round(($reponsesCorrectes / $totalReponses) * 100, 2) : 0;
    }

    /**
     * Statistiques par matière
     */
    private function statsParMatiere($questions)
    {
        $stats = [];
        foreach ($questions as $question) {
            if (!isset($stats[$question->matiere])) {
                $stats[$question->matiere] = [
                    'total' => 0,
                    'correctes' => 0
                ];
            }
            $stats[$question->matiere]['total'] += $question->resultats->count();
            $stats[$question->matiere]['correctes'] += $question->resultats->where('correcte', true)->count();
        }

        foreach ($stats as $matiere => $data) {
            $stats[$matiere]['taux'] = $data['total'] > 0 ? 
                round(($data['correctes'] / $data['total']) * 100, 2) : 0;
        }

        return $stats;
    }

    /**
     * Statistiques par niveau
     */
    private function statsParNiveau($questions)
    {
        $stats = [];
        foreach ($questions as $question) {
            if (!isset($stats[$question->niveau])) {
                $stats[$question->niveau] = [
                    'total' => 0,
                    'correctes' => 0
                ];
            }
            $stats[$question->niveau]['total'] += $question->resultats->count();
            $stats[$question->niveau]['correctes'] += $question->resultats->where('correcte', true)->count();
        }

        foreach ($stats as $niveau => $data) {
            $stats[$niveau]['taux'] = $data['total'] > 0 ? 
                round(($data['correctes'] / $data['total']) * 100, 2) : 0;
        }

        return $stats;
    }
}
