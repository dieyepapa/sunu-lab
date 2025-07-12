<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QcmController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('acceuil');
});

Route::get('/labo', function () {
    return view('labo');
})->name('login');

Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [AuthController::class, 'labo']);


// ✅ Authentification de base (à étendre plus tard)
Route::post('/register', [UserController::class, 'register']);


 
// ✅ Etablissements
Route::get('/etablissements', [EtablissementController::class, 'index']);
Route::post('/etablissements', [EtablissementController::class, 'store']);

// ✅ Classes
Route::get('/classes', [ClasseController::class, 'index']);
Route::post('/classes', [ClasseController::class, 'store']);

// ✅ Professeurs
Route::get('/professeurs', [ProfesseurController::class, 'index']);
Route::post('/professeurs', [ProfesseurController::class, 'store']);

// ✅ Élèves
Route::get('/eleves', [EleveController::class, 'index']);
Route::post('/eleves', [EleveController::class, 'store']);
Route::post('/questions', [EleveController::class, 'storeQuestion']);
Route::post('/avis', [EleveController::class, 'storeAvis']);
Route::get('/eleve', [EleveController::class, 'dashboard'])->name('eleve.dashboard')->middleware('auth');
Route::get('/dashboard/eleve', [EleveController::class, 'dashboard'])->middleware('auth');

// ✅ Simulations
Route::get('/simulations', [SimulationController::class, 'index']);
Route::post('/simulations', [SimulationController::class, 'store']);

Route::get('/simulations/{id}', [SimulationController::class, 'show'])->middleware('auth');
Route::put('/simulations/{id}', [SimulationController::class, 'update'])->middleware('auth');
Route::delete('/simulations/{id}', [SimulationController::class, 'destroy'])->middleware('auth');
Route::get('/simulation/{id}', [SimulationController::class, 'show'])->name('simulation.show')->middleware('auth');
Route::get('/simulation/circulation-sanguine', [SimulationController::class, 'circulation'])->name('simulation.circulation')->middleware('auth');
Route::get('/digestion-enzymatique', [SimulationController::class, 'digestionEnzymatique'])->name('simulation.digestion')->middleware('auth');
Route::get('/cycle-fecondation', [SimulationController::class, 'fecondation'])->name('simulation.fecondation')->middleware('auth');

Route::get('/envoyer-notification', [NotificationController::class, 'envoyer'])->name('envoyer.notification')->middleware('auth');
Route::post('/send-notification-email', [NotificationController::class, 'envoyer'])->middleware('auth');

Route::get('/register-user', [UserController::class, 'register'])->name('register.user');
Route::post('/register-user', [UserController::class, 'register'])->name('register.user');

Route::get('/admin', [UserController::class, 'admin'])->name('admin');
Route::post('/admin', [UserController::class, 'register'])->name('admin');
Route::post('/admin/users/store', [UserController::class, 'store'])->name('users.store');

// Route pour afficher la page des vidéos
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index')->middleware('auth');

// Route pour le traitement de l'upload (depuis votre formulaire)
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store')->middleware(['auth', 'handle.large.uploads', 'upload.error.handler']);

// Route pour obtenir les statistiques
Route::get('/videos/stats', [VideoController::class, 'getStats'])->name('videos.stats')->middleware('auth');

// Routes QCM
Route::resource('qcm', QcmController::class)->middleware('auth');
Route::post('/qcm/{qcmQuestion}/submit', [QcmController::class, 'submitAnswer'])->name('qcm.submit')->middleware('auth');
Route::get('/qcm-stats', [QcmController::class, 'stats'])->name('qcm.stats')->middleware('auth');

//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Route::get('/labo', [AuthController::class, 'labo']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/simulation/{id}/qcm', function (Request $request, $id) {
    // Traiter ici les réponses du QCM
    $reponse = $request->input('q1');

    // Simple logique pour démo : la bonne réponse = 1
    $message = ($reponse == '1')
        ? '✅ Bonne réponse !'
        : '❌ Mauvaise réponse, révise un peu.';

    return back()->with('message', $message);
})->name('qcm.submit')->middleware('auth');
Route::get('/labo', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/labo', [AuthController::class, 'login']);

Route::get('/eleve', function () {
    return view('eleve');
})->middleware('auth')->name('eleve.dashboard');

// Dashboard professeur
//Route::get('/professeur', function () {
    //return view('professeur');
//})->middleware('auth');

Route::get('/professeur', function () {
    return view('professeur'); // ou ton vrai dashboard
})->middleware('auth')->name('professeur.dashboard');

Route::get('/logout', function () {
    Auth::logout(); // Déconnecte l'utilisateur
    return redirect('/labo'); // Redirige vers la page de connexion
})->name('logout');

Route::get('/virtuel-lab', function () {
    return view('virtuel-lab');
})->name('virtuel-lab')->middleware('auth');

Route::get('/transmission-nerveuse', function () {
    return view('transmission');
})->name('transmission.nerveuse')->middleware('auth');

Route::get('/acceuil', function () {
    return view('acceuil');
})->name('acceuil');

// Page d'accueil
//Route::get('/', function () {
   // return view('index');
//})->name('home');

// Page de connexion
Route::get('/labo', function () {
    return view('labo');
})->name('labo');

// Traitement du formulaire de connexion
//Route::post('/login', function () {
    // Ici vous ajouterez votre logique d'authentification
   // return redirect()->route('dashboard');
//})->name('login');

// Tableau de bord (après connexion)
Route::get('/dashboard', function () {
    return view('dashboard'); // Vous devrez créer cette vue
})->name('dashboard')->middleware('auth');

Route::get('/A-propos', function () {
    return view('A-propos');
})->name('A-propos');

Route::get('/tectonique', function () {
    return view('tectonique');
})->name('tectonique')->middleware('auth');

Route::get('/photosynthese', function () {
    return view('photosynthese');
})->name('photosynthese')->middleware('auth');

Route::get('/circulation-sanguin', function () {
    return view('circulation-sanguin');
})->name('circulation-sanguin')->middleware('auth');

// Route supprimée car en conflit avec la route videos.index du VideoController

// Ajoutez cette route avec les autres routes
Route::get('/formulaire-inscription', function () {
    return view('form'); // Cela renvoie vers votre fichier form.blade.php
})->name('formulaire.inscription');



Route::prefix('admin')->middleware('auth')->group(function () {
    // Route pour le dashboard admin
    Route::get('/dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
    
    // Route pour afficher le formulaire
    Route::get('/users/create', function () {
        return view('form');
    })->name('users.create');
    
    // Route pour traiter l'enregistrement
    Route::post('/users/store', function (Illuminate\Http\Request $request) {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:eleve,professeur,admin',
            'nomClasse' => 'required|string|max:255'
        ]);
        
        // Enregistrement dans la base de données
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

        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        
        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur enregistré avec succès!');
    })->name('users.store');

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);
    
    // Gestion des classes
   Route::resource('classes', ClasseController::class)->except(['show']);

   Route::get('/users', [UserController::class, 'index'])->name('users.index');
   Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
   Route::post('/users', [UserController::class, 'store'])->name('users.store');
   Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
   Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
   Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});