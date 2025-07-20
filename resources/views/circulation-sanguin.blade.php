<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Le Cœur Humain - 3ème</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary: #667eea;
      --secondary: #764ba2;
      --light: #f7fafc;
      --dark: #2d3748;
      --accent: #f093fb;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f5f7fa;
      color: var(--dark);
      line-height: 1.6;
    }
    
    #app-container {
      display: grid;
      grid-template-columns: 1fr;
      height: 100vh;
    }
    
    .header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      padding: 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .header-title {
      font-size: 1.5rem;
      font-weight: 700;
    }
    
    .content {
      display: grid;
      grid-template-columns: 1fr 300px;
      height: calc(100vh - 60px);
    }
    
    .heart-section {
      position: relative;
      overflow: auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .heart-image-container {
      position: relative;
      max-width: 100%;
      margin: 20px 0 20px 150px;
    }
    
    .heart-image {
      max-width: 100%;
      height: auto;
      border: 2px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .heart-annotation {
      position: absolute;
      background-color: rgba(102, 126, 234, 0.8);
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      z-index: 10;
    }
    
    .heart-annotation:hover {
      background-color: var(--primary);
      transform: scale(1.05);
    }
    
    /* Contrôles en haut à gauche */
    .simulation-controls {
      position: absolute;
      top: 20px;
      left: 20px;
      background: white;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      z-index: 20;
      display: flex;
      flex-direction: column;
      gap: 8px;
      align-items: flex-start;
      min-width: 120px;
    }
    
    .timer-display {
      font-family: 'Courier New', monospace;
      font-weight: bold;
      background: #f5f5f5;
      padding: 5px 10px;
      border-radius: 4px;
      width: 100%;
      text-align: center;
      margin-top: 5px;
    }
    
    .control-panel {
      background: white;
      border-left: 1px solid #e0e0e0;
      padding: 1rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    
    .panel-section {
      background: white;
      border-radius: 8px;
      padding: 1rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      border-left: 4px solid var(--primary);
    }
    
    .section-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .button-group {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
      margin-top: 1rem;
    }
    
    .btn {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.9rem;
    }
    
    .btn:hover {
      background: var(--secondary);
      transform: translateY(-2px);
    }
    
    .btn-secondary {
      background: var(--secondary);
    }
    
    .btn-secondary:hover {
      background: #5a4a8a;
    }
    
    .btn-small {
      padding: 0.4rem 0.8rem;
      font-size: 0.8rem;
    }
    
    .info-content {
      font-size: 0.95rem;
    }
    
    .info-content h4 {
      color: var(--primary);
      margin: 0.5rem 0;
      font-size: 1rem;
    }
    
    /* Styles pour le quiz */
    .quiz-container {
      display: none;
      background: white;
      padding: 1rem;
      border-radius: 8px;
      margin-top: 1rem;
    }
    
    .quiz-question {
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark);
      font-size: 1rem;
    }
    
    .quiz-options {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .quiz-option {
      padding: 0.7rem;
      background: #f5f5f5;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 0.9rem;
    }
    
    .quiz-option:hover {
      background: #e0e0e0;
    }
    
    .quiz-option.correct {
      background: #4caf50;
      color: white;
    }
    
    .quiz-option.incorrect {
      background: #f44336;
      color: white;
    }
    
    .quiz-feedback {
      margin-top: 1rem;
      padding: 0.8rem;
      border-radius: 6px;
      display: none;
    }
    
    .feedback-correct {
      background: #e8f5e9;
      color: #2e7d32;
      border-left: 4px solid #4caf50;
    }
    
    .feedback-incorrect {
      background: #ffebee;
      color: #667eea;
      border-left: 4px solid #f44336;
    }
    
    /* Animation de battement */
    @keyframes heartbeat {
      0% { transform: scale(1); }
      25% { transform: scale(1.03); }
      50% { transform: scale(1); }
      75% { transform: scale(1.02); }
      100% { transform: scale(1); }
    }
    
    .heartbeat {
      animation: heartbeat 1s infinite;
    }
    
    /* Animation du sang */
    .blood-flow {
      position: absolute;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      z-index: 5;
    }
    
    .oxygenated {
      background-color: #ff0000;
    }
    
    .deoxygenated {
      background-color: #4169e1;
    }
    
    /* Contrôles de vitesse */
    .speed-control {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      gap: 0.5rem;
    }
    
    .speed-btn {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
      font-size: 0.8rem;
    }
    
    .speed-value {
      min-width: 30px;
      text-align: center;
      font-weight: 600;
      font-size: 0.9rem;
    }
    
    /* Résumé de simulation */
    .simulation-summary {
      display: none;
      background: white;
      padding: 1rem;
      border-radius: 8px;
      margin-top: 1rem;
      border-left: 4px solid var(--primary);
    }

    @media (max-width: 768px) {
      .content {
        grid-template-columns: 1fr;
      }
      
      .simulation-controls {
        flex-direction: row;
        flex-wrap: wrap;
        width: calc(100% - 40px);
        top: 10px;
        left: 10px;
      }
      
      .heart-image-container {
        margin-left: 20px;
        margin-top: 80px;
      }
      
      .control-panel {
        border-left: none;
        border-top: 1px solid #e0e0e0;
      }
    }
  </style>
</head>
<body>
  <div id="app-container">
    <header class="header">
      <div class="header-title">
        <i class="fas fa-heartbeat"></i> Le Cœur Humain - Niveau 3ème
      </div>
    </header>
    
    <div class="content">
      <main class="heart-section">
        <!-- Contrôles en haut à gauche -->
        <div class="simulation-controls">
          <button id="startBtn" class="btn btn-small">
            <i class="fas fa-play"></i> Démarrer
          </button>
          <button id="pauseBtn" class="btn btn-small">
            <i class="fas fa-pause"></i> Pause
          </button>
          <button id="resetBtn" class="btn btn-small">
            <i class="fas fa-redo"></i> Réinit.
          </button>
          
          <div class="speed-control">
            <button id="decreaseSpeed" class="btn speed-btn btn-small">
              <i class="fas fa-minus"></i>
            </button>
            <span class="speed-value" id="speedValue">1x</span>
            <button id="increaseSpeed" class="btn speed-btn btn-small">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          
          <div class="timer-display" id="timer">01:00</div>
        </div>
        
        <div class="heart-image-container">
          <!-- Image annotée du coeur -->
          <img src="/images/coeure.png" alt="Cœur humain" class="heart-image" id="heartImage">
          
          <!-- Annotations des parties du coeur -->
          <div class="heart-annotation" style="top: 20%; left: 25%;" data-part="rightAtrium">Oreillette droite</div>
          <div class="heart-annotation" style="top: 20%; left: 60%;" data-part="leftAtrium">Oreillette gauche</div>
          <div class="heart-annotation" style="top: 45%; left: 25%;" data-part="rightVentricle">Ventricule droit</div>
          <div class="heart-annotation" style="top: 45%; left: 60%;" data-part="leftVentricle">Ventricule gauche</div>
          <div class="heart-annotation" style="top: 15%; left: 15%;" data-part="venaCava">Veine cave</div>
          <div class="heart-annotation" style="top: 35%; left: 10%;" data-part="pulmonaryArtery">Artère pulmonaire</div>
          <div class="heart-annotation" style="top: 10%; left: 65%;" data-part="aorta">Aorte</div>
          
          <!-- Points pour la circulation sanguine (seront ajoutés dynamiquement) -->
        </div>
        
        <!-- Bouton du quiz -->
        <div class="button-group">
          <button id="quizBtn" class="btn btn-secondary">
            <i class="fas fa-question-circle"></i> Testez vos connaissances
          </button>
        </div>
        
        <!-- Conteneur du quiz -->
        <div class="quiz-container" id="quizContainer">
          <div class="quiz-question" id="quizQuestion"></div>
          <div class="quiz-options" id="quizOptions"></div>
          <div class="quiz-feedback" id="quizFeedback"></div>
          <div class="button-group">
            <button id="nextQuestionBtn" class="btn" style="display: none;">
              <i class="fas fa-arrow-right"></i> Question suivante
            </button>
          </div>
        </div>
        
        <!-- Résumé de simulation -->
        <div class="simulation-summary panel-section" id="simulationSummary">
          <h3 class="section-title">
            <i class="fas fa-clipboard-check"></i> Résumé
          </h3>
          <div class="info-content" id="summaryContent">
            <!-- Rempli dynamiquement -->
          </div>
        </div>
      </main>
      
      <aside class="control-panel">
        <section class="panel-section">
          <h3 class="section-title">
            <i class="fas fa-info-circle"></i> Informations
          </h3>
          <div class="info-content" id="infoDisplay">
            <p>Cliquez sur les différentes parties du cœur pour apprendre leur rôle dans la circulation sanguine.</p>
            <div id="partInfo" style="display: none;">
              <h4 id="partName"></h4>
              <p id="partDescription"></p>
              <p>
                <span class="blood-flow deoxygenated" style="display: inline-block;"></span>
                <span class="blood-flow oxygenated" style="display: inline-block;"></span>
                Sens de circulation du sang
              </p>
            </div>
          </div>
        </section>
        
        <section class="panel-section">
          <h3 class="section-title">
            <i class="fas fa-book"></i> Le Saviez-vous ?
          </h3>
          <div class="info-content" id="funFacts">
            <p>Le cœur bat environ 100 000 fois par jour !</p>
            <p>Il pompe 5 litres de sang chaque minute.</p>
            <p>Le sang met seulement 20 secondes pour faire le tour complet du corps.</p>
          </div>
        </section>
        
        <section class="panel-section">
          <h3 class="section-title">
            <i class="fas fa-tint"></i> Légende
          </h3>
          <div class="info-content">
            <p><span class="blood-flow oxygenated" style="display: inline-block;"></span> Sang oxygéné (riche en O₂)</p>
            <p><span class="blood-flow deoxygenated" style="display: inline-block;"></span> Sang désoxygéné (riche en CO₂)</p>
          </div>
        </section>
      </aside>
    </div>
  </div>

  <script>
    // Données pédagogiques adaptées au niveau 3ème
    const heartData = {
      rightAtrium: {
        name: "Oreillette droite",
        description: "Reçoit le sang pauvre en oxygène (bleu) qui revient des organes par les veines caves. Ce sang va ensuite passer dans le ventricule droit.",
        hasOxygenated: false,
        hasDeoxygenated: true
      },
      leftAtrium: {
        name: "Oreillette gauche",
        description: "Reçoit le sang riche en oxygène (rouge) qui vient des poumons. Ce sang va ensuite passer dans le ventricule gauche.",
        hasOxygenated: true,
        hasDeoxygenated: false
      },
      rightVentricle: {
        name: "Ventricule droit",
        description: "Pompe le sang pauvre en oxygène vers les poumons par l'artère pulmonaire pour qu'il se recharge en oxygène.",
        hasOxygenated: false,
        hasDeoxygenated: true
      },
      leftVentricle: {
        name: "Ventricule gauche",
        description: "Pompe le sang riche en oxygène vers tous les organes du corps par l'aorte. C'est la partie la plus musclée du cœur.",
        hasOxygenated: true,
        hasDeoxygenated: false
      },
      venaCava: {
        name: "Veine cave",
        description: "Ramène le sang pauvre en oxygène des organes vers l'oreillette droite. Il existe deux veines caves : supérieure et inférieure.",
        hasOxygenated: false,
        hasDeoxygenated: true
      },
      pulmonaryArtery: {
        name: "Artère pulmonaire",
        description: "Transporte le sang pauvre en oxygène du ventricule droit vers les poumons. C'est la seule artère qui transporte du sang bleu.",
        hasOxygenated: false,
        hasDeoxygenated: true
      },
      aorta: {
        name: "Aorte",
        description: "Transporte le sang riche en oxygène du ventricule gauche vers tout le corps. C'est la plus grosse artère du corps humain.",
        hasOxygenated: true,
        hasDeoxygenated: false
      }
    };

    // Questions pour le quiz adaptées au niveau 3ème
    const quizQuestions = [
      {
        question: "Quelle partie du cœur reçoit le sang bleu (pauvre en oxygène) ?",
        options: [
          "Oreillette gauche",
          "Oreillette droite", 
          "Ventricule gauche"
        ],
        answer: 1,
        explanation: "C'est l'oreillette droite qui reçoit le sang bleu revenant des organes par les veines caves."
      },
      {
        question: "Par où passe le sang pour aller des poumons vers le cœur ?",
        options: [
          "Par l'artère pulmonaire",
          "Par les veines pulmonaires",
          "Par l'aorte"
        ],
        answer: 1,
        explanation: "Les veines pulmonaires ramènent le sang rouge (riche en oxygène) des poumons vers l'oreillette gauche."
      },
      {
        question: "Quelle est la partie la plus musclée du cœur ?",
        options: [
          "L'oreillette droite",
          "Le ventricule gauche",
          "L'oreillette gauche"
        ],
        answer: 1,
        explanation: "Le ventricule gauche est très musclé car il doit envoyer le sang avec force dans tout le corps."
      },
      {
        question: "Quelle valve sépare l'oreillette droite du ventricule droit ?",
        options: [
          "Valve mitrale",
          "Valve tricuspide",
          "Valve aortique"
        ],
        answer: 1,
        explanation: "La valve tricuspide (à 3 feuillets) empêche le sang de refluer dans le mauvais sens."
      }
    ];

    // Variables d'état
    let currentQuestionIndex = 0;
    let quizScore = 0;
    let isQuizActive = false;
    let isSimulationRunning = false;
    let simulationSpeed = 1;
    let timeLeft = 60; // 1 minute
    let timerInterval;
    let heartbeatInterval;
    let bloodCells = [];
    let totalBeats = 0;

    // Points de parcours pour la circulation sanguine
    const bloodPath = [
      // Sang désoxygéné (bleu)
      { x: 15, y: 15, type: 'deoxygenated' },   // Veine cave
      { x: 25, y: 20, type: 'deoxygenated' },   // Oreillette droite
      { x: 25, y: 30, type: 'deoxygenated' },   // Valve tricuspide
      { x: 25, y: 45, type: 'deoxygenated' },   // Ventricule droit
      { x: 15, y: 50, type: 'deoxygenated' },   // Artère pulmonaire
      { x: 10, y: 60, type: 'deoxygenated' },   // Poumons (transformation)
      
      // Sang oxygéné (rouge)
      { x: 60, y: 60, type: 'oxygenated' },     // Poumons -> veines pulmonaires
      { x: 60, y: 45, type: 'oxygenated' },     // Ventricule gauche
      { x: 60, y: 30, type: 'oxygenated' },     // Valve mitrale
      { x: 60, y: 20, type: 'oxygenated' },     // Oreillette gauche
      { x: 65, y: 10, type: 'oxygenated' }      // Aorte
    ];

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
      setupAnnotations();
      setupEventListeners();
      updateSpeedDisplay();
      createBloodCells();
    });

    function setupAnnotations() {
      // Ajouter les événements aux annotations
      document.querySelectorAll('.heart-annotation').forEach(annotation => {
        const part = annotation.getAttribute('data-part');
        
        annotation.addEventListener('click', () => {
          showPartInfo(part);
        });
      });
    }

    function showPartInfo(part) {
      const info = heartData[part];
      const partInfoElement = document.getElementById('partInfo');
      
      if (info) {
        document.getElementById('partName').textContent = info.name;
        document.getElementById('partDescription').textContent = info.description;
        
        // Afficher/masquer les indicateurs de sang
        document.querySelectorAll('#partInfo .blood-flow').forEach(el => el.style.display = 'none');
        if (info.hasOxygenated) {
          document.querySelector('#partInfo .blood-flow.oxygenated').style.display = 'inline-block';
        }
        if (info.hasDeoxygenated) {
          document.querySelector('#partInfo .blood-flow.deoxygenated').style.display = 'inline-block';
        }
        
        partInfoElement.style.display = 'block';
      }
    }

    function createBloodCells() {
      // Créer des globules sanguins pour la simulation
      for (let i = 0; i < 10; i++) {
        // Globules désoxygénés (bleus)
        const blueCell = document.createElement('div');
        blueCell.className = 'blood-flow deoxygenated';
        blueCell.style.display = 'none';
        document.querySelector('.heart-image-container').appendChild(blueCell);
        bloodCells.push({
          element: blueCell,
          position: 0,
          type: 'deoxygenated',
          speed: 0.5 + Math.random() * 0.5
        });
        
        // Globules oxygénés (rouges)
        const redCell = document.createElement('div');
        redCell.className = 'blood-flow oxygenated';
        redCell.style.display = 'none';
        document.querySelector('.heart-image-container').appendChild(redCell);
        bloodCells.push({
          element: redCell,
          position: 5, // Commence à mi-chemin (poumons)
          type: 'oxygenated',
          speed: 0.5 + Math.random() * 0.5
        });
      }
    }

    function updateBloodCells() {
      const container = document.querySelector('.heart-image-container');
      const containerRect = container.getBoundingClientRect();
      const img = document.getElementById('heartImage');
      const imgRect = img.getBoundingClientRect();
      
      bloodCells.forEach(cell => {
        if (!isSimulationRunning) {
          cell.element.style.display = 'none';
          return;
        }
        
        cell.position += 0.005 * cell.speed * simulationSpeed;
        if (cell.position >= bloodPath.length) {
          cell.position = cell.type === 'deoxygenated' ? 0 : 5;
        }
        
        const pathIndex = Math.floor(cell.position);
        const nextIndex = (pathIndex + 1) % bloodPath.length;
        const progress = cell.position % 1;
        
        const currentPoint = bloodPath[pathIndex];
        const nextPoint = bloodPath[nextIndex];
        
        // Transition de type dans les poumons
        if (pathIndex === 5 && progress > 0.5) {
          cell.type = 'oxygenated';
          cell.element.className = 'blood-flow oxygenated';
        }
        
        // Calcul de la position
        const x = currentPoint.x + (nextPoint.x - currentPoint.x) * progress;
        const y = currentPoint.y + (nextPoint.y - currentPoint.y) * progress;
        
        // Positionnement absolu par rapport à l'image
        cell.element.style.left = `${x}%`;
        cell.element.style.top = `${y}%`;
        cell.element.style.display = 'block';
      });
    }

    function startSimulation() {
      if (!isSimulationRunning) {
        isSimulationRunning = true;
        document.getElementById('heartImage').classList.add('heartbeat');
        document.getElementById('heartImage').style.animationDuration = `${1/simulationSpeed}s`;
        
        // Démarrer le chronomètre
        timeLeft = 60;
        updateTimerDisplay();
        timerInterval = setInterval(updateTimer, 1000);
        
        // Démarrer la circulation sanguine
        heartbeatInterval = setInterval(function() {
          updateBloodCells();
          totalBeats++;
        }, 50);
        
        // Masquer le résumé précédent
        document.getElementById('simulationSummary').style.display = 'none';
        
        // Mettre à jour l'interface
        document.getElementById('startBtn').innerHTML = '<i class="fas fa-play"></i> En cours...';
        document.getElementById('startBtn').style.opacity = '0.7';
      }
    }

    function pauseSimulation() {
      if (isSimulationRunning) {
        isSimulationRunning = false;
        document.getElementById('heartImage').classList.remove('heartbeat');
        clearInterval(timerInterval);
        clearInterval(heartbeatInterval);
        
        // Mettre à jour l'interface
        document.getElementById('startBtn').innerHTML = '<i class="fas fa-play"></i> Démarrer';
        document.getElementById('startBtn').style.opacity = '1';
      }
    }

    function resetSimulation() {
      pauseSimulation();
      timeLeft = 60;
      totalBeats = 0;
      updateTimerDisplay();
      
      // Cacher tous les globules sanguins
      bloodCells.forEach(cell => {
        cell.element.style.display = 'none';
      });
    }

    function updateTimer() {
      timeLeft--;
      updateTimerDisplay();
      
      if (timeLeft <= 0) {
        endSimulation();
      }
    }

    function updateTimerDisplay() {
      const minutes = Math.floor(timeLeft / 60);
      const seconds = timeLeft % 60;
      document.getElementById('timer').textContent = 
        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function endSimulation() {
      pauseSimulation();
      
      // Afficher le résumé
      const litersPumped = Math.round(totalBeats * 0.07); // Environ 70 ml par battement
      document.getElementById('summaryContent').innerHTML = `
        <p><strong>Durée :</strong> 1 minute</p>
        <p><strong>Battements :</strong> ${totalBeats}</p>
        <p><strong>Sang pompé :</strong> Environ ${litersPumped} litres</p>
        <p>En 1 minute, un cœur adulte pompe environ 5 litres de sang, soit la totalité du sang dans le corps !</p>
      `;
      document.getElementById('simulationSummary').style.display = 'block';
    }

    function increaseSpeed() {
      if (simulationSpeed < 3) {
        simulationSpeed += 0.5;
        updateSpeedDisplay();
        if (isSimulationRunning) {
          document.getElementById('heartImage').style.animationDuration = `${1/simulationSpeed}s`;
        }
      }
    }

    function decreaseSpeed() {
      if (simulationSpeed > 0.5) {
        simulationSpeed -= 0.5;
        updateSpeedDisplay();
        if (isSimulationRunning) {
          document.getElementById('heartImage').style.animationDuration = `${1/simulationSpeed}s`;
        }
      }
    }

    function updateSpeedDisplay() {
      document.getElementById('speedValue').textContent = `${simulationSpeed}x`;
    }

    function startQuiz() {
      isQuizActive = true;
      currentQuestionIndex = 0;
      quizScore = 0;
      document.getElementById('quizContainer').style.display = 'block';
      document.getElementById('quizBtn').innerHTML = '<i class="fas fa-times"></i> Quitter le quiz';
      showQuestion();
    }

    function showQuestion() {
      const question = quizQuestions[currentQuestionIndex];
      const optionsContainer = document.getElementById('quizOptions');
      
      document.getElementById('quizQuestion').textContent = question.question;
      optionsContainer.innerHTML = '';
      
      question.options.forEach((option, index) => {
        const optionElement = document.createElement('div');
        optionElement.className = 'quiz-option';
        optionElement.textContent = option;
        optionElement.addEventListener('click', () => checkAnswer(index));
        optionsContainer.appendChild(optionElement);
      });
      
      // Cacher le feedback et le bouton suivant
      document.getElementById('quizFeedback').style.display = 'none';
      document.getElementById('nextQuestionBtn').style.display = 'none';
    }

    function checkAnswer(selectedIndex) {
      const question = quizQuestions[currentQuestionIndex];
      const options = document.querySelectorAll('.quiz-option');
      const feedbackElement = document.getElementById('quizFeedback');
      
      // Désactiver tous les options
      options.forEach(option => {
        option.style.pointerEvents = 'none';
      });
      
      // Vérifier la réponse
      if (selectedIndex === question.answer) {
        options[selectedIndex].classList.add('correct');
        feedbackElement.textContent = "Correct ! " + question.explanation;
        feedbackElement.className = "quiz-feedback feedback-correct";
        quizScore++;
      } else {
        options[selectedIndex].classList.add('incorrect');
        options[question.answer].classList.add('correct');
        feedbackElement.textContent = "Incorrect. " + question.explanation;
        feedbackElement.className = "quiz-feedback feedback-incorrect";
      }
      
      feedbackElement.style.display = 'block';
      document.getElementById('nextQuestionBtn').style.display = 'inline-flex';
    }

    function showNextQuestion() {
      currentQuestionIndex++;
      
      if (currentQuestionIndex < quizQuestions.length) {
        showQuestion();
      } else {
        endQuiz();
      }
    }

    function endQuiz() {
      isQuizActive = false;
      document.getElementById('quizContainer').style.display = 'none';
      document.getElementById('quizBtn').innerHTML = '<i class="fas fa-question-circle"></i> Testez vos connaissances';
      
      // Afficher le score final
      const percentage = Math.round((quizScore / quizQuestions.length) * 100);
      let message = '';
      
      if (percentage >= 75) {
        message = `Félicitations ! Vous avez obtenu ${percentage}% de bonnes réponses. Excellent travail !`;
      } else if (percentage >= 50) {
        message = `Bon travail ! Vous avez obtenu ${percentage}% de bonnes réponses. Vous pouvez encore progresser.`;
      } else {
        message = `Vous avez obtenu ${percentage}% de bonnes réponses. N'hésitez pas à revoir les différentes parties du cœur.`;
      }
      
      document.getElementById('infoDisplay').innerHTML = `
        <h4 style="color:var(--primary);"><i class="fas fa-poll"></i> Résultat du quiz</h4>
        <p>${message}</p>
        <div id="partInfo" style="display: none;">
          <h4 id="partName"></h4>
          <p id="partDescription"></p>
        </div>
      `;
    }

    function setupEventListeners() {
      // Boutons de contrôle de simulation
      document.getElementById('startBtn').addEventListener('click', startSimulation);
      document.getElementById('pauseBtn').addEventListener('click', pauseSimulation);
      document.getElementById('resetBtn').addEventListener('click', resetSimulation);
      
      // Contrôles de vitesse
      document.getElementById('increaseSpeed').addEventListener('click', increaseSpeed);
      document.getElementById('decreaseSpeed').addEventListener('click', decreaseSpeed);
      
      // Bouton du quiz
      document.getElementById('quizBtn').addEventListener('click', function() {
        if (isQuizActive) {
          endQuiz();
        } else {
          startQuiz();
        }
      });
      
      // Bouton question suivante
      document.getElementById('nextQuestionBtn').addEventListener('click', showNextQuestion);
    }
  </script>
</body>
</html>
