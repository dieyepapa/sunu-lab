<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LaboVirtuel SVT 3ème | Découvrez la science comme jamais</title>
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

    /* Reset et base */
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
      overflow-x: hidden;
    }

    /* Typographie */
    h1, h2, h3, h4 {
      font-weight: 700;
      line-height: 1.2;
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
      transition: all 0.3s ease;
    }

    .navbar.scrolled {
      padding: 10px 5%;
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 5px 30px rgba(198, 40, 40, 0.2);
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
      position: relative;
    }

    .nav-link:hover {
      color: var(--primary);
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 2px;
      background: var(--primary);
      transition: width 0.3s;
    }

    .nav-link:hover::after {
      width: 70%;
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
      box-shadow: 0 8px 25px rgba(198, 40, 40, 0.3);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
    }

    .btn-outline:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      min-height: 800px;
      background: linear-gradient(135deg, rgba(198, 40, 40, 0.9), rgba(142, 0, 0, 0.9)), 
                  url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
      display: flex;
      align-items: center;
      padding: 0 10%;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .hero-content {
      max-width: 600px;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      line-height: 1.1;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      margin-top: 40px;
    }

    .hero-image {
      position: absolute;
      right: 10%;
      width: 45%;
      max-width: 700px;
      border-radius: 20px;
      box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
      transform: perspective(1000px) rotateY(-15deg);
      transition: all 0.5s ease;
    }

    .hero-image:hover {
      transform: perspective(1000px) rotateY(-5deg);
    }

    /* Features Section */
    .features {
      padding: 100px 10%;
      background: white;
    }

    .section-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-header h2 {
      font-size: 2.5rem;
      color: var(--dark);
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }

    .section-header h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--primary);
    }

    .section-header p {
      max-width: 700px;
      margin: 0 auto;
      color: #666;
      font-size: 1.1rem;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 40px;
    }

    .feature-card {
      background: white;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      text-align: center;
      border-bottom: 4px solid transparent;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(198, 40, 40, 0.1);
      border-bottom-color: var(--primary);
    }

    .feature-icon {
      font-size: 3.5rem;
      color: var(--primary);
      margin-bottom: 25px;
      transition: all 0.3s;
    }

    .feature-card:hover .feature-icon {
      transform: scale(1.1);
      color: var(--primary-light);
    }

    .feature-card h3 {
      font-size: 1.5rem;
      margin-bottom: 15px;
      color: var(--dark);
    }

    .feature-card p {
      color: #666;
    }

    /* Simulations Section */
    .simulations {
      padding: 100px 10%;
      background: linear-gradient(to bottom, #f9f9f9, #f0f0f0);
    }

    .simulation-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      height: 350px;
    }

    .simulation-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 15px 40px rgba(198, 40, 40, 0.2);
    }

    .simulation-image {
      height: 200px;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .simulation-image::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(198, 40, 40, 0.2), rgba(198, 40, 40, 0.5));
      opacity: 0;
      transition: opacity 0.3s;
    }

    .simulation-card:hover .simulation-image::after {
      opacity: 1;
    }

    .simulation-content {
      padding: 25px;
    }

    .simulation-content h3 {
      font-size: 1.4rem;
      margin-bottom: 10px;
      color: var(--dark);
    }

    .simulation-content p {
      color: #666;
      margin-bottom: 20px;
    }

    .simulation-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: var(--primary);
      color: white;
      padding: 5px 15px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    /* Testimonials */
    .testimonials {
      padding: 100px 10%;
      background: white;
      text-align: center;
    }

    .testimonial-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      max-width: 800px;
      margin: 0 auto;
      position: relative;
    }

    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: 20px;
      left: 30px;
      font-size: 5rem;
      color: rgba(198, 40, 40, 0.1);
      font-family: Georgia, serif;
      line-height: 1;
    }

    .testimonial-text {
      font-size: 1.2rem;
      font-style: italic;
      color: #555;
      margin-bottom: 30px;
      position: relative;
      z-index: 1;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .author-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
      border: 3px solid var(--primary);
    }

    .author-info h4 {
      color: var(--dark);
      margin-bottom: 5px;
    }

    .author-info p {
      color: #777;
      font-size: 0.9rem;
    }

    /* CTA Section */
    .cta {
      padding: 100px 10%;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      text-align: center;
    }

    .cta h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .cta p {
      max-width: 700px;
      margin: 0 auto 40px;
      font-size: 1.1rem;
      opacity: 0.9;
    }

    /* Footer */
    .footer {
      background: var(--dark);
      color: white;
      padding: 60px 10% 30px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h3 {
      font-size: 1.3rem;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
    }

    .footer-column h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 40px;
      height: 3px;
      background: var(--primary);
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #bbb;
      text-decoration: none;
      transition: all 0.3s;
    }

    .footer-links a:hover {
      color: white;
      padding-left: 5px;
    }

    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 20px;
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
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #bbb;
      font-size: 0.9rem;
    }

    /* Animations */
    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-20px);
      }
    }

    .floating {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      animation: fadeIn 1s ease-out forwards;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding-top: 120px;
      }

      .hero-content {
        margin-bottom: 50px;
      }

      .hero-image {
        position: relative;
        right: auto;
        width: 80%;
        margin-top: 50px;
      }

      .hero-buttons {
        justify-content: center;
      }
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }

      .hero h1 {
        font-size: 2.5rem;
      }

      .section-header h2 {
        font-size: 2rem;
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
       <a href="{{ route('A-propos') }}" class="btn btn-outline">À propos</a>
       <a href="{{ route('labo') }}" class="btn btn-outline">Connexion</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content fade-in">
      <h1>Explorez les mystères de la SVT en 3ème</h1>
      <p>Découvrez notre laboratoire virtuel révolutionnaire qui transforme l'apprentissage des sciences en une expérience immersive et captivante.</p>
      <div class="hero-buttons">
        <a href="#" class="btn btn-primary">Commencer maintenant</a>
        <a href="#" class="btn btn-outline" style="color: white; border-color: white;">Voir la démo</a>
      </div>
    </div>
    <img src="https://images.unsplash.com/photo-1581094271901-8022df4466f9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Laboratoire virtuel" class="hero-image floating fade-in" style="animation-delay: 0.2s;">
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="section-header fade-in">
      <h2>Pourquoi choisir SUNU-LAB ?</h2>
      <p>Notre plateforme offre une expérience d'apprentissage unique spécialement conçue pour le programme de SVT en 3ème</p>
    </div>
    <div class="features-grid">
      <div class="feature-card fade-in" style="animation-delay: 0.1s;">
        <div class="feature-icon"><i class="fas fa-atom"></i></div>
        <h3>Expériences interactives</h3>
        <p>Manipulez des éléments virtuels comme en vrai avec nos simulations réalistes et pédagogiques.</p>
      </div>
      <div class="feature-card fade-in" style="animation-delay: 0.2s;">
        <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
        <h3>Conforme au programme</h3>
        <p>Toutes nos simulations sont alignées sur le programme officiel de SVT en classe de 3ème.</p>
      </div>
      <div class="feature-card fade-in" style="animation-delay: 0.3s;">
        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
        <h3>Suivi personnalisé</h3>
        <p>Visualisez vos progrès et obtenez des recommandations adaptées à votre niveau.</p>
      </div>
    </div>
  </section>

  <!-- Simulations Section -->
  <section class="simulations">
    <div class="section-header fade-in">
      <h2>Découvrez nos simulations phares</h2>
      <p>Explorez les concepts clés du programme à travers des expériences virtuelles captivantes</p>
    </div>
    <div class="features-grid">
      <div class="simulation-card fade-in" style="animation-delay: 0.1s;">
        <div class="simulation-image" style="background-image: url('images/sang.png');"></div>
        <div class="simulation-content">
          <span class="simulation-badge">Nouveau</span>
          <h3>La circulation sanguine</h3>
          <p>Suivez le trajet du sang dans le cœur et comprenez son rôle dans l'organisme.</p>
          <a href="#" class="btn btn-outline">Explorer</a>
        </div>
      </div>
      <div class="simulation-card fade-in" style="animation-delay: 0.2s;">
        <div class="simulation-image" style="background-image: url('https://images.unsplash.com/photo-1530026186672-2cd00ffc50fe?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
        <div class="simulation-content">
          <h3>La reproduction humaine</h3>
          <p>Explorez le processus de fécondation et le développement embryonnaire.</p>
          <a href="#" class="btn btn-outline">Explorer</a>
        </div>
      </div>
      <div class="simulation-card fade-in" style="animation-delay: 0.3s;">
        <div class="simulation-image" style="background-image: url('images/coeure.png');"></div>
        <div class="simulation-content">
          <h3>La respiration cellulaire</h3>
          <p>Plongez au cœur de la cellule pour comprendre les échanges gazeux.</p>
          <a href="#" class="btn btn-outline">Explorer</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials fade-in">
    <div class="section-header">
      <h2>Ce qu'en disent nos utilisateurs</h2>
      <p>Découvrez comment SUNU-LAB transforme l'apprentissage des sciences</p>
    </div>
    <div class="testimonial-card">
      <p class="testimonial-text">"Grâce à SUNU-LAB, mes élèves ont enfin pu visualiser des concepts abstraits comme la mitose ou la circulation sanguine. Leur compréhension et leurs résultats se sont considérablement améliorés."</p>
      <div class="testimonial-author">
        <img src="images/pr.png" alt="Professeure Dupont" class="author-avatar">
        <div class="author-info">
          <h4>Professeure Dieye</h4>
          <p>SVT, Collège Gandiole</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta fade-in">
    <h2>Prêt à révolutionner votre apprentissage des SVT ?</h2>
    <p>Rejoignez des milliers d'élèves et enseignants qui utilisent déjà SUNU-LAB pour une expérience scientifique immersive.</p>
    <a href="#" class="btn btn-outline" style="background: white; color: var(--primary);">Commencer gratuitement</a>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-grid">
      <div class="footer-column">
        <h3>SUNU-LAB</h3>
        <p>La plateforme de laboratoire virtuel qui révolutionne l'apprentissage des SVT en classe de 3ème.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="footer-column">
        <h3>Simulations</h3>
        <ul class="footer-links">
          <li><a href="#">Circuit Sanguin Cardiovasculaire</a></li>
          <li><a href="#">Processus Engimatique Digestif</a></li>
          <li><a href="#">Fecondation & Developpement Embryonnaire</a></li>
          <li><a href="#">Mitose</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Ressources</h3>
        <ul class="footer-links">
          <li><a href="#">Fiches de révision</a></li>
          <li><a href="#">Vidéos explicatives</a></li>
          <li><a href="#">Quiz interactifs</a></li>
          <li><a href="#">Annales corrigées</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Contact</h3>
        <ul class="footer-links">
          <li><a href="#">support@sunu-lab.com</a></li>
          <li><a href="#">76 210 17 94</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Nous rejoindre</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 SUNU-LAB. Tous droits réservés.</p>
    </div>
  </footer>

  <script>
     // Modifier le script pour gérer la redirection
    document.querySelectorAll('.btn-outline').forEach(button => {
      if (button.textContent.trim() === 'Connexion') {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          window.location.href = "{{ route('labo') }}";
        });
      }
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Animation on scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    
    const fadeObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = 1;
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => {
      fadeObserver.observe(el);
      el.style.opacity = 0;
      el.style.transform = 'translateY(30px)';
      el.style.transition = 'all 0.6s ease-out';
    });
  </script>
</body>
</html>