<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À propos | SUNU-LAB - Laboratoire Virtuel SVT 3ème</title>
  <style>
    :root {
      --primary: #667eea;
      --primary-light: #7c8ff0;
      --primary-dark: #5a6fd8;
      --dark: #263238;
      --light: #f5f5f5;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: var(--dark);
      background-color: #f9f9f9;
    }

    /* Navigation */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      padding: 15px 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      display: flex;
      align-items: center;
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--primary);
      text-decoration: none;
    }

    .logo i {
      margin-right: 10px;
      font-size: 2.2rem;
    }

    .nav-links {
      display: flex;
      gap: 25px;
    }

    .nav-link {
      color: var(--dark);
      text-decoration: none;
      font-weight: 600;
      padding: 8px 15px;
      border-radius: 50px;
      transition: all 0.3s;
    }

    .nav-link:hover {
      color: var(--primary);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 28px;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
      background: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-3px);
    }

    /* Main Content */
    .about-header {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(142, 0, 0, 0.9));
      color: white;
      text-align: center;
      padding: 150px 10% 100px;
      margin-bottom: 60px;
    }

    .about-header h1 {
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .about-header p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto;
      opacity: 0.9;
    }

    .about-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 5% 80px;
    }

    .about-section {
      margin-bottom: 60px;
      background: white;
      border-radius: 15px;
      padding: 50px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .about-section h2 {
      color: var(--primary);
      font-size: 2rem;
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 15px;
    }

    .about-section h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--primary);
    }

    .about-section p {
      margin-bottom: 20px;
      font-size: 1.1rem;
      line-height: 1.8;
    }

    .mission-vision {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 40px;
      margin-top: 40px;
    }

    .mission-card, .vision-card {
      background: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      border-left: 5px solid var(--primary);
    }

    .mission-card h3, .vision-card h3 {
      color: var(--primary);
      margin-bottom: 15px;
      font-size: 1.5rem;
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .team-member {
      text-align: center;
    }

    .team-member img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid var(--primary);
      margin-bottom: 20px;
    }

    .team-member h3 {
      color: var(--dark);
      margin-bottom: 5px;
    }

    .team-member p {
      color: #666;
      font-size: 0.9rem;
    }

    /* Footer */
    .footer {
      background: var(--dark);
      color: white;
      padding: 60px 10% 30px;
      text-align: center;
    }

    .footer p {
      margin-bottom: 20px;
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      color: white;
      transition: all 0.3s;
    }

    .social-links a:hover {
      background: var(--primary);
      transform: translateY(-3px);
    }

    .footer-bottom {
      padding-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #bbb;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .about-header {
        padding: 120px 5% 80px;
      }
      
      .about-section {
        padding: 30px;
      }
      
      .about-header h1 {
        font-size: 2.2rem;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar">
    <a href="#" class="logo">
      <i class="fas fa-flask"></i>
      <span>SUNU-LAB</span>
    </a>
    <div class="nav-links">
      <a href="{{ route('acceuil') }}" class="btn btn-primary">Retour</a>
      <a href="{{ route('labo') }}" class="btn btn-primary">Connexion</a>
    </div>
  </nav>

  <!-- Header -->
  <header class="about-header">
    <h1>À propos de SUNU-LAB</h1>
    <p>Découvrez notre mission, notre vision et notre engagement pour révolutionner l'apprentissage des SVT en classe de 3ème</p>
  </header>

  <!-- Main Content -->
  <div class="about-container">
    <section class="about-section">
      <h2>Notre Histoire</h2>
      <p>SUNU-LAB est né d'une passion commune pour l'éducation scientifique et des technologies innovantes. Fondé en 2025 par deux étudiants développeurs sénégalais, notre projet avait pour objectif initial de pallier le manque de matériel de laboratoire dans les écoles.</p>
      <p>Face au constat que de nombreux élèves de 3ème éprouvaient des difficultés à comprendre les concepts abstraits des Sciences de la Vie et de la Terre, nous avons conçu une plateforme qui rend l'apprentissage plus concret, interactif et accessible à tous.</p>
      <p>Aujourd'hui, SUNU-LAB est utilisé par des milliers d'élèves et enseignants à travers le Sénégal, transformant la manière d'enseigner et d'apprendre les SVT.</p>
    </section>

    <section class="about-section">
      <h2>Notre Mission & Vision</h2>
      <div class="mission-vision">
        <div class="mission-card">
          <h3>Notre Mission</h3>
          <p>Démocratiser l'accès à des expériences scientifiques de qualité grâce à la technologie, en permettant à chaque élève de 3ème d'explorer, d'expérimenter et de comprendre les concepts clés du programme de SVT, quel que soit son établissement scolaire.</p>
        </div>
        <div class="vision-card">
          <h3>Notre Vision</h3>
          <p>Devenir la référence en matière d'apprentissage interactif des sciences au Sénégal, en développant constamment de nouvelles simulations alignées sur les programmes éducatifs et les besoins des enseignants et élèves.</p>
        </div>
      </div>
    </section>

    <section class="about-section">
      <h2>Notre Approche Pédagogique</h2>
      <p>SUNU-LAB s'appuie sur trois piliers fondamentaux pour garantir une expérience d'apprentissage optimale :</p>
      
      <div class="mission-vision" style="margin-top: 30px;">
        <div class="mission-card">
          <h3><i class="fas fa-hand-pointer" style="margin-right: 10px;"></i>Interactivité</h3>
          <p>Nos simulations permettent aux élèves de manipuler des éléments virtuels, d'observer des phénomènes sous différents angles et de tester des hypothèses comme dans un vrai laboratoire.</p>
        </div>
        <div class="mission-card">
          <h3><i class="fas fa-book" style="margin-right: 10px;"></i>Conformité</h3>
          <p>Toutes nos ressources sont développées en étroite collaboration avec des enseignants de SVT pour garantir leur alignement parfait avec le programme officiel de 3ème.</p>
        </div>
        <div class="mission-card">
          <h3><i class="fas fa-user-graduate" style="margin-right: 10px;"></i>Accessibilité</h3>
          <p>Notre plateforme est conçue pour être intuitive et accessible à tous les élèves, quel que soit leur niveau initial en sciences.</p>
        </div>
      </div>
    </section>

    <section class="about-section">
      <h2>Notre Équipe</h2>
      <p>Derrière SUNU-LAB se trouve une équipe passionnée et multidisciplinaire, réunissant des enseignants expérimentés, des pédagogues et des experts en technologie éducative.</p>
      
      <div class="team-grid">
        <div class="team-member">
          <img src="images/tof.png" alt="Papa Ndiaye">
          <h3>Abdoulaye Dieye</h3>
          <p>Developpeur Fullstack</p>
          <p>Etudiant en Licence 3 a l'Universite Alioune Diop de Bambey</p>
        </div>
        
        <div class="team-member">
          <img src="images/toff.png">
          <h3>Ablaye Gueye</h3>
          <p>Developpeur Freelance</p>
          <p>Etudiant en Licence 3 a l' UADB</p>
        </div>
      </div>
    </section>

    <section class="about-section" style="text-align: center;">
      <h2>Prêt à essayer SUNU-LAB ?</h2>
      <p>Rejoignez la révolution de l'apprentissage des SVT dès aujourd'hui</p>
      <a href="{{ route('labo') }}" class="btn btn-primary" style="margin-top: 30px;">Commencer maintenant</a>
    </section>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p>SUNU-LAB - Laboratoire Virtuel SVT 3ème</p>
    <p>Révolutionnez votre manière d'apprendre et d'enseigner les sciences</p>
    
    <div class="social-links">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
    
    <div class="footer-bottom">
      <p>&copy; 2025 SUNU-LAB. Tous droits réservés.</p>
    </div>
  </footer>

  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
</body>
</html>
