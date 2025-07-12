<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulation Cardiaque 3D Interactive</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #e63946;
      --secondary: #457b9d;
      --light: #f1faee;
      --dark: #1d3557;
      --accent1: #a8dadc;
      --accent2: #ff9e00;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
      color: var(--dark);
      overflow: hidden;
      height: 100vh;
    }
    
    #app-container {
      display: grid;
      grid-template-columns: 1fr 350px;
      height: 100vh;
    }
    
    /* Header stylisé */
    .header {
      grid-column: 1 / -1;
      background: linear-gradient(135deg, var(--primary) 0%, #c1121f 100%);
      color: white;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      z-index: 100;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .header-title {
      font-size: 1.5rem;
      font-weight: 700;
    }
    
    .header-subtitle {
      font-size: 1rem;
      opacity: 0.9;
    }
    
    .header-bpm {
      background: rgba(255,255,255,0.2);
      padding: 0.5rem 1.2rem;
      border-radius: 2rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    /* Conteneur 3D */
    #heart-container {
      position: relative;
      overflow: hidden;
    }
    
    #threejs-canvas {
      width: 100%;
      height: 100%;
      display: block;
    }
    
    .heart-rate-display {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: white;
      padding: 0.8rem 1.2rem;
      border-radius: 2rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 10;
      border: 2px solid var(--primary);
    }
    
    .heart-rate-value {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--primary);
    }
    
    .timer {
      font-family: 'Courier New', monospace;
      font-weight: 500;
    }
    
    /* Panneau de contrôle */
    .control-panel {
      background: white;
      border-left: 1px solid #e0e0e0;
      padding: 1.5rem;
      overflow-y: auto;
      box-shadow: -5px 0 15px rgba(0,0,0,0.05);
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    
    .panel-section {
      background: white;
      border-radius: 12px;
      padding: 1.2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border-left: 4px solid var(--primary);
    }
    
    .section-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .button-group {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    
    .btn {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.6rem 1rem;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .btn:hover {
      background: #c1121f;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .btn-secondary {
      background: var(--secondary);
    }
    
    .btn-secondary:hover {
      background: #315a7d;
    }
    
    .speed-control {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--light);
      padding: 0.8rem;
      border-radius: 8px;
    }
    
    .speed-btn {
      width: 2rem;
      height: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }
    
    .speed-value {
      min-width: 3rem;
      text-align: center;
      font-weight: 600;
    }
    
    /* Légende du sang */
    .blood-legend {
      display: flex;
      gap: 1rem;
      justify-content: center;
    }
    
    .blood-type {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--light);
      padding: 0.5rem 0.8rem;
      border-radius: 20px;
    }
    
    .blood-color {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    /* Graphique */
    .chart-container {
      width: 100%;
      height: 180px;
      position: relative;
      margin-top: 0.5rem;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #eee;
    }
    
    .chart-line {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 1px;
      background-color: #eee;
    }
    
    .chart-bar {
      position: absolute;
      bottom: 0;
      width: 8px;
      background: linear-gradient(to top, var(--primary), #ff6b6b);
      transition: height 0.3s ease;
      border-radius: 4px 4px 0 0;
    }
    
    .chart-labels {
      display: flex;
      justify-content: space-between;
      margin-top: 0.5rem;
      font-size: 0.8rem;
      color: #666;
    }
    
    /* Informations */
    .info-content {
      line-height: 1.6;
    }
    
    .info-content h4 {
      color: var(--primary);
      margin: 0.5rem 0;
    }
    
    /* Loading screen */
    #loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.8);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      color: white;
    }
    
    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      border-top: 5px solid white;
      animation: spin 1s linear infinite;
      margin-bottom: 1.5rem;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    /* Mode quiz */
    .quiz-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      z-index: 50;
      max-width: 500px;
      width: 90%;
      display: none;
    }
    
    .quiz-question {
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark);
    }
    
    .quiz-options {
      display: flex;
      flex-direction: column;
      gap: 0.7rem;
      margin-top: 1.5rem;
    }
    
    .quiz-option {
      padding: 0.8rem;
      background: var(--light);
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .quiz-option:hover {
      background: #d8e3e8;
    }
    
    .quiz-option.correct {
      background: #4caf50;
      color: white;
    }
    
    .quiz-option.incorrect {
      background: #f44336;
      color: white;
    }
    
    /* Highlight */
    .part-highlight {
      position: absolute;
      border: 2px dashed var(--accent2);
      border-radius: 8px;
      background: rgba(255, 158, 0, 0.1);
      z-index: 20;
      pointer-events: none;
      transition: all 0.3s ease;
    }
  </style>
</head>
<body>
  <div id="app-container">
    <header class="header">
      <div>
        <div class="header-title">
          <i class="fas fa-heartbeat"></i> Simulation Cardiaque 3D
        </div>
        <div class="header-subtitle">Projet de Soutenance - SVT 3ème</div>
      </div>
      <div class="header-bpm">
        <i class="fas fa-heart"></i>
        <span id="headerBpm">70 BPM</span>
      </div>
    </header>
    
    <main id="heart-container">
      <canvas id="threejs-canvas"></canvas>
      
      <div class="heart-rate-display">
        <div class="heart-rate-value" id="heartRate">70 BPM</div>
        <div class="timer" id="timer">01:00</div>
      </div>
      
      <div class="quiz-container" id="quizContainer">
        <div class="quiz-question" id="quizQuestion"></div>
        <div class="quiz-options" id="quizOptions"></div>
      </div>
    </main>
    
    <aside class="control-panel">
      <section class="panel-section">
        <h3 class="section-title">
          <i class="fas fa-sliders-h"></i> Contrôles
        </h3>
        <div class="button-group">
          <button id="startBtn" class="btn">
            <i class="fas fa-play"></i> Démarrer
          </button>
          <button id="pauseBtn" class="btn">
            <i class="fas fa-pause"></i> Pause
          </button>
          <button id="resetBtn" class="btn">
            <i class="fas fa-redo"></i> Réinitialiser
          </button>
        </div>
        
        <div class="speed-control">
          <span>Vitesse:</span>
          <button id="decreaseSpeed" class="btn speed-btn">
            <i class="fas fa-minus"></i>
          </button>
          <span class="speed-value" id="speedValue">1x</span>
          <button id="increaseSpeed" class="btn speed-btn">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </section>
      
      <section class="panel-section">
        <h3 class="section-title">
          <i class="fas fa-vial"></i> Légende
        </h3>
        <div class="blood-legend">
          <div class="blood-type">
            <div class="blood-color" style="background:#4169e1;"></div>
            <span>Sang désoxygéné</span>
          </div>
          <div class="blood-type">
            <div class="blood-color" style="background:#ff0000;"></div>
            <span>Sang oxygéné</span>
          </div>
        </div>
      </section>
      
      <section class="panel-section">
        <h3 class="section-title">
          <i class="fas fa-chart-line"></i> Activité cardiaque
        </h3>
        <div class="chart-container">
          <div class="chart-line"></div>
        </div>
        <div class="chart-labels">
          <span>0s</span>
          <span>15s</span>
          <span>30s</span>
          <span>45s</span>
          <span>60s</span>
        </div>
      </section>
      
      <section class="panel-section">
        <h3 class="section-title">
          <i class="fas fa-info-circle"></i> Informations
        </h3>
        <div class="info-content" id="infoDisplay">
          <p>Cliquez sur les différentes parties du cœur pour voir des informations détaillées.</p>
        </div>
        <div class="button-group" style="margin-top: 1rem;">
          <button id="quizBtn" class="btn btn-secondary">
            <i class="fas fa-question-circle"></i> Mode Quiz
          </button>
          <button id="guideBtn" class="btn">
            <i class="fas fa-compass"></i> Guide
          </button>
        </div>
      </section>
      
      <section class="panel-section" id="summaryPanel" style="display: none;">
        <h3 class="section-title">
          <i class="fas fa-clipboard-check"></i> Résumé
        </h3>
        <div class="info-content">
          <p><strong>Durée:</strong> <span id="durationDisplay">1 minute</span></p>
          <p><strong>Battements:</strong> <span id="totalBeats">70</span></p>
          <p><strong>Volume sanguin:</strong> <span id="bloodVolume">~5 litres</span></p>
          <h4 style="margin-top: 1rem;">Fonctionnement du cœur:</h4>
          <p>Le cœur est une pompe musculaire qui assure la circulation du sang dans tout le corps via deux circuits : pulmonaire et systémique.</p>
        </div>
      </section>
    </aside>
    
    <div id="loading-overlay">
      <div class="spinner"></div>
      <h2>Chargement de la simulation...</h2>
      <p>Veuillez patienter pendant le chargement du modèle 3D</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
  
  <script>
    // Configuration
    const config = {
      speed: 1,
      globuleCount: 40,
      isRunning: false,
      heartRate: 70,
      beatInterval: 857,
      totalBeats: 0,
      timeLeft: 60,
      timerInterval: null,
      heartbeatInterval: null,
      chartData: [],
      globules: [],
      heartParts: {},
      labels: [],
      quizMode: false,
      currentQuizQuestion: 0,
      quizQuestions: [
        {
          question: "Quelle partie du cœur reçoit le sang désoxygéné ?",
          options: ["Oreillette gauche", "Oreillette droite", "Ventricule gauche"],
          answer: 1,
          highlight: "rightAtrium"
        },
        {
          question: "Par quelle valve passe le sang pour aller de l'oreillette droite au ventricule droit ?",
          options: ["Valve mitrale", "Valve tricuspide", "Valve aortique"],
          answer: 1,
          highlight: "valveTricuspide"
        },
        {
          question: "Où le sang s'oxygène-t-il ?",
          options: ["Dans l'aorte", "Dans les poumons", "Dans le ventricule gauche"],
          answer: 1,
          highlight: "poumons"
        }
      ]
    };

    // Initialisation Three.js
    let scene, camera, renderer, heartModel, controls;
    let raycaster = new THREE.Raycaster();
    let mouse = new THREE.Vector2();
    let highlightBox;
    
    function initThreeJS() {
      // Créer la scène
      scene = new THREE.Scene();
      scene.background = new THREE.Color(0xf0f2f5);
      
      // Configurer la caméra
      camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
      camera.position.set(0, 5, 30);
      
      // Configurer le rendu
      renderer = new THREE.WebGLRenderer({ 
        antialias: true,
        canvas: document.getElementById('threejs-canvas')
      });
      renderer.setPixelRatio(window.devicePixelRatio);
      renderer.setSize(window.innerWidth, window.innerHeight);
      
      // Contrôles de la caméra
      controls = new THREE.OrbitControls(camera, renderer.domElement);
      controls.enableDamping = true;
      controls.dampingFactor = 0.25;
      controls.minDistance = 20;
      controls.maxDistance = 50;
      
      // Lumière
      const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
      scene.add(ambientLight);
      
      const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
      directionalLight.position.set(1, 1, 1);
      scene.add(directionalLight);
      
      // Créer une boîte de surbrillance
      const highlightGeometry = new THREE.BoxGeometry(1, 1, 1);
      const highlightMaterial = new THREE.MeshBasicMaterial({ 
        color: 0xff9e00,
        transparent: true,
        opacity: 0.3,
        wireframe: false
      });
      highlightBox = new THREE.Mesh(highlightGeometry, highlightMaterial);
      highlightBox.visible = false;
      scene.add(highlightBox);
      
      // Charger le modèle 3D du cœur
      loadHeartModel();
      
      // Gestion du redimensionnement
      window.addEventListener('resize', onWindowResize);
      
      // Gestion des clics
      window.addEventListener('click', onDocumentClick, false);
      
      // Commencer l'animation
      animate();
    }
    
    function loadHeartModel() {
      // Créer un cœur simplifié mais réaliste
      createRealisticHeart();
    }
    
    function createRealisticHeart() {
      const heartGroup = new THREE.Group();
      
      // Matériau semi-transparent
      const heartMaterial = new THREE.MeshPhongMaterial({
        color: 0xcc5555,
        transparent: true,
        opacity: 0.7,
        shininess: 30
      });
      
      // Oreillette droite
      const rightAtrium = createChamberGeometry(3, 2, 2);
      rightAtrium.position.set(-4, 3, 0);
      rightAtrium.rotation.z = Math.PI / 6;
      heartGroup.add(rightAtrium);
      config.heartParts.rightAtrium = rightAtrium;
      
      // Ventricule droit
      const rightVentricle = createChamberGeometry(2.5, 4, 3);
      rightVentricle.position.set(-3, -1, 0);
      heartGroup.add(rightVentricle);
      config.heartParts.rightVentricle = rightVentricle;
      
      // Oreillette gauche
      const leftAtrium = createChamberGeometry(3, 2, 2);
      leftAtrium.position.set(4, 3, 0);
      leftAtrium.rotation.z = -Math.PI / 6;
      heartGroup.add(leftAtrium);
      config.heartParts.leftAtrium = leftAtrium;
      
      // Ventricule gauche (plus gros et musclé)
      const leftVentricle = createChamberGeometry(3.5, 5, 3.5);
      leftVentricle.position.set(3, -1, 0);
      heartGroup.add(leftVentricle);
      config.heartParts.leftVentricle = leftVentricle;
      
      // Vaisseaux sanguins
      createBloodVessels(heartGroup);
      
      scene.add(heartGroup);
      heartModel = heartGroup;
      
      // Créer les étiquettes anatomiques
      createAnatomicalLabels();
      
      // Créer les globules sanguins
      createBloodCells();
      
      // Masquer l'écran de chargement
      document.getElementById('loading-overlay').style.display = 'none';
    }
    
    function createChamberGeometry(width, height, depth) {
      const shape = new THREE.Shape();
      shape.ellipse(0, 0, width, height * 0.7, 0, Math.PI * 2, false);
      
      const extrudeSettings = {
        steps: 2,
        depth: depth,
        bevelEnabled: true,
        bevelSize: 0.5,
        bevelThickness: 0.5
      };
      
      const geometry = new THREE.ExtrudeGeometry(shape, extrudeSettings);
      return new THREE.Mesh(
        geometry,
        new THREE.MeshPhongMaterial({
          color: 0xcc5555,
          transparent: true,
          opacity: 0.7,
          shininess: 30
        })
      );
    }
    
    function createBloodVessels(group) {
      const vesselMaterial = new THREE.MeshPhongMaterial({
        color: 0xaa3333,
        transparent: true,
        opacity: 0.7
      });
      
      // Veine cave
      const venaCava = createTubeGeometry([
        new THREE.Vector3(-4, 6, 0),
        new THREE.Vector3(-4, 4, 0)
      ], 1.5);
      group.add(venaCava);
      config.heartParts.venaCave = venaCava;
      
      // Artère pulmonaire
      const pulmonaryArtery = createTubeGeometry([
        new THREE.Vector3(-3, -3, 0),
        new THREE.Vector3(0, -5, 0),
        new THREE.Vector3(2, -6, 0)
      ], 1.3);
      group.add(pulmonaryArtery);
      config.heartParts.pulmonaryArtery = pulmonaryArtery;
      
      // Aorte
      const aorta = createTubeGeometry([
        new THREE.Vector3(3, 4, 0),
        new THREE.Vector3(3, 7, 0),
        new THREE.Vector3(0, 9, 0)
      ], 1.8);
      group.add(aorta);
      config.heartParts.aorta = aorta;
      
      // Valve tricuspide (symbolique)
      const valveTricuspide = new THREE.Mesh(
        new THREE.CircleGeometry(0.8, 32),
        new THREE.MeshBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0.5 })
      );
      valveTricuspide.position.set(-3.5, 1, 0);
      valveTricuspide.rotation.x = Math.PI / 2;
      group.add(valveTricuspide);
      config.heartParts.valveTricuspide = valveTricuspide;
      
      // Valve mitrale (symbolique)
      const valveMitrale = new THREE.Mesh(
        new THREE.CircleGeometry(0.8, 32),
        new THREE.MeshBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0.5 })
      );
      valveMitrale.position.set(3.5, 1, 0);
      valveMitrale.rotation.x = Math.PI / 2;
      group.add(valveMitrale);
      config.heartParts.valveMitrale = valveMitrale;
      
      // Zone des poumons (symbolique)
      const lungsArea = new THREE.Mesh(
        new THREE.SphereGeometry(3, 32, 32),
        new THREE.MeshBasicMaterial({ color: 0x88ccff, transparent: true, opacity: 0.2, visible: false })
      );
      lungsArea.position.set(0, -6, 0);
      group.add(lungsArea);
      config.heartParts.poumons = lungsArea;
    }
    
    function createTubeGeometry(points, radius) {
      const curve = new THREE.CatmullRomCurve3(points);
      const geometry = new THREE.TubeGeometry(curve, 64, radius, 32, false);
      return new THREE.Mesh(
        geometry,
        new THREE.MeshPhongMaterial({
          color: 0xaa3333,
          transparent: true,
          opacity: 0.7
        })
      );
    }
    
    function createAnatomicalLabels() {
      // Positions des étiquettes
      const labelPositions = {
        'Oreillette droite': new THREE.Vector3(-5, 3, 0),
        'Oreillette gauche': new THREE.Vector3(5, 3, 0),
        'Ventricule droit': new THREE.Vector3(-4, -1, 0),
        'Ventricule gauche': new THREE.Vector3(4, -1, 0),
        'Veine cave': new THREE.Vector3(-5, 5, 0),
        'Artère pulmonaire': new THREE.Vector3(-1, -4, 0),
        'Aorte': new THREE.Vector3(2, 6, 0),
        'Valve tricuspide': new THREE.Vector3(-3.5, 1, 2),
        'Valve mitrale': new THREE.Vector3(3.5, 1, 2),
        'Poumons': new THREE.Vector3(0, -6, 0)
      };
      
      // Créer des étiquettes pour chaque partie
      for (const [text, position] of Object.entries(labelPositions)) {
        const label = createTextLabel(text, position);
        scene.add(label);
        config.labels.push(label);
      }
    }
    
    function createTextLabel(text, position) {
      const canvas = document.createElement('canvas');
      canvas.width = 256;
      canvas.height = 128;
      const context = canvas.getContext('2d');
      
      // Fond de l'étiquette
      context.fillStyle = 'rgba(230, 57, 70, 0.85)';
      context.beginPath();
      context.roundRect(10, 10, canvas.width - 20, canvas.height - 20, 20);
      context.fill();
      
      // Texte
      context.font = 'Bold 18px Roboto';
      context.textAlign = 'center';
      context.fillStyle = 'white';
      
      // Diviser le texte si nécessaire
      const words = text.split(' ');
      if (words.length > 2) {
        const line1 = words.slice(0, 2).join(' ');
        const line2 = words.slice(2).join(' ');
        context.fillText(line1, canvas.width / 2, canvas.height / 2 - 5);
        context.fillText(line2, canvas.width / 2, canvas.height / 2 + 20);
      } else {
        context.fillText(text, canvas.width / 2, canvas.height / 2 + 10);
      }
      
      // Texture
      const texture = new THREE.CanvasTexture(canvas);
      
      // Sprite
      const material = new THREE.SpriteMaterial({ 
        map: texture,
        transparent: true
      });
      const sprite = new THREE.Sprite(material);
      sprite.position.copy(position);
      sprite.scale.set(5, 2.5, 1);
      sprite.userData = { text: text };
      
      return sprite;
    }
    
    function createBloodCells() {
      // Créer des sphères pour représenter les globules sanguins
      const bloodCells = [];
      
      // Sang désoxygéné (bleu)
      for (let i = 0; i < config.globuleCount / 2; i++) {
        const cell = new THREE.Mesh(
          new THREE.SphereGeometry(0.3, 16, 16),
          new THREE.MeshPhongMaterial({ 
            color: 0x4169e1,
            specular: 0x111111,
            shininess: 30
          })
        );
        cell.userData = { 
          type: 'deoxygenated', 
          progress: Math.random(),
          speed: 0.8 + Math.random() * 0.4
        };
        scene.add(cell);
        bloodCells.push(cell);
      }
      
      // Sang oxygéné (rouge)
      for (let i = 0; i < config.globuleCount / 2; i++) {
        const cell = new THREE.Mesh(
          new THREE.SphereGeometry(0.3, 16, 16),
          new THREE.MeshPhongMaterial({ 
            color: 0xff0000,
            specular: 0x111111,
            shininess: 30
          })
        );
        cell.userData = { 
          type: 'oxygenated', 
          progress: Math.random(),
          speed: 0.8 + Math.random() * 0.4
        };
        scene.add(cell);
        bloodCells.push(cell);
      }
      
      config.globules = bloodCells;
    }
    
    function animateBloodCells() {
      if (!config.isRunning) return;
      
      // Chemin du sang désoxygéné
      const deoxygenatedPath = [
        { pos: new THREE.Vector3(-6, 7, 0), part: 'veineCave' },
        { pos: new THREE.Vector3(-4, 5, 0), part: 'veineCave' },
        { pos: new THREE.Vector3(-4, 3, 0), part: 'oreilletteD' },
        { pos: new THREE.Vector3(-4, 1, 0), part: 'oreilletteD' },
        { pos: new THREE.Vector3(-3.5, 1, 0), part: 'valveTricuspide' },
        { pos: new THREE.Vector3(-3, 0, 0), part: 'ventriculeD' },
        { pos: new THREE.Vector3(-3, -2, 0), part: 'ventriculeD' },
        { pos: new THREE.Vector3(-2, -3, 0), part: 'arterePulmonaire' },
        { pos: new THREE.Vector3(0, -5, 0), part: 'arterePulmonaire' },
        { pos: new THREE.Vector3(2, -6, 0), part: 'poumons' }
      ];
      
      // Chemin du sang oxygéné
      const oxygenatedPath = [
        { pos: new THREE.Vector3(2, -6, 0), part: 'poumons' },
        { pos: new THREE.Vector3(4, -4, 0), part: 'veinePulmonaire' },
        { pos: new THREE.Vector3(4, 1, 0), part: 'oreilletteG' },
        { pos: new THREE.Vector3(3.5, 1, 0), part: 'valveMitrale' },
        { pos: new THREE.Vector3(3, 2, 0), part: 'ventriculeG' },
        { pos: new THREE.Vector3(3, 4, 0), part: 'ventriculeG' },
        { pos: new THREE.Vector3(3, 6, 0), part: 'aorte' },
        { pos: new THREE.Vector3(2, 8, 0), part: 'aorte' }
      ];
      
      config.globules.forEach((cell) => {
        const path = cell.userData.type === 'deoxygenated' ? deoxygenatedPath : oxygenatedPath;
        const pathIndex = Math.floor(cell.userData.progress * (path.length - 1));
        const nextIndex = (pathIndex + 1) % path.length;
        
        const pointA = path[pathIndex].pos;
        const pointB = path[nextIndex].pos;
        
        // Calculer la position intermédiaire
        const localProgress = (cell.userData.progress * (path.length - 1)) % 1;
        const position = new THREE.Vector3().lerpVectors(pointA, pointB, localProgress);
        
        // Mettre à jour la position de la cellule
        cell.position.copy(position);
        
        // Faire pulser les cellules dans les ventricules
        if (path[pathIndex].part.includes('ventricule')) {
          const scale = 1 + Math.sin(Date.now() * 0.01) * 0.3;
          cell.scale.set(scale, scale, scale);
        } else {
          cell.scale.set(1, 1, 1);
        }
        
        // Mettre à jour la progression
        cell.userData.progress += 0.002 * config.speed * cell.userData.speed;
        if (cell.userData.progress >= 1) {
          cell.userData.progress = 0;
          
          // Changer la couleur si c'est dans les poumons
          if (path[pathIndex].part === 'poumons') {
            cell.material.color.setHex(cell.userData.type === 'deoxygenated' ? 0xff0000 : 0x4169e1);
            cell.userData.type = cell.userData.type === 'deoxygenated' ? 'oxygenated' : 'deoxygenated';
          }
        }
        
        // Stocker la partie actuelle pour les infobulles
        cell.userData.currentPart = path[pathIndex].part;
      });
    }
    
    function animateHeartbeat() {
      if (!config.isRunning || !heartModel) return;
      
      // Faire pulser le cœur
      const beatIntensity = Math.sin(Date.now() * 0.01 * config.speed) * 0.03;
      const scale = 1 + beatIntensity;
      
      heartModel.scale.set(scale, scale, scale);
      
      // Faire pulser les ventricules plus intensément
      if (config.heartParts.leftVentricle && config.heartParts.rightVentricle) {
        const ventricleScale = 1 + beatIntensity * 3;
        config.heartParts.leftVentricle.scale.set(ventricleScale, ventricleScale, ventricleScale);
        config.heartParts.rightVentricle.scale.set(ventricleScale, ventricleScale, ventricleScale);
      }
    }
    
    function highlightHeartPart(partName) {
      if (!config.heartParts[partName]) return;
      
      const part = config.heartParts[partName];
      const box = new THREE.Box3().setFromObject(part);
      const size = box.getSize(new THREE.Vector3());
      const center = box.getCenter(new THREE.Vector3());
      
      highlightBox.position.copy(center);
      highlightBox.scale.set(size.x + 0.5, size.y + 0.5, size.z + 0.5);
      highlightBox.visible = true;
      
      // Animation de surbrillance
      highlightBox.material.opacity = 0.3;
      const fadeOut = () => {
        highlightBox.material.opacity -= 0.01;
        if (highlightBox.material.opacity > 0) {
          requestAnimationFrame(fadeOut);
        } else {
          highlightBox.visible = false;
        }
      };
      
      setTimeout(fadeOut, 1000);
    }
    
    function startQuizMode() {
      config.quizMode = true;
      config.currentQuizQuestion = 0;
      document.getElementById('quizContainer').style.display = 'block';
      showQuizQuestion();
    }
    
    function showQuizQuestion() {
      if (config.currentQuizQuestion >= config.quizQuestions.length) {
        endQuizMode();
        return;
      }
      
      const question = config.quizQuestions[config.currentQuizQuestion];
      document.getElementById('quizQuestion').textContent = question.question;
      
      const optionsContainer = document.getElementById('quizOptions');
      optionsContainer.innerHTML = '';
      
      question.options.forEach((option, index) => {
        const optionElement = document.createElement('div');
        optionElement.className = 'quiz-option';
        optionElement.textContent = option;
        optionElement.addEventListener('click', () => checkQuizAnswer(index));
        optionsContainer.appendChild(optionElement);
      });
      
      // Mettre en surbrillance la partie concernée
      highlightHeartPart(question.highlight);
    }
    
    function checkQuizAnswer(answerIndex) {
      const question = config.quizQuestions[config.currentQuizQuestion];
      const options = document.querySelectorAll('.quiz-option');
      
      if (answerIndex === question.answer) {
        options[answerIndex].classList.add('correct');
        document.getElementById('infoDisplay').innerHTML = `
          <h4 style="color:#4caf50;"><i class="fas fa-check"></i> Bonne réponse !</h4>
          <p>${getPartDescription(question.highlight)}</p>
        `;
      } else {
        options[answerIndex].classList.add('incorrect');
        options[question.answer].classList.add('correct');
        document.getElementById('infoDisplay').innerHTML = `
          <h4 style="color:#f44336;"><i class="fas fa-times"></i> Réponse incorrecte</h4>
          <p>La bonne réponse était: ${question.options[question.answer]}</p>
          <p>${getPartDescription(question.highlight)}</p>
        `;
      }
      
      // Passer à la question suivante après un délai
      setTimeout(() => {
        config.currentQuizQuestion++;
        showQuizQuestion();
      }, 3000);
    }
    
    function endQuizMode() {
      config.quizMode = false;
      document.getElementById('quizContainer').style.display = 'none';
      
      document.getElementById('infoDisplay').innerHTML = `
        <h4 style="color:var(--primary);"><i class="fas fa-award"></i> Quiz terminé !</h4>
        <p>Vous avez complété le quiz sur le fonctionnement du cœur.</p>
      `;
    }
    
    function onWindowResize() {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    }
    
    function onDocumentClick(event) {
      if (config.quizMode) return;
      
      // Calculer la position de la souris
      mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
      mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
      
      // Mettre à jour le rayon
      raycaster.setFromCamera(mouse, camera);
      
      // Calculer les objets intersectés
      const intersects = raycaster.intersectObjects(scene.children, true);
      
      if (intersects.length > 0) {
        const clickedObject = intersects[0].object;
        showHeartPartInfo(clickedObject);
      }
    }
    
    function showHeartPartInfo(object) {
      let partName = '';
      let description = '';
      
      // Vérifier si c'est une étiquette
      if (object.userData && object.userData.text) {
        partName = object.userData.text;
        description = getPartDescription(getEnglishPartName(partName));
        highlightHeartPart(getEnglishPartName(partName));
      }
      // Vérifier si c'est une partie du cœur
      else if (object.parent === heartModel || object === heartModel) {
        for (const [key, value] of Object.entries(config.heartParts)) {
          if (object === value) {
            partName = getFrenchPartName(key);
            description = getPartDescription(key);
            highlightHeartPart(key);
            break;
          }
        }
      }
      // Vérifier si c'est un globule sanguin
      else if (config.globules.includes(object)) {
        partName = 'Globule sanguin';
        description = getPartDescription(object.userData.currentPart);
        highlightHeartPart(object.userData.currentPart);
      }
      
      if (partName) {
        document.getElementById('infoDisplay').innerHTML = `
          <h4 style="color:var(--primary);"><i class="fas fa-heartbeat"></i> ${partName}</h4>
          <p>${description}</p>
        `;
      }
    }
    
    function getEnglishPartName(frenchName) {
      const parts = {
        'Oreillette droite': 'rightAtrium',
        'Oreillette gauche': 'leftAtrium',
        'Ventricule droit': 'rightVentricle',
        'Ventricule gauche': 'leftVentricle',
        'Veine cave': 'venaCave',
        'Artère pulmonaire': 'pulmonaryArtery',
        'Aorte': 'aorta',
        'Valve tricuspide': 'valveTricuspide',
        'Valve mitrale': 'valveMitrale',
        'Poumons': 'poumons'
      };
      return parts[frenchName] || frenchName;
    }
    
    function getFrenchPartName(englishName) {
      const parts = {
        'rightAtrium': 'Oreillette droite',
        'rightVentricle': 'Ventricule droit',
        'leftAtrium': 'Oreillette gauche',
        'leftVentricle': 'Ventricule gauche',
        'venaCave': 'Veine cave',
        'pulmonaryArtery': 'Artère pulmonaire',
        'aorta': 'Aorte',
        'valveTricuspide': 'Valve tricuspide',
        'valveMitrale': 'Valve mitrale',
        'poumons': 'Poumons'
      };
      return parts[englishName] || englishName;
    }
    
    function getPartDescription(part) {
      const descriptions = {
        'rightAtrium': "L'oreillette droite reçoit le sang désoxygéné de tout le corps par les veines caves et le transmet au ventricule droit via la valve tricuspide.",
        'rightVentricle': "Le ventricule droit propulse le sang désoxygéné vers les poumons via l'artère pulmonaire lors de la contraction ventriculaire (systole).",
        'leftAtrium': "L'oreillette gauche reçoit le sang oxygéné des poumons par les veines pulmonaires et le transmet au ventricule gauche via la valve mitrale.",
        'leftVentricle': "Le ventricule gauche propulse le sang oxygéné dans tout le corps via l'aorte. Sa paroi musculaire est la plus épaisse car elle doit générer une pression suffisante pour la circulation systémique.",
        'venaCave': "Les veines caves (supérieure et inférieure) ramènent le sang désoxygéné de la circulation systémique vers l'oreillette droite.",
        'pulmonaryArtery': "L'artère pulmonaire transporte le sang désoxygéné du ventricule droit vers les poumons où il sera oxygéné.",
        'aorta': "L'aorte est la plus grande artère du corps. Elle distribue le sang oxygéné à tous les organes via la circulation systémique.",
        'valveTricuspide': "La valve tricuspide, composée de trois feuillets, empêche le reflux du sang du ventricule droit vers l'oreillette droite pendant la systole ventriculaire.",
        'valveMitrale': "La valve mitrale (ou bicuspide), composée de deux feuillets, empêche le reflux du sang du ventricule gauche vers l'oreillette gauche pendant la systole.",
        'poumons': "Dans les alvéoles pulmonaires, le sang se débarrasse du dioxyde de carbone (CO2) et se charge en oxygène (O2) par diffusion gazeuse."
      };
      return descriptions[part] || "Cliquez sur différentes parties du cœur pour en savoir plus sur leur fonction dans la circulation sanguine.";
    }
    
    function animate() {
      requestAnimationFrame(animate);
      
      // Animer les globules sanguins
      animateBloodCells();
      
      // Animer le battement cardiaque
      animateHeartbeat();
      
      // Mettre à jour les contrôles orbitaux
      controls.update();
      
      // Rendu
      renderer.render(scene, camera);
    }
    
    function init() {
      initThreeJS();
      setupEventListeners();
      updateTimerDisplay();
      updateSpeedDisplay();
      initChart();
    }
    
    function startTimer() {
      clearInterval(config.timerInterval);
      config.timeLeft = 60;
      updateTimerDisplay();
      
      config.timerInterval = setInterval(() => {
        config.timeLeft--;
        updateTimerDisplay();
        updateChart();
        
        if (config.timeLeft <= 0) {
          endSimulation();
        }
      }, 1000);
    }
    
    function updateTimerDisplay() {
      const minutes = Math.floor(config.timeLeft / 60);
      const seconds = config.timeLeft % 60;
      document.getElementById('timer').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    function updateSpeedDisplay() {
      document.getElementById('speedValue').textContent = `${config.speed}x`;
      const currentBPM = Math.round(config.heartRate * config.speed);
      document.getElementById('headerBpm').textContent = `${currentBPM} BPM`;
      document.getElementById('heartRate').textContent = `${currentBPM} BPM`;
    }
    
    function startHeartbeat() {
      clearInterval(config.heartbeatInterval);
      config.lastBeatTime = Date.now();
      config.totalBeats = 0;
      
      config.heartbeatInterval = setInterval(() => {
        config.totalBeats++;
      }, config.beatInterval / config.speed);
    }
    
    function initChart() {
      const container = document.querySelector('.chart-container');
      document.querySelectorAll('.chart-bar').forEach(el => el.remove());
      
      for (let i = 0; i < 60; i++) {
        const bar = document.createElement('div');
        bar.className = 'chart-bar';
        bar.style.left = `${(i / 60) * 100}%`;
        bar.style.height = '0px';
        container.appendChild(bar);
      }
      
      config.chartData = Array(60).fill(0);
    }
    
    function updateChart() {
      const currentSecond = 60 - config.timeLeft;
      const bars = document.querySelectorAll('.chart-bar');
      
      const baseActivity = 50 + Math.sin(currentSecond * 0.2) * 30;
      const speedEffect = config.speed * 15;
      const randomVariation = Math.random() * 10;
      const activity = baseActivity + speedEffect + randomVariation;
      
      config.chartData[currentSecond] = activity;
      
      bars.forEach((bar, index) => {
        if (index <= currentSecond) {
          const height = config.chartData[index] / 100 * 180;
          bar.style.height = `${height}px`;
          
          const intensity = Math.min(1, config.chartData[index] / 100);
          const red = 198 + Math.floor(57 * intensity);
          const green = 40 + Math.floor(80 * (1 - intensity));
          const blue = 40 + Math.floor(80 * (1 - intensity));
          bar.style.backgroundColor = `rgb(${red}, ${green}, ${blue})`;
        }
      });
    }
    
    function endSimulation() {
      config.isRunning = false;
      clearInterval(config.heartbeatInterval);
      clearInterval(config.timerInterval);
      
      document.getElementById('summaryPanel').style.display = 'block';
      document.getElementById('totalBeats').textContent = config.totalBeats;
      document.getElementById('bloodVolume').textContent = 
        `~${Math.round(config.totalBeats * 0.07)} litres`;
      
      document.getElementById('infoDisplay').innerHTML = `
        <h4 style="color:var(--primary);"><i class="fas fa-flag-checkered"></i> Simulation Terminée</h4>
        <p>En 1 minute, un cœur au repos (70 BPM) pompe environ 5 litres de sang.</p>
        <p>Les globules rouges ont parcouru tout le circuit sanguin du cœur.</p>
        <p><i class="fas fa-heartbeat"></i> Battements cardiaques totaux: ${config.totalBeats}</p>
      `;
    }
    
    function setupEventListeners() {
      document.getElementById('startBtn').addEventListener('click', () => {
        if (!config.isRunning) {
          config.isRunning = true;
          document.getElementById('summaryPanel').style.display = 'none';
          startHeartbeat();
          startTimer();
        }
      });
      
      document.getElementById('pauseBtn').addEventListener('click', () => {
        config.isRunning = false;
        clearInterval(config.heartbeatInterval);
        clearInterval(config.timerInterval);
      });
      
      document.getElementById('resetBtn').addEventListener('click', () => {
        config.isRunning = false;
        clearInterval(config.heartbeatInterval);
        clearInterval(config.timerInterval);
        config.timeLeft = 60;
        config.totalBeats = 0;
        config.speed = 1;
        updateTimerDisplay();
        updateSpeedDisplay();
        document.getElementById('summaryPanel').style.display = 'none';
        document.getElementById('infoDisplay').innerHTML = 
          '<p>Cliquez sur les différentes parties du cœur pour voir des informations.</p>';
        initChart();
      });
      
      document.getElementById('increaseSpeed').addEventListener('click', () => {
        if (config.speed < 3) {
          config.speed += 0.5;
          updateSpeedDisplay();
          if (config.isRunning) {
            startHeartbeat();
          }
        }
      });
      
      document.getElementById('decreaseSpeed').addEventListener('click', () => {
        if (config.speed > 0.5) {
          config.speed -= 0.5;
          updateSpeedDisplay();
          if (config.isRunning) {
            startHeartbeat();
          }
        }
      });
      
      document.getElementById('quizBtn').addEventListener('click', () => {
        startQuizMode();
      });
      
      document.getElementById('guideBtn').addEventListener('click', () => {
        document.getElementById('infoDisplay').innerHTML = `
          <h4 style="color:var(--primary);"><i class="fas fa-compass"></i> Guide d'Utilisation</h4>
          <ol style="padding-left: 1.2rem;">
            <li>Cliquez sur les parties du cœur pour voir leurs fonctions</li>
            <li>Utilisez le bouton "Démarrer" pour lancer la simulation</li>
            <li>Réglez la vitesse avec les boutons + et -</li>
            <li>Essayez le mode Quiz pour tester vos connaissances</li>
            <li>Tournez et zoomez avec la souris pour explorer le cœur</li>
          </ol>
        `;
      });
    }
    
    // Initialisation
    document.addEventListener('DOMContentLoaded', init);
  </script>
</body>
</html>