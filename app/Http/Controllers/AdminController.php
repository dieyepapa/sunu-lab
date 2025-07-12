<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Gestion Utilisateurs
    public function usersIndex()
    {
        $users = DB::table('users')
                ->join('classes', 'users.classe_id', '=', 'classes.id')
                ->select('users.*', 'classes.nom as classe_nom')
                ->get();
        
        return view('admin', compact('users'));
    }

    public function createUser()
    {
        $classes = DB::table('classes')->get();
        return view('admin.users.create', compact('classes'));
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:eleve,professeur,admin',
            'classe_id' => 'required|exists:classes,id'
        ]);

        DB::table('users')->insert([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status' => $validatedData['status'],
            'classe_id' => $validatedData['classe_id'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin')->with('success', 'Utilisateur créé avec succès!');
    }

    public function editUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $classes = DB::table('classes')->get();
        
        return view('admin.users.edit', compact('user', 'classes'));
    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'status' => 'required|in:eleve,professeur,admin',
            'classe_id' => 'required|exists:classes,id'
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'email' => $validatedData['email'],
                'status' => $validatedData['status'],
                'classe_id' => $validatedData['classe_id'],
                'updated_at' => now()
            ]);

        return redirect()->route('admin')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'Utilisateur supprimé avec succès!');
    }

    // Gestion Classes
    public function classesIndex()
    {
        $classes = DB::table('classes')->get();
        return view('admin', compact('classes'));
    }

    public function storeClass(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:classes'
        ]);

        DB::table('classes')->insert([
            'nom' => $validatedData['nom'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Classe créée avec succès!');
    }

    public function updateClass(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:classes,nom,'.$id
        ]);

        DB::table('classes')
            ->where('id', $id)
            ->update([
                'nom' => $validatedData['nom'],
                'updated_at' => now()
            ]);

        return back()->with('success', 'Classe mise à jour avec succès!');
    }

    public function deleteClass($id)
    {
        DB::table('classes')->where('id', $id)->delete();
        return back()->with('success', 'Classe supprimée avec succès!');
    }
}