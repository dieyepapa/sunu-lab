@extends('admin')

@section('content')
<div class="header">
    <h1>
        <i class="fas fa-plus-circle"></i>
        Créer une nouvelle classe
    </h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nom">Nom de la classe</label>
                <input type="text" 
                       class="form-control @error('nom') is-invalid @enderror" 
                       id="nom" 
                       name="nom" 
                       value="{{ old('nom') }}" 
                       required>
                @error('nom')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Créer la classe
                </button>
                <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 