<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Simulation - Labo Virtuel</title>
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
            min-height: 100vh;
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
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: var(--dark);
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
            font-size: 1rem;
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

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert i {
            margin-right: 10px;
        }

        .error-message {
            color: #d32f2f;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .preview-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .preview-section h4 {
            color: var(--dark);
            margin-bottom: 15px;
        }

        .preview-content {
            background: white;
            border-radius: 8px;
            padding: 15px;
            border-left: 4px solid var(--primary);
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
            <a href="{{ route('simulations.index') }}" class="nav-link">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </nav>

    <div class="content">
        <div class="header">
            <h1><i class="fas fa-plus-circle"></i> Créer une Simulation</h1>
            <p>Créez une nouvelle simulation interactive pour vos élèves</p>
        </div>

        <div class="form-container">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('simulations.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="titre">Titre de la simulation *</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" placeholder="Ex: Structure moléculaire de l'ADN" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Type de simulation *</label>
                        <select id="type" name="type" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="biologie" {{ old('type') == 'biologie' ? 'selected' : '' }}>Biologie (ex : mitose, fécondation, circulation sanguine)</option>
                            <option value="geologie" {{ old('type') == 'geologie' ? 'selected' : '' }}>Géologie (ex : séisme, volcanisme, tectonique)</option>
                            <option value="ecologie" {{ old('type') == 'ecologie' ? 'selected' : '' }}>Écologie (ex : chaîne alimentaire, écosystème)</option>
                            <option value="genetique" {{ old('type') == 'genetique' ? 'selected' : '' }}>Génétique (ex : hérédité, chromosomes)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="difficulte">Niveau de difficulté *</label>
                        <select id="difficulte" name="difficulte" required>
                            <option value="">Sélectionnez un niveau</option>
                            <option value="facile" {{ old('difficulte') == 'facile' ? 'selected' : '' }}>Facile</option>
                            <option value="moyen" {{ old('difficulte') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                            <option value="difficile" {{ old('difficulte') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" placeholder="Décrivez le contenu et les objectifs de votre simulation..." required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="instructions">Instructions pour les élèves *</label>
                    <textarea id="instructions" name="instructions" placeholder="Donnez des instructions claires pour guider les élèves dans l'utilisation de la simulation..." required>{{ old('instructions') }}</textarea>
                </div>

                <div class="preview-section">
                    <h4><i class="fas fa-eye"></i> Aperçu</h4>
                    <div class="preview-content">
                        <div id="preview-titre" style="font-weight: bold; margin-bottom: 10px;">{{ old('titre') ?: 'Titre de la simulation' }}</div>
                        <div id="preview-type" style="color: #666; margin-bottom: 10px;">
                            Type: {{ old('type') ? ucfirst(old('type')) : 'Non spécifié' }} | 
                            Difficulté: {{ old('difficulte') ? ucfirst(old('difficulte')) : 'Non spécifiée' }}
                        </div>
                        <div id="preview-description" style="margin-bottom: 10px;">{{ old('description') ?: 'Description de la simulation...' }}</div>
                        <div id="preview-instructions" style="font-style: italic; color: #666;">{{ old('instructions') ?: 'Instructions pour les élèves...' }}</div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('simulations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Créer la simulation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mise à jour en temps réel de l'aperçu
        document.getElementById('titre').addEventListener('input', function() {
            document.getElementById('preview-titre').textContent = this.value || 'Titre de la simulation';
        });

        document.getElementById('type').addEventListener('change', function() {
            const typeText = this.value ? this.options[this.selectedIndex].text : 'Non spécifié';
            const difficultyText = document.getElementById('difficulte').value ? 
                document.getElementById('difficulte').options[document.getElementById('difficulte').selectedIndex].text : 'Non spécifiée';
            document.getElementById('preview-type').textContent = `Type: ${typeText} | Difficulté: ${difficultyText}`;
        });

        document.getElementById('difficulte').addEventListener('change', function() {
            const typeText = document.getElementById('type').value ? 
                document.getElementById('type').options[document.getElementById('type').selectedIndex].text : 'Non spécifié';
            const difficultyText = this.value ? this.options[this.selectedIndex].text : 'Non spécifiée';
            document.getElementById('preview-type').textContent = `Type: ${typeText} | Difficulté: ${difficultyText}`;
        });

        document.getElementById('description').addEventListener('input', function() {
            document.getElementById('preview-description').textContent = this.value || 'Description de la simulation...';
        });

        document.getElementById('instructions').addEventListener('input', function() {
            document.getElementById('preview-instructions').textContent = this.value || 'Instructions pour les élèves...';
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
