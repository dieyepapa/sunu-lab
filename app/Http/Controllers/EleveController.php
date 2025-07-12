<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Simulation;
use Illuminate\Http\Request;
use App\Models\Chapitre;

class EleveController extends Controller
{
    /**
     * Enregistrer un nouvel élève.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'classe_id' => 'required|exists:classes,id',
        ]);

        return Eleve::create($request->all());
    }
    public function dashboard()
    {
        $simulations = Simulation::all(); // récupère toutes les simulations
        return view('eleve', compact('simulations'));
    }
    
} 