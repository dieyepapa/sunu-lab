@extends('admin')

@section('content')
<div class="header">
    <h1>
        <i class="fas fa-tachometer-alt"></i>
        Tableau de Bord
    </h1>
    <div class="user-info">
        <i class="fas fa-user-shield"></i>
        <span>Bienvenue, Administrateur</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

<!-- Statistiques -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3>Utilisateurs</h3>
            <p class="stat-number">{{ \App\Models\User::count() }}</p>
            <span class="stat-label">Total inscrits</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-chalkboard"></i>
        </div>
        <div class="stat-content">
            <h3>Classes</h3>
            <p class="stat-number">{{ \App\Models\Classe::count() }}</p>
            <span class="stat-label">Classes actives</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-flask"></i>
        </div>
        <div class="stat-content">
            <h3>Simulations</h3>
            <p class="stat-number">{{ \App\Models\Simulation::count() }}</p>
            <span class="stat-label">Expériences disponibles</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-video"></i>
        </div>
        <div class="stat-content">
            <h3>Vidéos</h3>
            <p class="stat-number">{{ \App\Models\Video::count() }}</p>
            <span class="stat-label">Ressources vidéo</span>
        </div>
    </div>
</div>

<!-- Actions Rapides -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-bolt"></i>
            Actions Rapides
        </h3>
    </div>
    <div class="card-body">
        <div class="quick-actions">
            <a href="{{ route('formulaire.inscription') }}" class="action-btn">
                <i class="fas fa-user-plus"></i>
                <span>Créer un Utilisateur</span>
            </a>
            <a href="{{ route('users.index') }}" class="action-btn">
                <i class="fas fa-list"></i>
                <span>Gérer les Utilisateurs</span>
            </a>
            <a href="{{ route('classes.index') }}" class="action-btn">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Gérer les Classes</span>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-chart-line"></i>
                <span>Voir les Statistiques</span>
            </a>
        </div>
    </div>
</div>

<!-- Activité Récente -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-clock"></i>
            Activité Récente
        </h3>
    </div>
    <div class="card-body">
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-content">
                    <h4>Nouvel utilisateur inscrit</h4>
                    <p>Un nouvel élève s'est inscrit au système</p>
                    <span class="activity-time">Il y a 2 heures</span>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-video"></i>
                </div>
                <div class="activity-content">
                    <h4>Nouvelle vidéo ajoutée</h4>
                    <p>Une vidéo sur la photosynthèse a été ajoutée</p>
                    <span class="activity-time">Il y a 4 heures</span>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="activity-content">
                    <h4>Simulation mise à jour</h4>
                    <p>La simulation de circulation sanguine a été améliorée</p>
                    <span class="activity-time">Il y a 1 jour</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Système de Santé -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-heartbeat"></i>
            État du Système
        </h3>
    </div>
    <div class="card-body">
        <div class="system-status">
            <div class="status-item">
                <div class="status-indicator online"></div>
                <span>Serveur Web</span>
            </div>
            <div class="status-item">
                <div class="status-indicator online"></div>
                <span>Base de Données</span>
            </div>
            <div class="status-item">
                <div class="status-indicator online"></div>
                <span>Stockage Fichiers</span>
            </div>
            <div class="status-item">
                <div class="status-indicator online"></div>
                <span>Services API</span>
            </div>
        </div>
    </div>
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 25px;
        box-shadow: var(--shadow-medium);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(20px);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-heavy);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }

    .stat-content h3 {
        color: var(--dark-color);
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #666;
        font-weight: 500;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 20px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 15px;
        text-decoration: none;
        color: var(--dark-color);
        transition: all 0.3s;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }

    .action-btn:hover {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    .action-btn i {
        font-size: 1.5rem;
    }

    .action-btn span {
        font-weight: 600;
        text-align: center;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 12px;
        transition: all 0.3s;
    }

    .activity-item:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: translateX(5px);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .activity-content h4 {
        color: var(--dark-color);
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .activity-content p {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .activity-time {
        color: #999;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .system-status {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }

    .status-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .status-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    .status-indicator.online {
        background: #4facfe;
        box-shadow: 0 0 10px rgba(79, 172, 254, 0.5);
    }

    .status-indicator.offline {
        background: #fa709a;
        box-shadow: 0 0 10px rgba(250, 112, 154, 0.5);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .system-status {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection 
