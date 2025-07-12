@extends('admin')

@section('content')
<div class="header">
    <h1>Tableau de Bord</h1>
    <div>
        <span>Bienvenue, Admin</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Actions Rapides</h3>
    </div>
    <div>
        <a href="{{ route('formulaire.inscription') }}" class="btn btn-primary">Créer un Utilisateur</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Statistiques</h3>
    </div>
    <div>
        <p>Contenu des statistiques à venir...</p>
    </div>
</div>
@endsection 