@extends('admin')

@section('content')
<div class="header">
    <h1>
        <i class="fas fa-eye"></i>
        Détails de la classe
    </h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h3>Informations de la classe</h3>
                <table class="table">
                    <tr>
                        <th>ID :</th>
                        <td>{{ $classe->id }}</td>
                    </tr>
                    <tr>
                        <th>Nom :</th>
                        <td>{{ $classe->nom }}</td>
                    </tr>
                    <tr>
                        <th>Date de création :</th>
                        <td>{{ $classe->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Dernière modification :</th>
                        <td>{{ $classe->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="button-group">
            <a href="{{ route('classes.edit', $classe->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Modifier
            </a>
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection 