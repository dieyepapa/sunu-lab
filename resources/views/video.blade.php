<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Vidéos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(102,126,234,0.08); padding: 30px; }
        h1 { color: #667eea; }
        .alert-success { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 8px; margin-bottom: 15px; }
        .alert-error { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 8px; margin-bottom: 15px; }
        .video-list { margin-top: 30px; }
        .video-item { background: #f9f9f9; border-radius: 8px; padding: 18px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(102,126,234,0.05); }
        .video-title { font-size: 1.1em; font-weight: bold; color: #263238; margin-bottom: 8px; }
        .video-date { color: #888; font-size: 0.95em; margin-bottom: 8px; }
        video { width: 100%; max-width: 400px; border-radius: 8px; background: #000; }
        .back-link { display: inline-block; margin-top: 30px; color: #667eea; text-decoration: none; font-weight: bold; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Mes Vidéos publiées</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background:#f3f3f3; border:1px solid #ccc; padding:10px; margin-bottom:20px;">
        <strong>Votre ID Professeur connecté :</strong> {{ Auth::user()->idUser ?? Auth::user()->id }}
    </div>
    <div class="video-list">
        @if(isset($videos) && $videos->count())
            @foreach($videos as $video)
                <div class="video-item">
                    <div class="video-title">{{ $video->title }}</div>
                    <div class="video-date">Publié le {{ $video->created_at->format('d/m/Y à H:i') }}</div>
                    <video controls>
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Votre navigateur ne supporte pas la vidéo.
                    </video>
                </div>
            @endforeach
        @else
            <div style="text-align:center; color:#888; margin:40px 0; font-size:1.1em;">
                <i class="fas fa-info-circle" style="font-size:2em; color:#667eea;"></i><br>
                Aucune vidéo publiée pour le moment.<br>
                <span style="color:#667eea;">Publiez une vidéo depuis votre espace professeur pour la voir ici.</span>
            </div>
        @endif
    </div>

    <a href="{{ route('professeur.dashboard') }}" class="back-link">&larr; Retour au dashboard</a>
</div>
</body>
</html>
