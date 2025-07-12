@extends('admin')

@section('content')
<div class="header">
    <h1>Gestion des QCM - SVT 3ème</h1>
    <a href="{{ route('qcm.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Créer un QCM
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

<!-- Statistiques générales -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-question-circle"></i>
        </div>
        <div class="stat-content">
            <h3>Total Questions</h3>
            <div class="stat-value">{{ $stats['total_questions'] }}</div>
            <p>Questions créées</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3>Questions Actives</h3>
            <div class="stat-value">{{ $stats['questions_actives'] }}</div>
            <p>Disponibles pour les élèves</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3>Total Réponses</h3>
            <div class="stat-value">{{ $stats['total_reponses'] }}</div>
            <p>Réponses reçues</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-content">
            <h3>Taux de Réussite</h3>
            <div class="stat-value">{{ $stats['taux_reussite'] }}%</div>
            <p>Moyenne générale</p>
        </div>
    </div>
</div>

<!-- Liste des QCM -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Mes Questions QCM</h2>
        <div class="card-actions">
            <a href="{{ route('qcm.stats') }}" class="btn btn-secondary">
                <i class="fas fa-chart-bar"></i> Statistiques détaillées
            </a>
        </div>
    </div>
    
    <div class="card-body">
        @if($questions->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Matière</th>
                            <th>Niveau</th>
                            <th>Réponses</th>
                            <th>Taux Réussite</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>
                                    <strong>{{ $question->titre }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($question->question, 50) }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ ucfirst($question->matiere) }}</span>
                                </td>
                                <td>
                                    @if($question->niveau === 'facile')
                                        <span class="badge badge-success">Facile</span>
                                    @elseif($question->niveau === 'moyen')
                                        <span class="badge badge-warning">Moyen</span>
                                    @else
                                        <span class="badge badge-danger">Difficile</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $question->resultats->count() }}</strong> réponses
                                </td>
                                <td>
                                    @php
                                        $totalReponses = $question->resultats->count();
                                        $reponsesCorrectes = $question->resultats->where('correcte', true)->count();
                                        $taux = $totalReponses > 0 ? round(($reponsesCorrectes / $totalReponses) * 100, 1) : 0;
                                    @endphp
                                    <div class="progress" style="width: 100px; height: 8px;">
                                        <div class="progress-bar" style="width: {{ $taux }}%; background-color: {{ $taux >= 70 ? '#28a745' : ($taux >= 50 ? '#ffc107' : '#dc3545') }};"></div>
                                    </div>
                                    <small>{{ $taux }}%</small>
                                </td>
                                <td>
                                    @if($question->actif)
                                        <span class="badge badge-success">Actif</span>
                                    @else
                                        <span class="badge badge-secondary">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('qcm.show', $question) }}" class="btn btn-sm btn-info" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('qcm.edit', $question) }}" class="btn btn-sm btn-warning" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('qcm.destroy', $question) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h3>Aucune question QCM</h3>
                <p>Vous n'avez pas encore créé de questions QCM. Commencez par créer votre première question pour évaluer vos élèves.</p>
                <a href="{{ route('qcm.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer ma première question
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(198, 40, 40, 0.1);
    display: flex;
    align-items: center;
    transition: all 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(198, 40, 40, 0.15);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-right: 20px;
}

.stat-content h3 {
    margin: 0 0 10px 0;
    color: var(--dark);
    font-size: 1rem;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 5px;
}

.stat-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.progress {
    background-color: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    transition: width 0.3s;
}

.btn-group {
    display: flex;
    gap: 5px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-icon {
    font-size: 4rem;
    color: var(--primary-color);
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state h3 {
    color: var(--dark);
    margin-bottom: 10px;
}

.empty-state p {
    color: #666;
    margin-bottom: 30px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endsection 