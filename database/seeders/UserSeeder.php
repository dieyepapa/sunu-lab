<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur élève
        User::create([
            'nom' => 'Diouf',
            'prenom' => 'Samba',
            'email' => 'eleve@test.com',
            'password' => Hash::make('password'),
            'status' => 'eleve',
        ]);

        // Créer un utilisateur professeur
        User::create([
            'nom' => 'Diallo',
            'prenom' => 'Fatou',
            'email' => 'professeur@test.com',
            'password' => Hash::make('password'),
            'status' => 'professeur',
        ]);

        // Créer un utilisateur admin
        User::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'status' => 'admin',
        ]);
    }
}
