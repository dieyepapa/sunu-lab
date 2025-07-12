<?php

namespace App\Http\Controllers;
use App\Models\Professeur;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function store(Request $request) {
    $request->validate(['user_id' => 'required|exists:users,id']);
    return Professeur::create($request->all());
}
}
