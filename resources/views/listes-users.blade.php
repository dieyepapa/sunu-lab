@extends('admin')

@section('content')
<div class="header">
    <h1>Liste des Utilisateurs</h1>
    <a href="{{ route('formulaire.inscription') }}" class="btn btn-primary">Ajouter un Utilisateur</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->idUser }}</td>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->status == 'eleve')
                            <span class="badge badge-success">Élève</span>
                        @elseif($user->status == 'professeur')
                            <span class="badge badge-primary">Professeur</span>
                        @elseif($user->status == 'admin')
                            <span class="badge badge-danger">Admin</span>
                        @else
                            <span class="badge badge-warning">{{ $user->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->idUser) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('users.destroy', $user->idUser) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
