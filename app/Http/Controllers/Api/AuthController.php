<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|in:eleve,professeur',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Utilisateur enregistré avec succès'], 201);
    }

    public function showLoginForm()
    {
        return view('labo');
    }

    public function login(Request $request)
    {
        // Validation des champs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirection selon le statut
            if ($user->status === 'eleve') {
                return redirect()->route('eleve.dashboard');
            } elseif ($user->status === 'professeur') {
                return redirect()->route('professeur.dashboard');
            } elseif ($user->status === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                // Autre rôle (optionnel)
                Auth::logout();
                return back()->withErrors(['email' => 'Statut utilisateur inconnu.']);
            }
        }

        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}