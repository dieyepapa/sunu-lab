@extends('admin')

@section('content')
<div class="header">
    <h1>Créer un nouveau QCM</h1>
    <a href="{{ route('qcm.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Nouvelle Question QCM - SVT 3ème</h2>
    </div>
    
    <div class="card-body">
        <form action="{{ route('qcm.store') }}" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> 
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="titre">Titre de la question *</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required 
                           placeholder="Ex: La photosynthèse chez les plantes vertes">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="question">Question *</label>
                    <textarea id="question" name="question" rows="4" required 
                              placeholder="Posez votre question clairement...">{{ old('question') }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="matiere">Matière *</label>
                    <select id="matiere" name="matiere" required>
                        <option value="">Sélectionnez une matière</option>
                        <option value="photosynthese" {{ old('matiere') == 'photosynthese' ? 'selected' : '' }}>Photosynthèse</option>
                        <option value="respiration" {{ old('matiere') == 'respiration' ? 'selected' : '' }}>Respiration</option>
                        <option value="digestion" {{ old('matiere') == 'digestion' ? 'selected' : '' }}>Digestion</option>
                        <option value="circulation" {{ old('matiere') == 'circulation' ? 'selected' : '' }}>Circulation sanguine</option>
                        <option value="reproduction" {{ old('matiere') == 'reproduction' ? 'selected' : '' }}>Reproduction</option>
                        <option value="genetique" {{ old('matiere') == 'genetique' ? 'selected' : '' }}>Génétique</option>
                        <option value="ecologie" {{ old('matiere') == 'ecologie' ? 'selected' : '' }}>Écologie</option>
                        <option value="evolution" {{ old('matiere') == 'evolution' ? 'selected' : '' }}>Évolution</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="niveau">Niveau de difficulté *</label>
                    <select id="niveau" name="niveau" required>
                        <option value="">Sélectionnez un niveau</option>
                        <option value="facile" {{ old('niveau') == 'facile' ? 'selected' : '' }}>Facile</option>
                        <option value="moyen" {{ old('niveau') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                        <option value="difficile" {{ old('niveau') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="option_a">Option A *</label>
                    <input type="text" id="option_a" name="option_a" value="{{ old('option_a') }}" required 
                           placeholder="Première option de réponse">
                </div>

                <div class="form-group">
                    <label for="option_b">Option B *</label>
                    <input type="text" id="option_b" name="option_b" value="{{ old('option_b') }}" required 
                           placeholder="Deuxième option de réponse">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="option_c">Option C *</label>
                    <input type="text" id="option_c" name="option_c" value="{{ old('option_c') }}" required 
                           placeholder="Troisième option de réponse">
                </div>

                <div class="form-group">
                    <label for="option_d">Option D *</label>
                    <input type="text" id="option_d" name="option_d" value="{{ old('option_d') }}" required 
                           placeholder="Quatrième option de réponse">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bonne_reponse">Bonne réponse *</label>
                    <select id="bonne_reponse" name="bonne_reponse" required>
                        <option value="">Sélectionnez la bonne réponse</option>
                        <option value="A" {{ old('bonne_reponse') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('bonne_reponse') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('bonne_reponse') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('bonne_reponse') == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="explication">Explication (optionnel)</label>
                    <textarea id="explication" name="explication" rows="3" 
                              placeholder="Expliquez pourquoi cette réponse est correcte...">{{ old('explication') }}</textarea>
                    <small class="form-text">Cette explication sera affichée aux élèves après leur réponse.</small>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Créer le QCM
                </button>
                <a href="{{ route('qcm.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--dark);
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: var(--primary-color);
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

.form-text {
    font-size: 0.875rem;
    color: #666;
    margin-top: 5px;
}

.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 
