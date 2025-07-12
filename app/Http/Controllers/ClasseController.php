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

public function store(Request $request) {
    $request->validate([
        'nom' => 'required',
        //'etablissement_id' => 'required|exists:etablissements,id',
    ]);
    return Classe::create($request->all());
}
}
