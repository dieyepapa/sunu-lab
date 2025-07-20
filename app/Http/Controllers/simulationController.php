<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function index()
    {
        $simulations = Simulation::where('professeur_id', Auth::id())->get();
        return view('simulations.index', compact('simulations'));
    }

    public function create()
    {
        return view('simulations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:biologie,geologie,ecologie,genetique',
            'difficulte' => 'required|string|in:facile,moyen,difficile',
            'instructions' => 'required|string',
        ]);

        $simulation = Simulation::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'type' => $request->type,
            'difficulte' => $request->difficulte,
            'instructions' => $request->instructions,
            'professeur_id' => Auth::id(),
            'statut' => 'active'
        ]);

        return redirect()->route('simulations.index')->with('success', 'Simulation créée avec succès!');
    }

    public function show(Simulation $simulation)
    {
        return view('simulations.show', compact('simulation'));
    }

    public function edit(Simulation $simulation)
    {
        return view('simulations.edit', compact('simulation'));
    }

    public function update(Request $request, Simulation $simulation)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:biologie,geologie,ecologie,genetique',
            'difficulte' => 'required|string|in:facile,moyen,difficile',
            'instructions' => 'required|string',
        ]);

        $simulation->update($request->all());

        return redirect()->route('simulations.index')->with('success', 'Simulation mise à jour avec succès!');
    }

    public function destroy(Simulation $simulation)
    {
        $simulation->delete();
        return redirect()->route('simulations.index')->with('success', 'Simulation supprimée avec succès!');
    }

    public function execute(Simulation $simulation)
    {
        return view('simulations.execute', compact('simulation'));
    }

    public function executeThreeJS($type = 'default')
    {
        return view('simulations.threejs', compact('type'));
    }

    /**
     * Simulation de digestion enzymatique
     */
    public function digestionEnzymatique()
    {
        return view('digestion-enzymatique');
    }

    /**
     * Simulation de circulation sanguine
     */
    public function circulation()
    {
        return view('circulation-sanguin');
    }

    /**
     * Simulation de cycle de fécondation
     */
    public function fecondation()
    {
        return view('cycle-fecondation');
    }
}
