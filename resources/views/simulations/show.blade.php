<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $simulation->titre }} - Labo Virtuel</title>
    <style>
        :root {
            --primary: #667eea;
            --primary-light: #7c8ff0;
            --primary-dark: #5a6fd8;
            --secondary: #1565c0;
            --secondary-light: #5e92f3;
            --dark: #263238;
            --light: #f5f5f5;
            --accent: #ffab00;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e0e0e0 100%);
            color: #333;
        }

        .navbar {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: white;
            padding: 0 30px;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 1.8rem;
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

        .nav-link i {
            margin-right: 8px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .content {
            margin-top: 70px;
            padding: 30px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .simulation-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 40px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .simulation-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }

        .simulation-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .simulation-meta {
            display: flex;
            gap: 20px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
        }

        .meta-item i {
            font-size: 1.2rem;
        }

        .simulation-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .main-content {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .sidebar {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            height: fit-content;
        }

        .section-title {
            color: var(--dark);
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
        }

        .description {
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .instructions {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid var(--primary);
        }

        .instructions h4 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .instructions ol {
            margin-left: 20px;
            line-height: 1.8;
            color: #555;
        }

        .difficulty-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: capitalize;
            margin-bottom: 20px;
        }

        .difficulty-badge.facile {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .difficulty-badge.moyen {
            background: #fff3e0;
            color: #f57c00;
        }

        .difficulty-badge.difficile {
            background: #ffebee;
            color: #667eea;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
            width: 100%;
            margin-bottom: 10px;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: var(--secondary);
            box-shadow: 0 4px 10px rgba(21, 101, 192, 0.3);
        }

        .btn-secondary:hover {
            background: var(--secondary-light);
            box-shadow: 0 6px 15px rgba(21, 101, 192, 0.4);
        }

        .btn-danger {
            background: #d32f2f;
            box-shadow: 0 4px 10px rgba(211, 47, 47, 0.3);
        }

        .btn-danger:hover {
            background: #b71c1c;
            box-shadow: 0 6px 15px rgba(211, 47, 47, 0.4);
        }

        .creation-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .creation-info p {
            margin-bottom: 5px;
            color: #666;
            font-size: 0.9rem;
        }

        .creation-info strong {
            color: var(--dark);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <i class="fas fa-flask"></i>
            <span>SUNU-LAB</span>
        </div>
        <div class="nav-links">
            <a href="{{ route('simulations.index') }}" class="nav-link">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </nav>

    <div class="content">
        <div class="simulation-header">
            <h1 class="simulation-title">{{ $simulation->titre }}</h1>
            <div class="simulation-meta">
                <div class="meta-item">
                    <i class="fas fa-tag"></i>
                    <span>{{ ucfirst($simulation->type) }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>Créée le {{ $simulation->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $simulation->created_at->format('H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="simulation-content">
            <div class="main-content">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Description
                </h2>
                <p class="description">{{ $simulation->description }}</p>

                <h2 class="section-title">
                    <i class="fas fa-list-ol"></i>
                    Instructions pour les élèves
                </h2>
                <div class="instructions">
                    <h4>Comment utiliser cette simulation :</h4>
                    <ol>
                        @foreach(explode("\n", $simulation->instructions) as $instruction)
                            @if(trim($instruction))
                                <li>{{ trim($instruction) }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="sidebar">
                <h3 class="section-title">
                    <i class="fas fa-cog"></i>
                    Paramètres
                </h3>

                <div class="difficulty-badge {{ $simulation->difficulte }}">
                    <i class="fas fa-signal"></i>
                    {{ ucfirst($simulation->difficulte) }}
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Utilisations</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Élèves</div>
                    </div>
                </div>

                <a href="{{ route('simulations.execute', $simulation) }}" class="btn">
                    <i class="fas fa-play"></i> Exécuter la simulation
                </a>

                <a href="{{ route('simulations.edit', $simulation) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i> Modifier
                </a>

                <form action="{{ route('simulations.destroy', $simulation) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette simulation ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>

                <div class="creation-info">
                    <p><strong>ID :</strong> #{{ $simulation->id }}</p>
                    <p><strong>Statut :</strong> {{ ucfirst($simulation->statut) }}</p>
                    <p><strong>Dernière modification :</strong> {{ $simulation->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Effet sur les boutons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> 
