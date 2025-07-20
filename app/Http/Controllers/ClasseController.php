<?php

namespace App\Http\Controllers;
use App\Models\Classe;

use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all(); // Récupère toutes les classes directement
        return view('listes-classes', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        
        Classe::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès!');
    }

    public function show(Classe $classe)
    {
        return view('classes.show', compact('classe'));
    }

    public function edit(Classe $classe)
    {
        return view('classes.edit', compact('classe'));
    }

    public function update(Request $request, Classe $classe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        
        $classe->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès!');
    }

    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classes.index')->with('success', 'Classe supprimée avec succès!');
    }
}
