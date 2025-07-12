@extends('admin')

@section('content')
<div class="header">
    <h1>Liste des Classes</h1>
    <a href="{{ route('classes.create') }}" class="btn btn-primary">Ajouter une Classe</a>
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
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $classe)
                <tr>
                    <td>{{ $classe->id }}</td>
                    <td>{{ $classe->nom }}</td>
                    <td>{{ $classe->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('classes.edit', $classe->id) }}" class="btn btn-sm btn-success">Modifier</a>
                        <form action="{{ route('classes.destroy', $classe->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection