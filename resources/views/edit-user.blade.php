@extends('admin')

@section('content')
<div class="header">
    <h1>Modifier l'Utilisateur</h1>
    <a href="{{ route('users.index') }}" class="btn btn-primary">Retour à la liste</a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier {{ $user->nom }} {{ $user->prenom }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->idUser) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 15px;">
                <label for="nom" style="display: block; margin-bottom: 5px; font-weight: 600;">Nom:</label>
                <input type="text" id="nom" name="nom" value="{{ $user->nom }}" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="prenom" style="display: block; margin-bottom: 5px; font-weight: 600;">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="{{ $user->prenom }}" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: 600;">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="status" style="display: block; margin-bottom: 5px; font-weight: 600;">Statut:</label>
                <select id="status" name="status" required 
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="eleve" {{ $user->status == 'eleve' ? 'selected' : '' }}>Élève</option>
                    <option value="professeur" {{ $user->status == 'professeur' ? 'selected' : '' }}>Professeur</option>
                    <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Section classe supprimée car pas de relation entre users et classes -->

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning" style="margin-left: 10px;">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection 
