<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Espace Professeur - Labo Virtuel</title>
  <style>
    :root {
      --primary: #c62828;
      --primary-light: #ff5f52;
      --primary-dark: #8e0000;
      --secondary: #1565c0;
      --secondary-light: #5e92f3;
      --dark: #263238;
      --light: #f5f5f5;
      --accent: #ffab00;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e0e0e0 100%);
      color: #333;
    }

    .navbar {
      background: linear-gradient(to right, var(--primary), var(--primary-dark));
      color: white;
      padding: 0 30px;
      height: 70px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 20px rgba(198, 40, 40, 0.3);
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

    .nav-link.active {
      background: white;
      color: var(--primary);
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .content {
      margin-top: 70px;
      padding: 30px;
    }

    .welcome-banner {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 40px;
      border-radius: 16px;
      margin-bottom: 40px;
      box-shadow: 0 10px 30px rgba(198, 40, 40, 0.3);
      position: relative;
      overflow: hidden;
    }

    .welcome-banner::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
      transform: rotate(30deg);
    }

    .welcome-banner h1 {
      position: relative;
      font-size: 2.5rem;
      margin-bottom: 15px;
      text-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .welcome-banner p {
      position: relative;
      font-size: 1.2rem;
      opacity: 0.9;
      max-width: 70%;
    }

    /* Nouveau conteneur horizontal */
    .horizontal-section {
      display: flex;
      gap: 30px;
      margin-bottom: 40px;
    }

    .horizontal-section h2 {
      margin-bottom: 20px;
      color: var(--dark);
      width: 100%;
    }

    .action-card, .stat-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      overflow: hidden;
      position: relative;
      height: 200px;
      cursor: pointer;
      flex: 1;
      min-width: 280px;
    }

    .action-card:hover, .stat-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 15px 40px rgba(198, 40, 40, 0.2);
    }

    .action-content, .stat-content {
      position: relative;
      z-index: 2;
      padding: 25px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
    }

    .action-icon, .stat-icon {
      font-size: 3rem;
      margin-bottom: 20px;
      color: var(--primary);
      text-shadow: 0 2px 5px rgba(198, 40, 40, 0.2);
    }

    .action-card h3, .stat-card h3 {
      color: var(--dark);
      margin: 0;
      font-size: 1.3rem;
    }

    .stat-value {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary);
      margin: 15px 0;
    }

    .stat-description {
      color: #546e7a;
      margin: 0;
    }

    .empty-state {
      text-align: center;
      padding: 50px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .empty-icon {
      font-size: 4rem;
      color: var(--primary-light);
      margin-bottom: 20px;
    }

    .empty-state h2 {
      color: var(--dark);
      margin-bottom: 10px;
    }

    .empty-state p {
      color: #546e7a;
      margin-bottom: 30px;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
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
      box-shadow: 0 4px 10px rgba(198, 40, 40, 0.3);
    }

    .btn i {
      margin-right: 8px;
    }

    .btn:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(198, 40, 40, 0.4);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      box-shadow: none;
    }

    .btn-outline:hover {
      background: var(--primary);
      color: white;
    }

    /* Animation au chargement */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .action-card, .stat-card, .empty-state {
      animation: fadeIn 0.6s ease-out forwards;
      opacity: 0;
    }

    .action-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(1) { animation-delay: 0.2s; }
    .stat-card:nth-child(2) { animation-delay: 0.3s; }
    .empty-state { animation-delay: 0.4s; }
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
      <a href="#" class="nav-link"><i class="fas fa-bell"></i> Notifications</a>
      <a href="{{ route('logout') }}" class="nav-link"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
    </div>
  </nav>

  <div class="content">
    <div class="welcome-banner">
      <h1>Bienvenue dans votre espace Professeur</h1>
      <p>Gérez vos ressources pédagogiques et suivez l'activité de vos élèves en temps réel</p>
    </div>

    <div class="horizontal-section">
      <div class="action-card" onclick="window.location.href='{{ route('videos.index') }}'">
        <div class="action-content">
          <div class="action-icon"><i class="fas fa-video"></i></div>
          <h3>Mes Vidéos</h3>
        </div>
      </div>

      <div class="action-card" onclick="window.location.href='{{ route('qcm.index') }}'">
        <div class="action-content">
          <div class="action-icon"><i class="fas fa-question-circle"></i></div>
          <h3>Gestion QCM</h3>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <h3>Élèves actifs</h3>
          <div class="stat-value">0</div>
          <p class="stat-description">Utilisation cette semaine</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon"><i class="fas fa-film"></i></div>
          <h3>Vidéos publiées</h3>
          <div class="stat-value">0</div>
          <p class="stat-description">Ressources partagées</p>
        </div>
      </div>
    </div>

    <div class="empty-state">
      <div class="empty-icon"><i class="fas fa-video-slash"></i></div>
      <h2>Aucune vidéo récente</h2>
      <p>Vous n'avez pas encore ajouté de vidéos à votre espace. Commencez par créer votre première ressource pédagogique.</p>
      
      @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #c3e6cb;">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif
      
      @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #f5c6cb;">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif
      
      @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #f5c6cb;">
          <i class="fas fa-exclamation-circle"></i> 
          <ul style="margin: 5px 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      
      <!-- Formulaire d'upload de vidéo -->
      <form id="videoForm" action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="file" id="videoInput" name="video" accept="video/*">
      </form>
      
      <button class="btn" id="uploadBtn">
        <i class="fas fa-plus"></i> Ajouter une vidéo
      </button>
      
      <div id="uploadStatus" style="margin-top: 20px;"></div>
    </div>
  </div>

  <!-- Modal de prévisualisation -->
  <div id="previewModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 10px; width: 70%; max-width: 700px; text-align: center;">
      <h2><i class="fas fa-video"></i> Prévisualisation</h2>
      <video id="videoPreview" controls style="width: 100%; max-height: 60vh; margin: 15px 0;"></video>
      <div id="fileInfo"></div>
      <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
        <button class="btn" id="confirmUpload">
          <i class="fas fa-share-square"></i> Publier
        </button>
        <button class="btn" id="cancelUpload">
          <i class="fas fa-times"></i> Annuler
        </button>
      </div>
    </div>
  </div>

  <script>
    // Animation des cartes au survol
    document.querySelectorAll('.action-card, .stat-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        const icon = this.querySelector('.action-icon, .stat-icon');
        icon.style.transform = 'scale(1.1) rotate(5deg)';
        icon.style.color = 'var(--primary-light)';
      });
      
      card.addEventListener('mouseleave', function() {
        const icon = this.querySelector('.action-icon, .stat-icon');
        icon.style.transform = 'scale(1) rotate(0)';
        icon.style.color = 'var(--primary)';
      });
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

        // Gestion de l'upload
    const uploadBtn = document.getElementById('uploadBtn');
    const videoInput = document.getElementById('videoInput');
    const videoForm = document.getElementById('videoForm');
    const previewModal = document.getElementById('previewModal');
    const videoPreview = document.getElementById('videoPreview');
    const fileInfo = document.getElementById('fileInfo');
    const confirmUpload = document.getElementById('confirmUpload');
    const cancelUpload = document.getElementById('cancelUpload');
    const uploadStatus = document.getElementById('uploadStatus');

    uploadBtn.addEventListener('click', () => {
      videoInput.click();
    });

    videoInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const file = this.files[0];
        
        // Vérification de la taille (2MB max - limite serveur actuelle)
        if (file.size > 2 * 1024 * 1024) {
            showStatus('La vidéo ne doit pas dépasser 2MB (limite serveur actuelle)', 'error');
            this.value = ''; // Réinitialise le champ
            return;
        }
        
        // Vérification du type
        if (!file.type.match('video.*')) {
          showStatus('Veuillez sélectionner un fichier vidéo valide', 'error');
          this.value = '';
          return;
        }
        
        // Prévisualisation
        const videoURL = URL.createObjectURL(file);
        videoPreview.src = videoURL;
        
        fileInfo.innerHTML = `
          <p><strong>Nom :</strong> ${file.name}</p>
          <p><strong>Taille :</strong> ${formatFileSize(file.size)}</p>
          <p><strong>Type :</strong> ${file.type}</p>
        `;
        
        previewModal.style.display = 'flex';
      }
    });

    confirmUpload.addEventListener('click', () => {
      previewModal.style.display = 'none';
      showStatus('<i class="fas fa-spinner fa-spin"></i> Publication en cours...', 'loading');
      
      // Soumettre le formulaire
      videoForm.submit();
      
      // Recharger les statistiques après un délai
      setTimeout(() => {
        loadStats();
      }, 2000);
    });

    cancelUpload.addEventListener('click', () => {
      previewModal.style.display = 'none';
      videoInput.value = '';
    });

    function showStatus(message, type) {
      uploadStatus.innerHTML = `<p style="color: ${type === 'error' ? 'var(--primary)' : type === 'success' ? 'green' : 'inherit'}">${message}</p>`;
    }

    function formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB', 'GB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2) + ' ' + sizes[i]);
    }

    // Les statistiques sont maintenant chargées côté serveur via le middleware
    // Pas besoin de JavaScript pour les charger


  </script>
</body>
</html>