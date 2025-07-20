<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    public function envoyer(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            Mail::raw($data['message'], function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject('Notification Simulation');
            });

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'envoi : ' . $e->getMessage()], 500);
        }
    }

    public function notifier()
    {
        $professeur = Auth::user(); // le professeur connecté

        if (!$professeur) {
            return redirect()->route('login')->with('error', 'Utilisateur non connecté.');
        }

        // Corps du message
        $message = "Le professeur {$professeur->prenom} {$professeur->nom} a lancé une simulation. Veuillez vous connecter dans l'application pour y participer.";

        // Récupérer tous les utilisateurs
        $utilisateurs = User::all();

        $emailsEnvoyes = 0;
        $erreurs = [];

        foreach ($utilisateurs as $user) {
            try {
                Mail::raw($message, function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('Notification de Simulation - SUNU-LAB');
                });
                $emailsEnvoyes++;
            } catch (\Exception $e) {
                $erreurs[] = "Erreur pour {$user->email}: " . $e->getMessage();
            }
        }

        if (count($erreurs) > 0) {
            return back()->with('warning', "Notifications envoyées à {$emailsEnvoyes} utilisateurs. Erreurs: " . implode(', ', $erreurs));
        }

        return back()->with('success', "Notification envoyée avec succès à {$emailsEnvoyes} utilisateurs.");
    }

    public function notifierSimulation()
    {
        $professeur = Auth::user();

        if (!$professeur) {
            return response()->json(['error' => 'Utilisateur non connecté.'], 401);
        }

        try {
            // Récupérer tous les utilisateurs
            $utilisateurs = User::all();
            
            $message = "Le professeur {$professeur->prenom} {$professeur->nom} a lancé une simulation. Veuillez vous connecter dans l'application pour y participer.";
            
            $emailsEnvoyes = 0;
            
            foreach ($utilisateurs as $user) {
                Mail::raw($message, function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('🚀 Simulation Lancée - SUNU-LAB');
                });
                $emailsEnvoyes++;
            }

            return response()->json([
                'success' => true,
                'message' => "Notification envoyée avec succès à {$emailsEnvoyes} utilisateurs.",
                'emails_envoyes' => $emailsEnvoyes
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'envoi des notifications: ' . $e->getMessage()
            ], 500);
        }
    }

    public function notifierEleve()
    {
        $eleve = Auth::user();

        if (!$eleve) {
            return response()->json(['error' => 'Utilisateur non connecté.'], 401);
        }

        try {
            // Récupérer tous les utilisateurs
            $utilisateurs = User::all();
            
            $message = "L'élève {$eleve->prenom} {$eleve->nom} a lancé une simulation. Veuillez vous connecter dans l'application pour y participer.";
            
            $emailsEnvoyes = 0;
            
            foreach ($utilisateurs as $user) {
                Mail::raw($message, function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('🎓 Simulation Élève - SUNU-LAB');
                });
                $emailsEnvoyes++;
            }

            return response()->json([
                'success' => true,
                'message' => "Notification envoyée avec succès à {$emailsEnvoyes} utilisateurs.",
                'emails_envoyes' => $emailsEnvoyes
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de l\'envoi des notifications: ' . $e->getMessage()
            ], 500);
        }
    }
}