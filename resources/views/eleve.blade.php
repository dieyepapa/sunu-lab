<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Espace Élève - Simulations Scientifiques</title>
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
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #333;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      background: linear-gradient(to bottom, var(--dark), #1a202c);
      color: white;
      padding-top: 30px;
      box-shadow: 2px 0 20px rgba(0,0,0,0.2);
      transition: all 0.3s;
      z-index: 100;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 1.5rem;
      position: relative;
    }

    .sidebar h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: var(--primary);
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 15px 25px;
      color: var(--light);
      text-decoration: none;
      transition: all 0.3s;
      margin: 5px 10px;
      border-radius: 5px;
    }

    .sidebar a i {
      margin-right: 10px;
      font-size: 1.1rem;
    }

    .sidebar a:hover {
      background: rgba(102, 126, 234, 0.2);
      transform: translateX(5px);
    }

    .content {
      margin-left: 250px;
      padding: 30px;
    }

    .welcome-banner {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 30px;
      border-radius: 15px;
      margin-bottom: 30px;
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
      font-size: 2.2rem;
      margin-bottom: 10px;
      text-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .welcome-banner p {
      position: relative;
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 30px;
    }

    .card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      overflow: hidden;
      position: relative;
      height: 280px;
    }

    .card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
    }

    .card-content {
      position: relative;
      z-index: 2;
      padding: 25px;
      height: 100%;
      display: flex;
      flex-direction: column;
      background: linear-gradient(to bottom, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
    }

    .card-icon {
      font-size: 3.5rem;
      margin-bottom: 15px;
      color: var(--primary);
      text-shadow: 0 2px 5px rgba(102, 126, 234, 0.2);
    }

    .card h3 {
      color: var(--dark);
      margin: 0 0 10px 0;
      font-size: 1.4rem;
    }

    .card p {
      color: #546e7a;
      margin: 0 0 20px 0;
      flex-grow: 1;
    }

    .btn-launch {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 20px;
      background: var(--primary);
      color: white;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s;
      border: none;
      cursor: pointer;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
      width: fit-content;
    }

    .btn-launch i {
      margin-left: 8px;
      transition: transform 0.3s;
    }

    .btn-launch:hover {
      background: var(--secondary);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-launch:hover i {
      transform: translateX(3px);
    }

    /* Styles d'arrière-plan animés pour chaque carte */
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0.15;
      z-index: 1;
      transition: all 0.5s;
    }

    .card:hover::before {
      opacity: 0.25;
      transform: scale(1.05);
    }

    .card-circulation::before {
      background-image: url('https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    .card-digestion::before {
      background-image: url('https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    .card-fecondation::before {
      background-image: url('https://images.unsplash.com/photo-1530026186672-2cd00ffc50fe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    .card-respiration::before {
      background-image: url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    .card-mitose::before {
      background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    .card-neurone::before {
      background-image: url('https://images.unsplash.com/photo-1535320903710-d993d3d77d29?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    }

    /* Animation au chargement */
    @keyframes cardEntrance {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      animation: cardEntrance 0.6s ease-out forwards;
      opacity: 0;
    }

    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
    .card:nth-child(5) { animation-delay: 0.5s; }
    .card:nth-child(6) { animation-delay: 0.6s; }

    /* Effet de vague sur le bouton */
    .btn-launch {
      position: relative;
      overflow: hidden;
    }

    .btn-launch::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 0;
      border-radius: 100%;
      transform: scale(1, 1) translate(-50%);
      transform-origin: 50% 50%;
    }

    .btn-launch:focus:not(:active)::after {
      animation: ripple 1s ease-out;
    }

    @keyframes ripple {
      0% {
        transform: scale(0, 0);
        opacity: 0.5;
      }
      100% {
        transform: scale(20, 20);
        opacity: 0;
      }
    }


    .card {
    height: 300px; /* Augmentation de la hauteur */
    overflow: visible; /* Permet au bouton de dépasser si nécessaire */
  }

  .card-content {
    position: relative;
    z-index: 2;
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: rgba(255,255,255,0.95);
    justify-content: space-between; /* Répartition optimale */
  }

  .btn-launch {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white !important;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1.1rem;
    border: 2px solid white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.5);
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    margin-top: auto; /* Pousse le bouton vers le bas */
    margin-bottom: 0;
    width: calc(100% - 40px); /* Largeur ajustée */
    position: absolute; /* Position absolue par rapport à la carte */
    bottom: 20px; /* Positionné 20px du bas */
    left: 20px; /* Alignement gauche */
    transition: all 0.3s ease;
    z-index: 10; /* Au-dessus de tout */
  }

  .card p {
    color: #424242;
    margin: 10px 0;
    font-size: 0.95rem;
    line-height: 1.5;
    padding-bottom: 60px; /* Espace réservé pour le bouton */
  }

  /* Ajustement spécifique pour les cartes avec texte long */
  .card-fecondation .card-content,
  .card-neurone .card-content {
    justify-content: flex-start;
  }

  .card-fecondation p,
  .card-neurone p {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Limite à 4 lignes */
    -webkit-box-orient: vertical;
  }

  @keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}
.btn-launch {
  animation: pulse 2s infinite 3s; /* Démarre après 3 secondes */
}
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/notifications-eleve.js') }}" defer></script>
</head>
<body>
  

  <div class="sidebar">
    <h2><i class="fas fa-user-graduate"></i> Mon Espace</h2>
    <a href="#"><i class="fas fa-play-circle"></i> Regarger Vidéos</a>
    
    <a href="#" id="notification-link"><i class="fas fa-bell"></i>Envoyer Notifications</a>
    
    <!-- Bouton de déconnexion -->
    <form method="POST" action="{{ route('logout') }}" style="margin-top: auto; padding: 0 20px 20px 20px;">
      @csrf
      <button type="submit" style="
        width: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.5);
      ">
        <i class="fas fa-sign-out-alt"></i>
        Déconnexion
      </button>
    </form>
  </div>

  <div class="content">
    <div class="welcome-banner">
       <h1>Bienvenue dans l'espace Eleve</h1>
      <p>Explorez les mystères du corps humain à travers nos simulations interactives en haute définition</p>
    </div>

    <!-- Champ de recherche -->
    <div style="margin-bottom: 25px; text-align: right;">
      <input id="search-simulation" type="text" placeholder="Rechercher une simulation..." style="padding: 10px 18px; border-radius: 25px; border: 1px solid #ccc; font-size: 1rem; min-width: 260px; outline: none; box-shadow: 0 2px 8px rgba(102,126,234,0.05);">
    </div>

    <div class="card-grid">
      <!-- Carte 1 : Circulation sanguine -->
      <div class="card card-circulation" onclick="window.location.href='/circulation-sanguin'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-heartbeat"></i></div>
          <h3>Circuit Sanguin Cardiovasculaire</h3>
          <p>Visualisez le trajet du sang dans les cavités cardiaques avec animation 3D temps réel</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 2 : Digestion enzymatique -->
      <div class="card card-digestion" onclick="window.location.href='/digestion-enzymatique'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-utensils"></i></div>
          <h3>Processus Enzymatique Digestif</h3>
          <p>Simulation moléculaire de la décomposition des nutriments par les enzymes</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 3 : Fécondation humaine -->
      <div class="card card-fecondation" onclick="window.location.href='/cycle-fecondation'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-dna"></i></div>
          <h3>Fécondation & Développement Embryonnaire</h3>
          <p>Parcours interactif de la rencontre gamétique à la nidation</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 4 : Respiration cellulaire -->
      <div class="card card-respiration" onclick="window.location.href='/respiration-cellulaire'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-lungs"></i></div>
          <h3>Échanges Gazeux Cellulaires</h3>
          <p>Modélisation microscopique des processus respiratoires mitochondriaux</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 5 : Mitose -->
      <div class="card card-mitose" onclick="window.location.href='/mitose-cellulaire'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-divide"></i></div>
          <h3>Cycle Mitotique Complet</h3>
          <p>Phases de division cellulaire avec annotations dynamiques</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 6 : Transmission nerveuse -->
      <div class="card card-neurone" onclick="window.location.href='/transmission-nerveuse'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-brain"></i></div>
          <h3>Neurotransmission Synaptique</h3>
          <p>Simulation électrochimique du potentiel d'action neuronal</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- carte 7 : La tectenonique des plaques-->
      <div class="card card-neurone" onclick="window.location.href='/tectonique' ">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-brain"></i></div>
          <h3>Tectenonique des plaques</h3>
          <p>Simulation de la tectonique des plaques</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>

      <!-- Carte 8 : photosynthese -->
      <div class="card card-mitose" onclick="window.location.href='/photosynthese'">
        <div class="card-content">
          <div class="card-icon"><i class="fas fa-leaf"></i></div>
          <h3>La Photosynthèse</h3>
          <p>la photosynthèse</p>
          <button class="btn-launch">Executer <i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Effet de vague amélioré
    document.querySelectorAll('.btn-launch').forEach(button => {
      button.addEventListener('click', function(e) {
        e.stopPropagation();
        
        // Effet de pulsation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
          this.style.transform = 'scale(1)';
        }, 150);
        
        // Redirection après un léger délai pour l'effet
        setTimeout(() => {
          const card = this.closest('.card');
          if(card) {
            window.location.href = card.getAttribute('onclick').match(/window\.location\.href='([^']+)'/)[1];
          }
        }, 300);
      });
    });

    // Animation au survol des cartes
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        const icon = this.querySelector('.card-icon');
        icon.style.transform = 'scale(1.1) rotate(5deg)';
        icon.style.color = 'var(--primary-light)';
      });
      
      card.addEventListener('mouseleave', function() {
        const icon = this.querySelector('.card-icon');
        icon.style.transform = 'scale(1) rotate(0)';
        icon.style.color = 'var(--primary)';
      });
    });
  </script>

  <script>
    // Filtrage des simulations
    document.getElementById('search-simulation').addEventListener('input', function() {
      const query = this.value.toLowerCase();
      document.querySelectorAll('.card').forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const desc = card.querySelector('p').textContent.toLowerCase();
        if(title.includes(query) || desc.includes(query)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  </script>

  <script>
    // Le script de notification est maintenant géré par notifications-eleve.js
    // L'ancien script a été remplacé par un système plus moderne et robuste
  </script>
</body>
</html>
