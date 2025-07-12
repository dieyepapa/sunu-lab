<?php

namespace App\Http\Controllers;
use App\Models\simulation;
use App\Models\Chapitre;

use Illuminate\Http\Request;

class simulationController extends Controller
{
    public function store(Request $request) {
    $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'chapitre' => 'required',
        'date' => 'required|date',
        'type_simulation' => 'required|in:HTML5,UNITY,THREEJS',
        'contexte' => 'required|in:classe,maison',
        'professeur_id' => 'required|exists:professeurs,id',
        'classe_id' => 'required|exists:classes,id',
    ]);

    $simulation = Simulation::create($request->all());

    if ($simulation->contexte === 'maison') {
        // 💡 ici on ajoutera l'envoi de notification + lien meet plus tard
        $simulation->notification_envoyee = true;
        $simulation->save();
    }

    return $simulation;
}
// Afficher une simulation
    public function show($id) {
        $simulation = Simulation::findOrFail($id);
        return view('simulation', compact('simulation'));
    } 
 
    // Mettre à jour une simulation
    public function update(Request $request, $id)
    {
        $simulation = Simulation::find($id);

        if (!$simulation) {
            return response()->json(['message' => 'Simulation non trouvée'], 404);
        }

        $simulation->update($request->all());

        return response()->json([
            'message' => 'Simulation mise à jour avec succès',
            'data' => $simulation
        ]);
    }

    // Supprimer une simulation
    public function destroy($id)
    {
        $simulation = Simulation::find($id);

        if (!$simulation) {
            return response()->json(['message' => 'Simulation non trouvée'], 404);
        }

        $simulation->delete();

        return response()->json(['message' => 'Simulation supprimée avec succès']);
    }

    public function circulation()
    {
    return view('simulation', [
        'title' => 'Circulation sanguine',
        'simulationType' => 'circulation'
      ]);
    }

    public function digestionEnzymatique()
    {
       return view('digestion-enzymatique');
    }

     public function fecondation()
    {
       return view('cycle-fecondation');
    }
}
