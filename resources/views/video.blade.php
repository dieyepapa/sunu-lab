<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéos - SUNU-LAB</title>
    <style>
        :root {
            --primary: #c62828;
            --primary-light: #ff5f52;
            --primary-dark: #8e0000;
            --dark: #263238;
            --light: #f5f5f5;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light);
            color: var(--dark);
        }
        
        .navbar {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: white;
            padding: 0 30px;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(198, 40, 40, 0.3);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
        }
        
        .nav-link {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 50px;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            color: var(--primary);
            font-size: 2rem;
            margin: 0;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(198, 40, 40, 0.3);
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(198, 40, 40, 0.4);
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .video-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .video-container {
            position: relative;
            width: 100%;
            height: 200px;
            background: #000;
        }
        
        .video-player {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-info {
            padding: 20px;
        }
        
        .video-title {
            font-weight: 600;
            margin: 0 0 10px 0;
            color: var(--dark);
            font-size: 1.1rem;
        }
        
        .video-date {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .empty-icon {
            font-size: 4rem;
            color: var(--primary-light);
            margin-bottom: 20px;
        }
        
        .empty-title {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        
        .empty-description {
            color: #666;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <i class="fas fa-flask"></i>
            <span>SUNU-LAB</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('professeur.dashboard') }}" class="nav-link">
                <i class="fas fa-arrow-left"></i> Retour au Dashboard
            </a>
        </div>
    </nav>

    <div class="content">
        <div class="page-header">
            <h1 class="page-title">Mes Vidéos Publiques</h1>
            <a href="{{ route('professeur.dashboard') }}" class="btn">
                <i class="fas fa-plus"></i> Ajouter une vidéo
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
        
        @if($videos->count() > 0)
            <div class="video-grid">
                @foreach($videos as $video)
                    <div class="video-card">
                        <div class="video-container">
                            <video controls class="video-player">
                                <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        </div>
                        <div class="video-info">
                            <h3 class="video-title">{{ $video->title }}</h3>
                            <p class="video-date">
                                <i class="fas fa-calendar"></i> 
                                Publié le {{ $video->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-video-slash"></i>
                </div>
                <h2 class="empty-title">Aucune vidéo publiée</h2>
                <p class="empty-description">
                    Vous n'avez pas encore publié de vidéos. Commencez par ajouter votre première ressource pédagogique depuis votre dashboard.
                </p>
                <a href="{{ route('professeur.dashboard') }}" class="btn">
                    <i class="fas fa-plus"></i> Ajouter ma première vidéo
                </a>
            </div>
        @endif
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>