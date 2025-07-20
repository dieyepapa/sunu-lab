<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Espace Professeur - SUNU-LAB</title>
  <style>
    :root {
      --primary: #667eea;
      --primary-light: #7c8ff0;
      --primary-dark: #5a6fd8;
      --secondary: #764ba2;
      --secondary-light: #8a6bb1;
      --dark: #2d3748;
      --light: #f7fafc;
      --accent: #f093fb;
      --success: #4facfe;
      --warning: #43e97b;
      --error: #fa709a;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #333;
      line-height: 1.6;
    }

    /* Navigation */
    .navbar {
      background: linear-gradient(to right, var(--primary), var(--secondary));
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

    /* Style pour le bouton de déconnexion */
    .logout-button {
      background: none !important;
      border: none !important;
      width: 100% !important;
      text-align: left !important;
      padding: 10px 15px !important;
      border-radius: 50px !important;
      transition: all 0.3s !important;
      font-weight: 500 !important;
      display: flex !important;
      align-items: center !important;
      cursor: pointer !important;
      color: white !important;
      text-decoration: none !important;
    }

    .logout-button:hover {
      background: rgba(255, 255, 255, 0.2) !important;
      transform: translateY(-2px) !important;
    }

    /* Contenu principal */
    .content {
      margin-top: 70px;
      padding: 30px;
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Bannière de bienvenue */
    .welcome-banner {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 40px;
      border-radius: 20px;
      margin-bottom: 40px;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
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

    /* Grille principale */
    .main-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    /* Section des simulations */
    .simulations-section {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
      border-radius: 25px;
      padding: 40px;
      border: 1px solid rgba(102, 126, 234, 0.1);
      position: relative;
      overflow: hidden;
    }

    .simulations-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(to right, var(--primary), var(--secondary));
    }

    .section-description {
      color: #666;
      font-size: 1.1rem;
      margin-bottom: 30px;
      text-align: center;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .simulations-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .simulation-card {
      background: white;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      cursor: pointer;
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
    }

    .simulation-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(to right, var(--primary), var(--primary-light));
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .simulation-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
      border-color: var(--primary-light);
    }

    .simulation-card:hover::before {
      transform: scaleX(1);
    }

    .simulation-icon {
      font-size: 3rem;
      color: var(--primary);
      margin-bottom: 20px;
      transition: all 0.3s ease;
      text-align: center;
    }

    .simulation-card:hover .simulation-icon {
      transform: scale(1.1) rotate(5deg);
      color: var(--primary-light);
    }

    .simulation-content h3 {
      font-size: 1.3rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 12px;
      text-align: center;
    }

    .simulation-content p {
      color: #666;
      font-size: 0.95rem;
      line-height: 1.6;
      text-align: center;
      margin-bottom: 15px;
    }

    .simulation-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: linear-gradient(135deg, var(--success), #43e97b);
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      animation: pulse 2s infinite;
    }

    /* Section des fonctionnalités */
    .features-section {
      background: linear-gradient(135deg, rgba(118, 75, 162, 0.05) 0%, rgba(102, 126, 234, 0.05) 100%);
      border-radius: 25px;
      padding: 40px;
      border: 1px solid rgba(118, 75, 162, 0.1);
      position: relative;
      overflow: hidden;
    }

    .features-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(to right, var(--secondary), var(--primary));
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
    }

    .feature-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      cursor: pointer;
      border: 2px solid transparent;
      position: relative;
      overflow: hidden;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(to right, var(--secondary), var(--secondary-light));
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 20px 40px rgba(118, 75, 162, 0.15);
      border-color: var(--secondary-light);
    }

    .feature-card:hover::before {
      transform: scaleX(1);
    }

    .feature-icon {
      font-size: 3.5rem;
      color: var(--secondary);
      margin-bottom: 20px;
      transition: all 0.3s ease;
      text-align: center;
    }

    .feature-card:hover .feature-icon {
      transform: scale(1.1) rotate(-5deg);
      color: var(--secondary-light);
    }

    .feature-content h3 {
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 15px;
      text-align: center;
    }

    .feature-content p {
      color: #666;
      font-size: 1rem;
      line-height: 1.6;
      text-align: center;
      margin-bottom: 25px;
    }

    .feature-action {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      color: var(--secondary);
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    .feature-card:hover .feature-action {
      color: var(--secondary-light);
      transform: translateX(5px);
    }

    .feature-action i {
      transition: transform 0.3s ease;
    }

    .feature-card:hover .feature-action i {
      transform: translateX(5px);
    }

    /* Section des statistiques */
    .stats-section {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 25px;
    }

    .stat-card {
      text-align: center;
      padding: 20px;
      border-radius: 12px;
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      border: 1px solid #dee2e6;
    }

    .stat-icon {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 15px;
    }

    .stat-value {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 5px;
    }

    .stat-label {
      color: #666;
      font-size: 0.9rem;
      font-weight: 500;
    }

    /* Section des ressources récentes */
    .recent-resources {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .resource-item {
      display: flex;
      align-items: center;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 15px;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .resource-item:hover {
      background: #e9ecef;
      transform: translateX(5px);
    }

    .resource-icon {
      font-size: 1.5rem;
      color: var(--primary);
      margin-right: 15px;
      width: 40px;
      text-align: center;
    }

    .resource-info {
      flex: 1;
    }

    .resource-title {
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 5px;
    }

    .resource-meta {
      font-size: 0.85rem;
      color: #666;
    }

    /* Section d'upload de vidéo */
    .upload-section {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      text-align: center;
    }

    .upload-area {
      border: 3px dashed #dee2e6;
      border-radius: 15px;
      padding: 40px;
      margin: 20px 0;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .upload-area:hover {
      border-color: var(--primary);
      background: #f8f9fa;
    }

    .upload-icon {
      font-size: 3rem;
      color: var(--primary-light);
      margin-bottom: 15px;
    }

    .upload-text {
      color: #666;
      margin-bottom: 20px;
    }

    /* Messages de statut */
    .status-message {
      padding: 15px;
      border-radius: 10px;
      margin: 20px 0;
      display: flex;
      align-items: center;
    }

    .status-message.success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .status-message.error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .status-message i {
      margin-right: 10px;
    }

    /* Boutons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 24px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn i {
      margin-right: 8px;
    }

    .btn:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.8);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 20px;
      width: 90%;
      max-width: 600px;
      text-align: center;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .modal-title {
      font-size: 1.5rem;
      color: var(--dark);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-title i {
      margin-right: 10px;
      color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-grid {
        grid-template-columns: 1fr;
      }
      
      .actions-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .welcome-banner h1 {
        font-size: 2rem;
      }
      
      .welcome-banner p {
        max-width: 100%;
      }
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .action-card, .stat-card, .resource-item {
      animation: fadeInUp 0.6s ease-out forwards;
    }

    .action-card:nth-child(1) { animation-delay: 0.1s; }
    .action-card:nth-child(2) { animation-delay: 0.2s; }
    .action-card:nth-child(3) { animation-delay: 0.3s; }
    .action-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(1) { animation-delay: 0.5s; }
    .stat-card:nth-child(2) { animation-delay: 0.6s; }
    .stat-card:nth-child(3) { animation-delay: 0.7s; }
    .stat-card:nth-child(4) { animation-delay: 0.8s; }

    /* Animation pulse pour le badge */
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    /* Animations d’apparition */
    .simulation-card, .feature-card {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 0.7s cubic-bezier(0.23, 1, 0.32, 1) forwards;
    }
    .simulation-card { animation-delay: 0.1s; }
    .feature-card { animation-delay: 0.2s; }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Animation sur le champ de recherche */
    #search-simulation {
      transition: box-shadow 0.3s, border-color 0.3s;
    }
    #search-simulation:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
    }
    #search-simulation:hover {
      border-color: var(--primary-light);
    }

    /* Animation sur le titre de section */
    .section-title {
      position: relative;
      overflow: hidden;
      animation: sectionPop 0.8s cubic-bezier(0.23, 1, 0.32, 1);
    }
    @keyframes sectionPop {
      0% { opacity: 0; transform: scale(0.95); }
      60% { opacity: 1; transform: scale(1.05); }
      100% { opacity: 1; transform: scale(1); }
    }

    /* Transition douce lors du filtrage */
    .simulation-card, .feature-card {
      transition: opacity 0.3s, transform 0.3s;
    }
    .simulation-card.hide, .feature-card.hide {
      opacity: 0 !important;
      transform: translateY(30px) scale(0.98) !important;
      pointer-events: none;
      height: 0 !important;
      margin: 0 !important;
      padding: 0 !important;
      border: none !important;
    }

    /* Hover plus marqué */
    .simulation-card:hover, .feature-card:hover {
      box-shadow: 0 16px 40px rgba(102,126,234,0.18), 0 2px 8px rgba(102,126,234,0.08);
      transform: translateY(-14px) scale(1.03);
      z-index: 2;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/notifications.js') }}" defer></script>
</head>
<body>
    @if(!isset($stats))
      <div style="background: red; color: white; padding: 10px; font-size: 1.2em;">
        Erreur : la variable $stats n'est pas transmise à la vue.
      </div>
    @endif
    <!-- Sidebar simulations -->
    <div class="sidebar" style="position: fixed; left: 0; top: 0; width: 250px; height: 100vh; background: linear-gradient(to bottom, var(--dark), #1a202c); color: white; padding-top: 30px; box-shadow: 2px 0 20px rgba(0,0,0,0.2); z-index: 100;">
      <h2 style="text-align: center; margin-bottom: 40px; font-size: 1.5rem; position: relative;">Simulations</h2>
      <a href="/circulation-sanguin" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-heartbeat" style="margin-right: 10px;"></i> Circuit Sanguin</a>
      <a href="/digestion-enzymatique" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-utensils" style="margin-right: 10px;"></i> Digestion Enzymatique</a>
      <a href="/cycle-fecondation" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-dna" style="margin-right: 10px;"></i> Fécondation</a>
      <a href="/respiration-cellulaire" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-lungs" style="margin-right: 10px;"></i> Respiration Cellulaire</a>
      <a href="/mitose-cellulaire" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-divide" style="margin-right: 10px;"></i> Mitose</a>
      <a href="/transmission-nerveuse" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-brain" style="margin-right: 10px;"></i> Transmission Nerveuse</a>
      <a href="/tectonique" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-globe" style="margin-right: 10px;"></i> Tectonique</a>
      <a href="/photosynthese" style="display: flex; align-items: center; padding: 15px 25px; color: var(--light); text-decoration: none; transition: all 0.3s; margin: 5px 10px; border-radius: 5px;"><i class="fas fa-leaf" style="margin-right: 10px;"></i> Photosynthèse</a>
    </div>

    <!-- Navigation -->
    <nav class="navbar" style="margin-left: 250px;">
      <div class="navbar-brand">
        <i class="fas fa-flask"></i>
        <span>SUNU-LAB</span>
      </div>
      <div class="nav-links">
        <a href="#" class="nav-link" id="notificationBtn">
          <i class="fas fa-bell"></i>Envoyer Notifications
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
          @csrf
          <button type="submit" class="nav-link logout-button">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
          </button>
        </form>
      </div>
    </nav>

    <!-- Contenu principal -->
    <div class="content" style="margin-left: 250px;">
      <!-- Bannière de bienvenue -->
      <div class="welcome-banner">
        <h1>Bienvenue dans votre espace Professeur</h1>
        <p>Gérez vos ressources pédagogiques, créez des simulations interactives et suivez l'activité de vos élèves</p>
      </div>
      <!-- (Section simulations supprimée ici) -->
      <!-- Grille principale -->
      <div class="main-grid">
        <!-- Section des Fonctionnalités -->
        <div class="features-section">
          <h2 class="section-title">
            <i class="fas fa-tools"></i>
            Outils Pédagogiques
          </h2>
          <p class="section-description">Gérez vos ressources et créez du contenu interactif pour vos élèves</p>
          
          <div class="features-grid">
            <div class="feature-card" onclick="window.location.href='{{ route('videos.index') }}'">
              <div class="feature-icon">
                <i class="fas fa-video"></i>
              </div>
              <div class="feature-content">
                <h3>Gérer les Vidéos</h3>
                <p>Upload, organisez et partagez vos ressources vidéo avec vos élèves</p>
                <div class="feature-action">
                  <span>Accéder</span>
                  <i class="fas fa-arrow-right"></i>
                </div>
              </div>
            </div>

            <div class="feature-card" onclick="window.location.href='{{ route('qcm.index') }}'">
              <div class="feature-icon">
                <i class="fas fa-question-circle"></i>
              </div>
              <div class="feature-content">
                <h3>Créer des QCM</h3>
                <p>Concevez des questionnaires interactifs pour évaluer vos élèves</p>
                <div class="feature-action">
                  <span>Accéder</span>
                  <i class="fas fa-arrow-right"></i>
                </div>
              </div>
            </div>
            <!-- Nouvelle carte Créer Simulation -->
            <div class="feature-card" onclick="window.location.href='{{ route('simulations.create') }}'">
              <div class="feature-icon">
                <i class="fas fa-cubes"></i>
              </div>
              <div class="feature-content">
                <h3>Ajoutez Simulation</h3>
                <p>Créez des simulations interactives pour vos cours</p>
                <div class="feature-action">
                  <span>Accéder</span>
                  <i class="fas fa-arrow-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-section">
          <h2 class="section-title">
            <i class="fas fa-chart-bar"></i>
            Statistiques
          </h2>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stat-value" data-stat="eleves_actifs">{{ $stats['eleves_actifs'] ?? 0 }}</div>
              <div class="stat-label">Élèves Actifs</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-film"></i>
              </div>
              <div class="stat-value" data-stat="videos_publiees">{{ $stats['videos_publiees'] ?? 0 }}</div>
              <div class="stat-label">Vidéos Publiées</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-question"></i>
              </div>
              <div class="stat-value" data-stat="qcm_crees">{{ $stats['qcm_crees'] ?? 0 }}</div>
              <div class="stat-label">QCM Créés</div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-cube"></i>
              </div>
              <div class="stat-value" data-stat="simulations">{{ $stats['simulations'] ?? 0 }}</div>
              <div class="stat-label">Simulations</div>
            </div>
          </div>
        </div>

        <!-- Upload de vidéo -->
        <div class="upload-section">
          <h2 class="section-title">
            <i class="fas fa-upload"></i>
            Ajouter une Ressource
          </h2>
          
          @if(session('success'))
            <div class="status-message success">
              <i class="fas fa-check-circle"></i>
              {{ session('success') }}
            </div>
          @endif
          
          @if(session('error'))
            <div class="status-message error">
              <i class="fas fa-exclamation-circle"></i>
              {{ session('error') }}
            </div>
          @endif
          
          @if($errors->any())
            <div class="status-message error">
              <i class="fas fa-exclamation-circle"></i>
              <ul style="margin: 5px 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Formulaire classique d'upload vidéo -->
          <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 30px;">
            @csrf
            <label for="videoInput" style="font-weight:600;">Sélectionnez une vidéo à publier :</label><br>
            <input type="file" id="videoInput" name="video" accept="video/*" required style="margin: 15px 0;">
            <br>
            <button type="submit" class="btn">
              <i class="fas fa-upload"></i> Publier la vidéo
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal de prévisualisation -->
    <div id="previewModal" class="modal">
      <div class="modal-content">
        <h3 class="modal-title">
          <i class="fas fa-video"></i>
          Prévisualisation de la Vidéo
        </h3>
        <video id="videoPreview" controls style="width: 100%; max-height: 60vh; margin: 15px 0; border-radius: 10px;"></video>
        <div id="fileInfo" style="margin: 15px 0; padding: 15px; background: #f8f9fa; border-radius: 10px;"></div>
        <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
          <button class="btn" id="confirmUpload">
            <i class="fas fa-share-square"></i> Publier
          </button>
          <button class="btn btn-outline" id="cancelUpload">
            <i class="fas fa-times"></i> Annuler
          </button>
        </div>
      </div>
    </div>

    <script>
      // Gestion de l'upload
      const uploadArea = document.getElementById('uploadArea');
      const videoInput = document.getElementById('videoInput');
      const videoForm = document.getElementById('videoForm');
      const previewModal = document.getElementById('previewModal');
      const videoPreview = document.getElementById('videoPreview');
      const fileInfo = document.getElementById('fileInfo');
      const confirmUpload = document.getElementById('confirmUpload');
      const cancelUpload = document.getElementById('cancelUpload');
      const uploadStatus = document.getElementById('uploadStatus');

      // Fonction pour mettre à jour les statistiques
      function updateStats() {
          fetch('/videos/stats')
              .then(response => response.json())
              .then(data => {
                  // Mettre à jour les statistiques avec animation
                  updateStatWithAnimation('eleves_actifs', data.eleves_actifs);
                  updateStatWithAnimation('videos_publiees', data.videos_publiees);
                  updateStatWithAnimation('qcm_crees', data.qcm_crees);
                  updateStatWithAnimation('simulations', data.simulations);
              })
              .catch(error => console.error('Erreur lors de la mise à jour des stats:', error));
      }

      // Fonction pour animer la mise à jour des statistiques
      function updateStatWithAnimation(statType, newValue) {
          const statElement = document.querySelector(`[data-stat="${statType}"]`);
          if (statElement) {
              const currentValue = parseInt(statElement.textContent);
              if (currentValue !== newValue) {
                  // Animation de mise à jour
                  statElement.style.transform = 'scale(1.2)';
                  statElement.style.color = '#4facfe';
                  setTimeout(() => {
                      statElement.textContent = newValue;
                      statElement.style.transform = 'scale(1)';
                      statElement.style.color = '';
                  }, 300);
              }
          }
      }

      // Mettre à jour les statistiques toutes les 30 secondes
      setInterval(updateStats, 30000);

      // Mettre à jour les statistiques après un upload réussi
      function onUploadSuccess() {
          setTimeout(updateStats, 1000); // Attendre 1 seconde puis mettre à jour
      }

      // Gestion du drag & drop
      uploadArea.addEventListener('dragover', (e) => {
          e.preventDefault();
          uploadArea.style.borderColor = 'var(--primary)';
          uploadArea.style.background = '#f8f9fa';
      });

      uploadArea.addEventListener('dragleave', (e) => {
          e.preventDefault();
          uploadArea.style.borderColor = '#dee2e6';
          uploadArea.style.background = 'white';
      });

      uploadArea.addEventListener('drop', (e) => {
          e.preventDefault();
          uploadArea.style.borderColor = '#dee2e6';
          uploadArea.style.background = 'white';
          
          const files = e.dataTransfer.files;
          if (files.length > 0) {
              handleFileSelect(files[0]);
          }
      });

      // Clic sur la zone d'upload
      uploadArea.addEventListener('click', () => {
          videoInput.click();
      });

      // Sélection de fichier
      videoInput.addEventListener('change', (e) => {
          if (e.target.files.length > 0) {
              handleFileSelect(e.target.files[0]);
          }
      });

      function handleFileSelect(file) {
          // Vérification du type de fichier
          if (!file.type.startsWith('video/')) {
              alert('Veuillez sélectionner un fichier vidéo valide.');
              return;
          }

          // Vérification de la taille (512MB)
          const maxSize = 512 * 1024 * 1024; // 512MB en octets
          if (file.size > maxSize) {
              alert('Le fichier est trop volumineux. Taille maximale : 512MB');
              return;
          }

          // Prévisualisation
          const url = URL.createObjectURL(file);
          videoPreview.src = url;
          
          // Informations sur le fichier
          const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
          fileInfo.innerHTML = `
              <strong>Nom:</strong> ${file.name}<br>
              <strong>Taille:</strong> ${sizeMB} MB<br>
              <strong>Type:</strong> ${file.type}
          `;
          
          previewModal.style.display = 'flex';
      }

      // Confirmation de l'upload
      confirmUpload.addEventListener('click', () => {
          const formData = new FormData();
          formData.append('video', videoInput.files[0]);
          formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

          uploadStatus.innerHTML = '<div style="color: var(--primary);"><i class="fas fa-spinner fa-spin"></i> Upload en cours...</div>';
          previewModal.style.display = 'none';

          fetch('/videos', {
              method: 'POST',
              body: formData
          })
          .then(response => response.text())
          .then(html => {
              // Redirection vers la page des vidéos
              window.location.href = '/videos';
              onUploadSuccess(); // Mettre à jour les statistiques
          })
          .catch(error => {
              uploadStatus.innerHTML = '<div style="color: var(--error);"><i class="fas fa-exclamation-circle"></i> Erreur lors de l\'upload</div>';
              console.error('Erreur:', error);
          });
      });

      // Annulation de l'upload
      cancelUpload.addEventListener('click', () => {
          previewModal.style.display = 'none';
          videoInput.value = '';
          videoPreview.src = '';
          fileInfo.innerHTML = '';
      });

      // Fermer le modal en cliquant à l'extérieur
      previewModal.addEventListener('click', (e) => {
          if (e.target === previewModal) {
              previewModal.style.display = 'none';
          }
      });

      // Animation d'entrée pour les cartes
      const observerOptions = {
          threshold: 0.1,
          rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  entry.target.style.opacity = '1';
                  entry.target.style.transform = 'translateY(0)';
              }
          });
      }, observerOptions);

      // Observer toutes les cartes d'action
      document.querySelectorAll('.simulation-card, .feature-card').forEach(card => {
          card.style.opacity = '0';
          card.style.transform = 'translateY(20px)';
          card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
          observer.observe(card);
      });

      // Animation au survol des cartes de simulation
      document.querySelectorAll('.simulation-card').forEach(card => {
          card.addEventListener('mouseenter', function() {
              const icon = this.querySelector('.simulation-icon');
              icon.style.transform = 'scale(1.1) rotate(5deg)';
              icon.style.color = 'var(--primary-light)';
          });
          
          card.addEventListener('mouseleave', function() {
              const icon = this.querySelector('.simulation-icon');
              icon.style.transform = 'scale(1) rotate(0)';
              icon.style.color = 'var(--primary)';
          });
      });

      // Animation au survol des cartes de fonctionnalités
      document.querySelectorAll('.feature-card').forEach(card => {
          card.addEventListener('mouseenter', function() {
              const icon = this.querySelector('.feature-icon');
              icon.style.transform = 'scale(1.1) rotate(-5deg)';
              icon.style.color = 'var(--secondary-light)';
          });
          
          card.addEventListener('mouseleave', function() {
              const icon = this.querySelector('.feature-icon');
              icon.style.transform = 'scale(1) rotate(0)';
              icon.style.color = 'var(--secondary)';
          });
      });

      // Filtrage des simulations (professeur)
      document.getElementById('search-simulation').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.simulation-card').forEach(card => {
          const title = card.querySelector('h3').textContent.toLowerCase();
          const desc = card.querySelector('p').textContent.toLowerCase();
          if(title.includes(query) || desc.includes(query)) {
            card.classList.remove('hide');
          } else {
            card.classList.add('hide');
          }
        });
      });
    </script>
</body>
</html>
