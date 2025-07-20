<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Simulations - Labo Virtuel</title>
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
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--dark);
            font-size: 2rem;
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

        .simulations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .simulation-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
        }

        .simulation-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }

        .simulation-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px;
            position: relative;
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
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 5px;
            position: relative;
            z-index: 2;
        }

        .simulation-type {
            font-size: 0.9rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            text-transform: capitalize;
        }

        .simulation-content {
            padding: 20px;
        }

        .simulation-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .simulation-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .difficulty {
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .difficulty.facile {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .difficulty.moyen {
            background: #fff3e0;
            color: #f57c00;
        }

        .difficulty.difficile {
            background: #ffebee;
            color: #667eea;
        }

        .simulation-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--primary-light);
            margin-bottom: 20px;
        }

        .empty-state h2 {
            color: var(--dark);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #546e7a;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert i {
            margin-right: 10px;
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
            <a href="{{ route('professeur.dashboard') }}" class="nav-link">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </nav>

    <div class="content">
        <div class="header">
            <h1><i class="fas fa-cube"></i> Mes Simulations</h1>
            <a href="{{ route('simulations.create') }}" class="btn">
                <i class="fas fa-plus"></i> Nouvelle Simulation
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($simulations->count() > 0)
            <div class="simulations-grid">
                @foreach($simulations as $simulation)
                    <div class="simulation-card">
                        <div class="simulation-header">
                            <div class="simulation-title">{{ $simulation->titre }}</div>
                            <div class="simulation-type">{{ $simulation->type }}</div>
                        </div>
                        <div class="simulation-content">
                            <p class="simulation-description">{{ Str::limit($simulation->description, 120) }}</p>
                            <div class="simulation-meta">
                                <span class="difficulty {{ $simulation->difficulte }}">
                                    {{ $simulation->difficulte }}
                                </span>
                                <span>Créée le {{ $simulation->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="simulation-actions">
                                <a href="{{ route('simulations.show', $simulation) }}" class="btn btn-secondary btn-small">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="{{ route('simulations.edit', $simulation) }}" class="btn btn-small">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <a href="{{ route('simulations.execute', $simulation) }}" class="btn btn-secondary btn-small">
                                    <i class="fas fa-play"></i> Exécuter
                                </a>
                                <form action="{{ route('simulations.destroy', $simulation) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette simulation ?')">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-cube"></i></div>
                <h2>Aucune simulation créée</h2>
                <p>Vous n'avez pas encore créé de simulations. Commencez par créer votre première simulation interactive pour vos élèves.</p>
                <a href="{{ route('simulations.create') }}" class="btn">
                    <i class="fas fa-plus"></i> Créer ma première simulation
                </a>
            </div>
        @endif
    </div>

    <script>
        // Animation des cartes au survol
        document.querySelectorAll('.simulation-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

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
