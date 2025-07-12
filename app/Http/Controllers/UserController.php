<?php

/* namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   public function register(Request $request) {
    $validated = $request->validate([
        'nom' => 'required',
        'email' => 'required|email|unique:users',
        'mot_de_passe' => 'required',
        'role' => 'required|in:professeur,eleve',
    ]);
    $validated['mot_de_passe'] = bcrypt($validated['mot_de_passe']);
    $user = User::create($validated);
    return response()->json($user, 201);
}
}

*/



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Classe;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:eleve,professeur,admin',
            'nomClasse' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($validatedData) {
            // Enregistrer la classe
            DB::table('classes')->insert([
                'nom' => $validatedData['nomClasse'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Enregistrer l'utilisateur (sans classe_id)
            DB::table('users')->insert([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'status' => $validatedData['status'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur créé avec succès!');
    }

    public function edit(User $user)
    {
        return view('edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->idUser,
            'status' => 'required'
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé');
    }
    public function create()
{
    $classes = \App\Models\Classe::all(); // Récupère toutes les classes
    return view('users.create', compact('classes')); // Retourne le formulaire de création
}
public function index()
{
    $users = User::all();
    return view('listes-users', compact('users'));
}
}