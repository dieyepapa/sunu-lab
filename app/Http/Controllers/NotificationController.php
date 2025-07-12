<?php
/*
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class NotificationController extends Controller
{
    public function notifier()
    {
        $eleve = Auth::user(); // l'élève connecté

        if (!$eleve) {
            return redirect()->route('login')->with('error', 'Utilisateur non connecté.');
        }

        // Corps du message
        $message = "L’élève {$eleve->prenom} {$eleve->nom} (ID : {$eleve->id}) a lancé une simulation. Veuillez vous connecter dans l'application.";

        // Récupérer tous les utilisateurs
        $utilisateurs = User::all();

        foreach ($utilisateurs as $user) {
            Mail::raw($message, function ($mail) use ($user) {
                $mail->to($user->email)
                     ->subject('Notification de Simulation');
            });
        }

        return back()->with('success', 'Notifications envoyées avec succès.');
    }
}

*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
}