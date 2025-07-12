<?php

namespace App\Http\Controllers;
use App\Models\Etablissement;

use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    public function store(Request $request) {
    $request->validate([
        'nom' => 'required',
        'adresse' => 'required',
    ]);
    return Etablissement::create($request->all());
}
}
