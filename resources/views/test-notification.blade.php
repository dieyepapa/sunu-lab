<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Notification - SUNU-LAB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn {
            background: #667eea;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .status {
            margin: 20px 0;
            padding: 15px;
            border-radius: 5px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Test de Notification</h1>
        <p>Cette page permet de tester l'envoi de notifications à tous les utilisateurs de la base de données.</p>
        
        <div id="status"></div>
        
        <button class="btn" onclick="sendNotification()">
            📧 Envoyer Notification à Tous les Utilisateurs
        </button>
        
        <button class="btn" onclick="window.location.href='{{ route('professeur.dashboard') }}'">
            🔙 Retour au Dashboard
        </button>
        
        <h3>Utilisateurs dans la base de données :</h3>
        <ul>
            @foreach(\App\Models\User::all() as $user)
                <li>{{ $user->prenom }} {{ $user->nom }} - {{ $user->email }} ({{ $user->status }})</li>
            @endforeach
        </ul>
    </div>

    <script>
        function sendNotification() {
            const statusDiv = document.getElementById('status');
            const button = event.target;
            
            // Afficher le chargement
            button.innerHTML = '⏳ Envoi en cours...';
            button.disabled = true;
            statusDiv.innerHTML = '<div class="status">Envoi des notifications en cours...</div>';
            
            fetch('{{ route("notifier.simulation.ajax") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusDiv.innerHTML = `<div class="status success">✅ ${data.message}</div>`;
                    button.innerHTML = '✅ Envoyé !';
                } else {
                    throw new Error(data.error || 'Erreur lors de l\'envoi');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                statusDiv.innerHTML = `<div class="status error">❌ Erreur: ${error.message}</div>`;
                button.innerHTML = '❌ Erreur';
            })
            .finally(() => {
                setTimeout(() => {
                    button.innerHTML = '📧 Envoyer Notification à Tous les Utilisateurs';
                    button.disabled = false;
                }, 3000);
            });
        }
    </script>
</body>
</html> 
