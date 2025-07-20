<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exécuter {{ $simulation->titre }} - Labo Virtuel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
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
            overflow: hidden;
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

        .simulation-container {
            position: relative;
            width: 100%;
            height: 100vh;
            margin-top: 70px;
        }

        #threejs-canvas {
            width: 100%;
            height: 100%;
            display: block;
        }

        .simulation-header {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .simulation-info h2 {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .simulation-info p {
            color: #666;
            font-size: 0.9rem;
        }

        .difficulty-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .difficulty-badge.facile {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .difficulty-badge.moyen {
            background: #fff3e0;
            color: #f57c00;
        }

        .difficulty-badge.difficile {
            background: #ffebee;
            color: #667eea;
        }

        .controls-panel {
            position: absolute;
            top: 100px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            z-index: 100;
            min-width: 300px;
        }

        .controls-panel h3 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .controls-panel h3 i {
            margin-right: 8px;
        }

        .control-group {
            margin-bottom: 15px;
        }

        .control-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--dark);
        }

        .control-group select,
        .control-group input {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .control-group select:focus,
        .control-group input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            margin: 5px;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--secondary);
        }

        .btn-secondary:hover {
            background: var(--secondary-light);
        }

        .instructions-panel {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            z-index: 100;
            max-width: 500px;
            max-height: 300px;
            overflow-y: auto;
        }

        .instructions-panel h4 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .instructions-panel h4 i {
            margin-right: 8px;
        }

        .instructions-content {
            color: #666;
            line-height: 1.6;
        }

        .instructions-content ol {
            margin-left: 20px;
        }

        .instructions-content li {
            margin-bottom: 8px;
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            z-index: 200;
        }

        .loading i {
            font-size: 2rem;
            color: var(--primary);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .hidden {
            display: none;
        }

        .simulation-type-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .type-btn {
            flex: 1;
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            font-size: 0.9rem;
        }

        .type-btn.active {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        .type-btn:hover {
            border-color: var(--primary);
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
            <a href="{{ route('simulations.show', $simulation) }}" class="nav-link">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </nav>

    <div class="simulation-container">
        <div class="loading" id="loading">
            <i class="fas fa-spinner"></i>
            <p>Chargement de la simulation...</p>
        </div>

        <div class="simulation-header">
            <div class="simulation-info">
                <h2>{{ $simulation->titre }}</h2>
                <p>{{ $simulation->type }} • 
                    <span class="difficulty-badge {{ $simulation->difficulte }}">
                        <i class="fas fa-signal"></i>
                        {{ ucfirst($simulation->difficulte) }}
                    </span>
                </p>
            </div>
            <div>
                <a href="{{ route('simulations.edit', $simulation) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i> Modifier
                </a>
            </div>
        </div>

        <div class="controls-panel">
            <h3><i class="fas fa-cogs"></i> Contrôles</h3>
            
            <div class="simulation-type-selector">
                <div class="type-btn active" data-type="mitose">Mitose</div>
                <div class="type-btn" data-type="fecondation">Fécondation</div>
                <div class="type-btn" data-type="circulation">Circulation sanguine</div>
                <div class="type-btn" data-type="seisme">Séisme</div>
                <div class="type-btn" data-type="volcan">Volcanisme</div>
                <div class="type-btn" data-type="chaine">Chaîne alimentaire</div>
                <div class="type-btn" data-type="heredite">Hérédité</div>
            </div>

            <div class="control-group">
                <label for="animation-speed">Vitesse d'animation</label>
                <input type="range" id="animation-speed" min="0" max="2" step="0.1" value="1">
            </div>

            <div class="control-group">
                <label for="camera-distance">Distance caméra</label>
                <input type="range" id="camera-distance" min="5" max="20" step="1" value="10">
            </div>

            <button class="btn" id="play-pause">
                <i class="fas fa-pause"></i> Pause
            </button>
            <button class="btn btn-secondary" id="reset">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>

        <div class="instructions-panel">
            <h4><i class="fas fa-info-circle"></i> Instructions</h4>
            <div class="instructions-content">
                @foreach(explode("\n", $simulation->instructions) as $instruction)
                    @if(trim($instruction))
                        <p>{{ trim($instruction) }}</p>
                    @endif
                @endforeach
            </div>
        </div>

        <canvas id="threejs-canvas"></canvas>
    </div>

    <script>
        // Variables globales
        let scene, camera, renderer, controls;
        let animationId;
        let isPlaying = true;
        let currentSimulation = 'molecule';
        let animationSpeed = 1;

        // Initialisation Three.js
        function init() {
            // Création de la scène
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0xf0f0f0);

            // Création de la caméra
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 10;

            // Création du renderer
            renderer = new THREE.WebGLRenderer({ 
                canvas: document.getElementById('threejs-canvas'),
                antialias: true 
            });
            renderer.setSize(window.innerWidth, window.innerHeight - 70);
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;

            // Contrôles de la caméra
            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;

            // Éclairage
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(10, 10, 5);
            directionalLight.castShadow = true;
            scene.add(directionalLight);

            // Création de la simulation initiale
            createSimulation(currentSimulation);

            // Masquer le loading
            document.getElementById('loading').classList.add('hidden');

            // Démarrer l'animation
            animate();
        }

        // Création des simulations
        function createSimulation(type) {
            // Nettoyer la scène
            while(scene.children.length > 0) { 
                scene.remove(scene.children[0]); 
            }

            // Réajouter l'éclairage
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(10, 10, 5);
            directionalLight.castShadow = true;
            scene.add(directionalLight);

            switch(type) {
                case 'mitose':
                    createMitoseSimulation();
                    break;
                case 'fecondation':
                    createFecondationSimulation();
                    break;
                case 'circulation':
                    createCirculationSimulation();
                    break;
                case 'seisme':
                    createSeismeSimulation();
                    break;
                case 'volcan':
                    createVolcanSimulation();
                    break;
                case 'chaine':
                    createChaineAlimentaireSimulation();
                    break;
                case 'heredite':
                    createHerediteSimulation();
                    break;
            }
        }

        // Simulation de la MITOSE (Division cellulaire)
        function createMitoseSimulation() {
            // Cellule mère
            const cellGeometry = new THREE.SphereGeometry(2, 32, 32);
            const cellMaterial = new THREE.MeshLambertMaterial({ 
                color: 0x90EE90, 
                transparent: true, 
                opacity: 0.3 
            });
            const cell = new THREE.Mesh(cellGeometry, cellMaterial);
            scene.add(cell);

            // Noyau de la cellule mère
            const nucleusGeometry = new THREE.SphereGeometry(1.2, 32, 32);
            const nucleusMaterial = new THREE.MeshLambertMaterial({ 
                color: 0xFF6B6B,
                transparent: true,
                opacity: 0.8
            });
            const nucleus = new THREE.Mesh(nucleusGeometry, nucleusMaterial);
            scene.add(nucleus);

            // Nucléole
            const nucleolusGeometry = new THREE.SphereGeometry(0.3, 16, 16);
            const nucleolusMaterial = new THREE.MeshLambertMaterial({ color: 0xFFD700 });
            const nucleolus = new THREE.Mesh(nucleolusGeometry, nucleolusMaterial);
            nucleolus.position.set(0, 0, 0);
            scene.add(nucleolus);

            // Chromatine (ADN déroulé) - initialement dispersée
            const chromatinParticles = [];
            for(let i = 0; i < 20; i++) {
                const particleGeometry = new THREE.SphereGeometry(0.05, 8, 8);
                const particleMaterial = new THREE.MeshLambertMaterial({ 
                    color: 0x4169E1,
                    transparent: true,
                    opacity: 0.6
                });
                const particle = new THREE.Mesh(particleGeometry, particleMaterial);
                
                particle.position.set(
                    (Math.random() - 0.5) * 1.5,
                    (Math.random() - 0.5) * 1.5,
                    (Math.random() - 0.5) * 1.5
                );
                particle.userData = { 
                    type: 'chromatin',
                    originalPosition: particle.position.clone(),
                    targetChromosome: Math.floor(i / 2)
                };
                chromatinParticles.push(particle);
                scene.add(particle);
            }

            // Chromosomes (initialement invisibles)
            const chromosomes = [];
            for(let i = 0; i < 8; i++) {
                const chromGeometry = new THREE.CylinderGeometry(0.08, 0.08, 0.4, 8);
                const chromMaterial = new THREE.MeshLambertMaterial({ 
                    color: 0x4169E1,
                    transparent: true,
                    opacity: 0
                });
                const chromosome = new THREE.Mesh(chromGeometry, chromMaterial);
                
                chromosome.position.set(0, 0, 0);
                chromosome.scale.set(0, 0, 0);
                chromosome.userData = { 
                    index: i,
                    chromatids: 2,
                    centromere: 0.2
                };
                chromosomes.push(chromosome);
                scene.add(chromosome);
            }

            // Centrosomes (initialement invisibles)
            const centrosome1 = new THREE.Mesh(
                new THREE.SphereGeometry(0.15, 16, 16),
                new THREE.MeshLambertMaterial({ 
                    color: 0xFF4500,
                    transparent: true,
                    opacity: 0
                })
            );
            centrosome1.position.set(-1.5, 0, 0);
            scene.add(centrosome1);

            const centrosome2 = new THREE.Mesh(
                new THREE.SphereGeometry(0.15, 16, 16),
                new THREE.MeshLambertMaterial({ 
                    color: 0xFF4500,
                    transparent: true,
                    opacity: 0
                })
            );
            centrosome2.position.set(1.5, 0, 0);
            scene.add(centrosome2);

            // Fuseau mitotique (microtubules)
            const spindleFibers = [];

            // Cellules filles (initialement invisibles)
            const daughterCell1 = new THREE.Mesh(
                new THREE.SphereGeometry(1.5, 32, 32),
                new THREE.MeshLambertMaterial({ 
                    color: 0x90EE90, 
                    transparent: true, 
                    opacity: 0 
                })
            );
            daughterCell1.position.set(-2, 0, 0);
            scene.add(daughterCell1);

            const daughterCell2 = new THREE.Mesh(
                new THREE.SphereGeometry(1.5, 32, 32),
                new THREE.MeshLambertMaterial({ 
                    color: 0x90EE90, 
                    transparent: true, 
                    opacity: 0 
                })
            );
            daughterCell2.position.set(2, 0, 0);
            scene.add(daughterCell2);

            // Noyaux des cellules filles
            const nucleus1 = new THREE.Mesh(
                new THREE.SphereGeometry(0.8, 32, 32),
                new THREE.MeshLambertMaterial({ 
                    color: 0xFF6B6B,
                    transparent: true,
                    opacity: 0
                })
            );
            nucleus1.position.set(-2, 0, 0);
            scene.add(nucleus1);

            const nucleus2 = new THREE.Mesh(
                new THREE.SphereGeometry(0.8, 32, 32),
                new THREE.MeshLambertMaterial({ 
                    color: 0xFF6B6B,
                    transparent: true,
                    opacity: 0
                })
            );
            nucleus2.position.set(2, 0, 0);
            scene.add(nucleus2);

            // Animation de la mitose
            function animateMitose(time) {
                const phase = Math.floor(time / 2.5) % 5; // 5 phases
                const phaseTime = time % 2.5;

                switch(phase) {
                    case 0: // PROPHASE
                        // Disparition du nucléole
                        nucleolus.scale.set(1 - phaseTime * 0.4, 1 - phaseTime * 0.4, 1);
                        
                        // Condensation de la chromatine en chromosomes
                        chromatinParticles.forEach((particle, index) => {
                            const targetChromosome = Math.floor(index / 2);
                            const chromosome = chromosomes[targetChromosome];
                            
                            if(phaseTime > 0.5) {
                                // Rassembler les particules vers les chromosomes
                                const targetPos = new THREE.Vector3(
                                    (targetChromosome - 4) * 0.3,
                                    0,
                                    0
                                );
                                particle.position.lerp(targetPos, (phaseTime - 0.5) * 2);
                                particle.material.opacity = 0.6 - (phaseTime - 0.5) * 1.2;
                            }
                        });

                        // Apparition des chromosomes
                        chromosomes.forEach((chrom, index) => {
                            if(phaseTime > 0.5) {
                                chrom.material.opacity = (phaseTime - 0.5) * 2;
                                chrom.scale.set(
                                    (phaseTime - 0.5) * 2,
                                    (phaseTime - 0.5) * 2,
                                    (phaseTime - 0.5) * 2
                                );
                            }
                        });

                        // Apparition des centrosomes
                        centrosome1.material.opacity = phaseTime * 0.4;
                        centrosome2.material.opacity = phaseTime * 0.4;
                        
                        // Disparition de la membrane nucléaire
                        nucleus.material.opacity = 0.8 - phaseTime * 0.8;
                        break;

                    case 1: // MÉTAPHASE
                        // Alignement des chromosomes sur la plaque équatoriale
                        chromosomes.forEach((chrom, index) => {
                            const targetY = (index - 4) * 0.3;
                            chrom.position.y = targetY;
                            chrom.position.x = 0;
                            chrom.position.z = 0;
                        });

                        // Formation du fuseau mitotique
                        if(spindleFibers.length === 0) {
                            chromosomes.forEach((chrom, index) => {
                                // Fibres du fuseau vers les centrosomes
                                const fiber1Geometry = new THREE.BufferGeometry().setFromPoints([
                                    new THREE.Vector3(-1.5, 0, 0),
                                    new THREE.Vector3(0, chrom.position.y, 0)
                                ]);
                                const fiber1Material = new THREE.LineBasicMaterial({ 
                                    color: 0xFFFF00,
                                    transparent: true,
                                    opacity: 0.6
                                });
                                const fiber1 = new THREE.Line(fiber1Geometry, fiber1Material);
                                spindleFibers.push(fiber1);
                                scene.add(fiber1);

                                const fiber2Geometry = new THREE.BufferGeometry().setFromPoints([
                                    new THREE.Vector3(1.5, 0, 0),
                                    new THREE.Vector3(0, chrom.position.y, 0)
                                ]);
                                const fiber2Material = new THREE.LineBasicMaterial({ 
                                    color: 0xFFFF00,
                                    transparent: true,
                                    opacity: 0.6
                                });
                                const fiber2 = new THREE.Line(fiber2Geometry, fiber2Material);
                                spindleFibers.push(fiber2);
                                scene.add(fiber2);
                            });
                        }
                        break;

                    case 2: // ANAPHASE
                        // Séparation des chromatides sœurs
                        chromosomes.forEach((chrom, index) => {
                            const direction = index < 4 ? -1 : 1;
                            const separation = phaseTime * 2;
                            chrom.position.x = direction * separation;
                            chrom.position.y = (index % 4) * 0.3;
                        });

                        // Mise à jour du fuseau mitotique
                        spindleFibers.forEach((fiber, index) => {
                            const chromIndex = Math.floor(index / 2);
                            const direction = chromIndex < 4 ? -1 : 1;
                            const separation = phaseTime * 2;
                            
                            const points = fiber.geometry.attributes.position;
                            points.setXYZ(1, direction * separation, (chromIndex % 4) * 0.3, 0);
                            points.needsUpdate = true;
                        });
                        break;

                    case 3: // TÉLOPHASE
                        // Décondensation des chromosomes en chromatine
                        chromosomes.forEach((chrom, index) => {
                            chrom.material.opacity = 1 - phaseTime * 0.4;
                            chrom.scale.set(
                                1 - phaseTime * 0.3,
                                1 - phaseTime * 0.3,
                                1 - phaseTime * 0.3
                            );
                        });

                        // Disparition du fuseau mitotique
                        spindleFibers.forEach(fiber => {
                            fiber.material.opacity = 0.6 - phaseTime * 0.6;
                        });

                        // Formation des nouveaux noyaux
                        nucleus1.material.opacity = phaseTime * 0.8;
                        nucleus2.material.opacity = phaseTime * 0.8;
                        break;

                    case 4: // CYTOCINÈSE
                        // Division du cytoplasme
                        daughterCell1.material.opacity = phaseTime * 0.3;
                        daughterCell2.material.opacity = phaseTime * 0.3;
                        
                        // La cellule mère disparaît
                        cell.material.opacity = 0.3 - phaseTime * 0.3;
                        
                        // Disparition complète des éléments de division
                        centrosome1.material.opacity = 0.4 - phaseTime * 0.4;
                        centrosome2.material.opacity = 0.4 - phaseTime * 0.4;
                        
                        // Nettoyer le fuseau mitotique
                        spindleFibers.forEach(fiber => {
                            fiber.material.opacity = 0;
                        });
                        break;
                }
            }

            // Ajouter l'animation à la liste
            scene.userData.animation = animateMitose;
        }

        // Simulation de la FÉCONDATION
        function createFecondationSimulation() {
            // Ovule
            const ovuleGeometry = new THREE.SphereGeometry(1.5, 32, 32);
            const ovuleMaterial = new THREE.MeshLambertMaterial({ color: 0xFFB6C1 });
            const ovule = new THREE.Mesh(ovuleGeometry, ovuleMaterial);
            ovule.position.set(0, 0, 0);
            scene.add(ovule);

            // Noyau de l'ovule
            const ovuleNucleusGeometry = new THREE.SphereGeometry(0.5, 16, 16);
            const ovuleNucleusMaterial = new THREE.MeshLambertMaterial({ color: 0xFF6B6B });
            const ovuleNucleus = new THREE.Mesh(ovuleNucleusGeometry, ovuleNucleusMaterial);
            ovuleNucleus.position.set(0, 0, 0);
            scene.add(ovuleNucleus);

            // Spermatozoïde
            const spermHeadGeometry = new THREE.SphereGeometry(0.3, 16, 16);
            const spermHeadMaterial = new THREE.MeshLambertMaterial({ color: 0x87CEEB });
            const spermHead = new THREE.Mesh(spermHeadGeometry, spermHeadMaterial);
            spermHead.position.set(-4, 0, 0);
            scene.add(spermHead);

            // Flagelle du spermatozoïde
            const flagelleGeometry = new THREE.CylinderGeometry(0.05, 0.02, 1, 8);
            const flagelleMaterial = new THREE.MeshLambertMaterial({ color: 0x87CEEB });
            const flagelle = new THREE.Mesh(flagelleGeometry, flagelleMaterial);
            flagelle.position.set(-4.5, 0, 0);
            scene.add(flagelle);

            // Noyau du spermatozoïde
            const spermNucleusGeometry = new THREE.SphereGeometry(0.2, 12, 12);
            const spermNucleusMaterial = new THREE.MeshLambertMaterial({ color: 0x4169E1 });
            const spermNucleus = new THREE.Mesh(spermNucleusGeometry, spermNucleusMaterial);
            spermNucleus.position.set(-4, 0, 0);
            scene.add(spermNucleus);

            // Animation de la fécondation
            function animateFecondation(time) {
                const phase = Math.floor(time / 2) % 4;
                const phaseTime = time % 2;

                switch(phase) {
                    case 0: // Nage du spermatozoïde
                        const progress = phaseTime / 2;
                        spermHead.position.x = -4 + progress * 3;
                        flagelle.position.x = -4.5 + progress * 3;
                        spermNucleus.position.x = -4 + progress * 3;
                        break;
                    case 1: // Fusion des membranes
                        spermHead.position.x = 0;
                        flagelle.position.x = -0.5;
                        spermNucleus.position.x = 0;
                        ovule.scale.set(1 + phaseTime * 0.2, 1 + phaseTime * 0.2, 1);
                        break;
                    case 2: // Fusion des noyaux
                        spermNucleus.position.x = phaseTime * 0.5;
                        ovuleNucleus.scale.set(1 + phaseTime * 0.3, 1 + phaseTime * 0.3, 1);
                        break;
                    case 3: // Formation du zygote
                        ovule.scale.set(1.2 + phaseTime * 0.1, 1.2 + phaseTime * 0.1, 1);
                        ovuleNucleus.scale.set(1.3 + phaseTime * 0.2, 1.3 + phaseTime * 0.2, 1);
                        break;
                }
            }

            scene.userData.animation = animateFecondation;
        }

        // Simulation de la CIRCULATION SANGUINE
        function createCirculationSimulation() {
            // Cœur
            const heartGeometry = new THREE.SphereGeometry(1, 32, 32);
            const heartMaterial = new THREE.MeshLambertMaterial({ color: 0xFF6B6B });
            const heart = new THREE.Mesh(heartGeometry, heartMaterial);
            heart.position.set(0, 0, 0);
            scene.add(heart);

            // Artères (sang rouge)
            const arteries = [];
            for(let i = 0; i < 5; i++) {
                const arteryGeometry = new THREE.CylinderGeometry(0.1, 0.1, 2, 8);
                const arteryMaterial = new THREE.MeshLambertMaterial({ color: 0xFF0000 });
                const artery = new THREE.Mesh(arteryGeometry, arteryMaterial);
                
                const angle = (i / 5) * Math.PI * 2;
                artery.position.set(
                    Math.cos(angle) * 2,
                    Math.sin(angle) * 2,
                    0
                );
                artery.rotation.z = angle;
                artery.userData = { type: 'artery', index: i };
                arteries.push(artery);
                scene.add(artery);
            }

            // Veines (sang bleu)
            const veins = [];
            for(let i = 0; i < 5; i++) {
                const veinGeometry = new THREE.CylinderGeometry(0.1, 0.1, 2, 8);
                const veinMaterial = new THREE.MeshLambertMaterial({ color: 0x0000FF });
                const vein = new THREE.Mesh(veinGeometry, veinMaterial);
                
                const angle = (i / 5) * Math.PI * 2 + Math.PI / 5;
                vein.position.set(
                    Math.cos(angle) * 2,
                    Math.sin(angle) * 2,
                    0
                );
                vein.rotation.z = angle;
                vein.userData = { type: 'vein', index: i };
                veins.push(vein);
                scene.add(vein);
            }

            // Globules rouges
            const redBloodCells = [];
            for(let i = 0; i < 10; i++) {
                const cellGeometry = new THREE.SphereGeometry(0.05, 8, 8);
                const cellMaterial = new THREE.MeshLambertMaterial({ color: 0xFF0000 });
                const cell = new THREE.Mesh(cellGeometry, cellMaterial);
                
                cell.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6,
                    0
                );
                cell.userData = { 
                    type: Math.random() > 0.5 ? 'artery' : 'vein',
                    speed: 0.02 + Math.random() * 0.01,
                    angle: Math.random() * Math.PI * 2
                };
                redBloodCells.push(cell);
                scene.add(cell);
            }

            // Animation de la circulation
            function animateCirculation(time) {
                // Animation du cœur
                heart.scale.set(
                    1 + Math.sin(time * 2) * 0.1,
                    1 + Math.sin(time * 2) * 0.1,
                    1
                );

                // Animation des globules rouges
                redBloodCells.forEach(cell => {
                    if(cell.userData.type === 'artery') {
                        cell.position.x += cell.userData.speed;
                        if(cell.position.x > 4) {
                            cell.position.x = -4;
                            cell.userData.type = 'vein';
                            cell.material.color.setHex(0x0000FF);
                        }
                    } else {
                        cell.position.x -= cell.userData.speed;
                        if(cell.position.x < -4) {
                            cell.position.x = 4;
                            cell.userData.type = 'artery';
                            cell.material.color.setHex(0xFF0000);
                        }
                    }
                });
            }

            scene.userData.animation = animateCirculation;
        }

        // Simulation du SÉISME
        function createSeismeSimulation() {
            // Plaques tectoniques
            const plate1Geometry = new THREE.BoxGeometry(4, 0.5, 2);
            const plate1Material = new THREE.MeshLambertMaterial({ color: 0x8B4513 });
            const plate1 = new THREE.Mesh(plate1Geometry, plate1Material);
            plate1.position.set(-1, 0, 0);
            scene.add(plate1);

            const plate2Geometry = new THREE.BoxGeometry(4, 0.5, 2);
            const plate2Material = new THREE.MeshLambertMaterial({ color: 0xCD853F });
            const plate2 = new THREE.Mesh(plate2Geometry, plate2Material);
            plate2.position.set(1, 0, 0);
            scene.add(plate2);

            // Faille
            const faultGeometry = new THREE.BoxGeometry(0.1, 0.6, 2);
            const faultMaterial = new THREE.MeshLambertMaterial({ color: 0x000000 });
            const fault = new THREE.Mesh(faultGeometry, faultMaterial);
            fault.position.set(0, 0, 0);
            scene.add(fault);

            // Ondes sismiques
            const waves = [];

            // Animation du séisme
            function animateSeisme(time) {
                const phase = Math.floor(time / 2) % 4;
                const phaseTime = time % 2;

                switch(phase) {
                    case 0: // Accumulation de tension
                        plate1.position.x = -1 - phaseTime * 0.1;
                        plate2.position.x = 1 + phaseTime * 0.1;
                        break;
                    case 1: // Rupture et ondes P
                        plate1.position.x = -1.2 + phaseTime * 0.2;
                        plate2.position.x = 1.2 - phaseTime * 0.2;
                        
                        // Créer des ondes P
                        if(Math.random() > 0.8) {
                            const waveGeometry = new THREE.SphereGeometry(0.1, 8, 8);
                            const waveMaterial = new THREE.MeshLambertMaterial({ 
                                color: 0xFF0000,
                                transparent: true,
                                opacity: 0.7
                            });
                            const wave = new THREE.Mesh(waveGeometry, waveMaterial);
                            wave.position.set(0, 0, 0);
                            wave.userData = { type: 'P', radius: 0 };
                            waves.push(wave);
                            scene.add(wave);
                        }
                        break;
                    case 2: // Ondes S
                        if(Math.random() > 0.9) {
                            const waveGeometry = new THREE.SphereGeometry(0.1, 8, 8);
                            const waveMaterial = new THREE.MeshLambertMaterial({ 
                                color: 0x00FF00,
                                transparent: true,
                                opacity: 0.7
                            });
                            const wave = new THREE.Mesh(waveGeometry, waveMaterial);
                            wave.position.set(0, 0, 0);
                            wave.userData = { type: 'S', radius: 0 };
                            waves.push(wave);
                            scene.add(wave);
                        }
                        break;
                    case 3: // Ondes de surface
                        if(Math.random() > 0.95) {
                            const waveGeometry = new THREE.SphereGeometry(0.1, 8, 8);
                            const waveMaterial = new THREE.MeshLambertMaterial({ 
                                color: 0x0000FF,
                                transparent: true,
                                opacity: 0.7
                            });
                            const wave = new THREE.Mesh(waveGeometry, waveMaterial);
                            wave.position.set(0, 0, 0);
                            wave.userData = { type: 'surface', radius: 0 };
                            waves.push(wave);
                            scene.add(wave);
                        }
                        break;
                }

                // Animation des ondes
                waves.forEach((wave, index) => {
                    wave.userData.radius += 0.05;
                    wave.scale.set(
                        wave.userData.radius,
                        wave.userData.radius,
                        wave.userData.radius
                    );
                    wave.material.opacity = Math.max(0, 0.7 - wave.userData.radius * 0.1);
                    
                    if(wave.userData.radius > 7) {
                        scene.remove(wave);
                        waves.splice(index, 1);
                    }
                });
            }

            scene.userData.animation = animateSeisme;
        }

        // Simulation du VOLCANISME
        function createVolcanSimulation() {
            // Cône volcanique
            const coneGeometry = new THREE.ConeGeometry(2, 3, 32);
            const coneMaterial = new THREE.MeshLambertMaterial({ color: 0x8B4513 });
            const cone = new THREE.Mesh(coneGeometry, coneMaterial);
            cone.position.set(0, 1.5, 0);
            scene.add(cone);

            // Chambre magmatique
            const magmaChamberGeometry = new THREE.SphereGeometry(1, 16, 16);
            const magmaChamberMaterial = new THREE.MeshLambertMaterial({ 
                color: 0xFF4500,
                transparent: true,
                opacity: 0.8
            });
            const magmaChamber = new THREE.Mesh(magmaChamberGeometry, magmaChamberMaterial);
            magmaChamber.position.set(0, -2, 0);
            scene.add(magmaChamber);

            // Particules de lave et cendres
            const particles = [];

            // Animation du volcanisme
            function animateVolcan(time) {
                const phase = Math.floor(time / 3) % 4;
                const phaseTime = time % 3;

                switch(phase) {
                    case 0: // Accumulation de magma
                        magmaChamber.scale.set(
                            1 + phaseTime * 0.3,
                            1 + phaseTime * 0.3,
                            1
                        );
                        break;
                    case 1: // Montée du magma
                        magmaChamber.position.y = -2 + phaseTime;
                        break;
                    case 2: // Éruption
                        // Créer des particules de lave
                        if(Math.random() > 0.7) {
                            const particleGeometry = new THREE.SphereGeometry(0.05, 8, 8);
                            const particleMaterial = new THREE.MeshLambertMaterial({ 
                                color: Math.random() > 0.5 ? 0xFF4500 : 0xFF0000
                            });
                            const particle = new THREE.Mesh(particleGeometry, particleMaterial);
                            particle.position.set(
                                (Math.random() - 0.5) * 0.5,
                                3,
                                (Math.random() - 0.5) * 0.5
                            );
                            particle.userData = { 
                                velocity: new THREE.Vector3(
                                    (Math.random() - 0.5) * 0.1,
                                    0.1 + Math.random() * 0.1,
                                    (Math.random() - 0.5) * 0.1
                                ),
                                life: 0
                            };
                            particles.push(particle);
                            scene.add(particle);
                        }
                        break;
                    case 3: // Formation du cône
                        cone.scale.set(
                            1 + phaseTime * 0.1,
                            1 + phaseTime * 0.1,
                            1
                        );
                        break;
                }

                // Animation des particules
                particles.forEach((particle, index) => {
                    particle.position.add(particle.userData.velocity);
                    particle.userData.velocity.y -= 0.005; // Gravité
                    particle.userData.life += 0.01;
                    
                    if(particle.userData.life > 1 || particle.position.y < -2) {
                        scene.remove(particle);
                        particles.splice(index, 1);
                    }
                });
            }

            scene.userData.animation = animateVolcan;
        }

        // Simulation de la CHAÎNE ALIMENTAIRE
        function createChaineAlimentaireSimulation() {
            // Producteurs (plantes)
            const plants = [];
            for(let i = 0; i < 8; i++) {
                const plantGeometry = new THREE.CylinderGeometry(0.1, 0.1, 1, 8);
                const plantMaterial = new THREE.MeshLambertMaterial({ color: 0x228B22 });
                const plant = new THREE.Mesh(plantGeometry, plantMaterial);
                
                const angle = (i / 8) * Math.PI * 2;
                const radius = 3;
                plant.position.set(
                    Math.cos(angle) * radius,
                    0.5,
                    Math.sin(angle) * radius
                );
                plant.userData = { type: 'producer', index: i };
                plants.push(plant);
                scene.add(plant);
            }

            // Consommateurs primaires (herbivores)
            const herbivores = [];
            for(let i = 0; i < 3; i++) {
                const herbivoreGeometry = new THREE.SphereGeometry(0.3, 16, 16);
                const herbivoreMaterial = new THREE.MeshLambertMaterial({ color: 0x8FBC8F });
                const herbivore = new THREE.Mesh(herbivoreGeometry, herbivoreMaterial);
                
                herbivore.position.set(
                    (Math.random() - 0.5) * 4,
                    0.3,
                    (Math.random() - 0.5) * 4
                );
                herbivore.userData = { 
                    type: 'herbivore',
                    targetPlant: Math.floor(Math.random() * plants.length),
                    speed: 0.02
                };
                herbivores.push(herbivore);
                scene.add(herbivore);
            }

            // Consommateurs secondaires (carnivores)
            const carnivores = [];
            for(let i = 0; i < 2; i++) {
                const carnivoreGeometry = new THREE.SphereGeometry(0.4, 16, 16);
                const carnivoreMaterial = new THREE.MeshLambertMaterial({ color: 0xDC143C });
                const carnivore = new THREE.Mesh(carnivoreGeometry, carnivoreMaterial);
                
                carnivore.position.set(
                    (Math.random() - 0.5) * 6,
                    0.4,
                    (Math.random() - 0.5) * 6
                );
                carnivore.userData = { 
                    type: 'carnivore',
                    targetHerbivore: Math.floor(Math.random() * herbivores.length),
                    speed: 0.03
                };
                carnivores.push(carnivore);
                scene.add(carnivore);
            }

            // Animation de la chaîne alimentaire
            function animateChaineAlimentaire(time) {
                // Animation des plantes (croissance)
                plants.forEach(plant => {
                    plant.scale.set(
                        1 + Math.sin(time + plant.userData.index) * 0.1,
                        1 + Math.sin(time + plant.userData.index) * 0.1,
                        1
                    );
                });

                // Animation des herbivores (mouvement vers les plantes)
                herbivores.forEach(herbivore => {
                    const targetPlant = plants[herbivore.userData.targetPlant];
                    const direction = new THREE.Vector3()
                        .subVectors(targetPlant.position, herbivore.position)
                        .normalize();
                    
                    herbivore.position.add(direction.multiplyScalar(herbivore.userData.speed));
                    
                    // Changer de cible si proche
                    if(herbivore.position.distanceTo(targetPlant.position) < 0.5) {
                        herbivore.userData.targetPlant = Math.floor(Math.random() * plants.length);
                    }
                });

                // Animation des carnivores (mouvement vers les herbivores)
                carnivores.forEach(carnivore => {
                    const targetHerbivore = herbivores[carnivore.userData.targetHerbivore];
                    if(targetHerbivore) {
                        const direction = new THREE.Vector3()
                            .subVectors(targetHerbivore.position, carnivore.position)
                            .normalize();
                        
                        carnivore.position.add(direction.multiplyScalar(carnivore.userData.speed));
                        
                        // Changer de cible si proche
                        if(carnivore.position.distanceTo(targetHerbivore.position) < 0.8) {
                            carnivore.userData.targetHerbivore = Math.floor(Math.random() * herbivores.length);
                        }
                    }
                });
            }

            scene.userData.animation = animateChaineAlimentaire;
        }

        // Simulation de l'HÉRÉDITÉ
        function createHerediteSimulation() {
            // Parents
            const parent1Geometry = new THREE.SphereGeometry(0.8, 16, 16);
            const parent1Material = new THREE.MeshLambertMaterial({ color: 0x87CEEB });
            const parent1 = new THREE.Mesh(parent1Geometry, parent1Material);
            parent1.position.set(-2, 0, 0);
            scene.add(parent1);

            const parent2Geometry = new THREE.SphereGeometry(0.8, 16, 16);
            const parent2Material = new THREE.MeshLambertMaterial({ color: 0xFFB6C1 });
            const parent2 = new THREE.Mesh(parent2Geometry, parent2Material);
            parent2.position.set(2, 0, 0);
            scene.add(parent2);

            // Allèles (gènes)
            const alleles = [];
            for(let i = 0; i < 4; i++) {
                const alleleGeometry = new THREE.SphereGeometry(0.1, 8, 8);
                const alleleMaterial = new THREE.MeshLambertMaterial({ 
                    color: i < 2 ? 0x4169E1 : 0xFF6B6B 
                });
                const allele = new THREE.Mesh(alleleGeometry, alleleMaterial);
                
                const parent = i < 2 ? parent1 : parent2;
                const offset = i % 2 === 0 ? -0.3 : 0.3;
                allele.position.set(
                    parent.position.x + offset,
                    parent.position.y + 0.5,
                    parent.position.z
                );
                allele.userData = { 
                    parent: i < 2 ? 'parent1' : 'parent2',
                    allele: i % 2 === 0 ? 'A' : 'a'
                };
                alleles.push(allele);
                scene.add(allele);
            }

            // Gamètes
            const gametes = [];

            // Descendants
            const descendants = [];

            // Animation de l'hérédité
            function animateHeredite(time) {
                const phase = Math.floor(time / 2) % 4;
                const phaseTime = time % 2;

                switch(phase) {
                    case 0: // Formation des gamètes
                        if(gametes.length === 0) {
                            alleles.forEach(allele => {
                                const gameteGeometry = new THREE.SphereGeometry(0.08, 8, 8);
                                const gameteMaterial = new THREE.MeshLambertMaterial({ 
                                    color: allele.material.color,
                                    transparent: true,
                                    opacity: 0.8
                                });
                                const gamete = new THREE.Mesh(gameteGeometry, gameteMaterial);
                                gamete.position.copy(allele.position);
                                gamete.userData = { 
                                    allele: allele.userData.allele,
                                    originalPosition: allele.position.clone()
                                };
                                gametes.push(gamete);
                                scene.add(gamete);
                            });
                        }
                        break;
                    case 1: // Mouvement des gamètes vers le centre
                        gametes.forEach(gamete => {
                            const targetX = (gamete.userData.allele === 'A' || gamete.userData.allele === 'a') ? 0 : 0;
                            gamete.position.x += (targetX - gamete.position.x) * 0.05;
                        });
                        break;
                    case 2: // Fécondation
                        if(descendants.length === 0) {
                            // Créer des descendants avec différents génotypes
                            const genotypes = ['AA', 'Aa', 'aa'];
                            genotypes.forEach((genotype, index) => {
                                const descendantGeometry = new THREE.SphereGeometry(0.6, 16, 16);
                                const descendantMaterial = new THREE.MeshLambertMaterial({ 
                                    color: genotype === 'AA' ? 0x4169E1 : 
                                           genotype === 'Aa' ? 0x9370DB : 0xFF6B6B
                                });
                                const descendant = new THREE.Mesh(descendantGeometry, descendantMaterial);
                                descendant.position.set(
                                    (index - 1) * 1.5,
                                    -2,
                                    0
                                );
                                descendant.userData = { genotype: genotype };
                                descendants.push(descendant);
                                scene.add(descendant);
                            });
                        }
                        break;
                    case 3: // Affichage des résultats
                        descendants.forEach(descendant => {
                            descendant.scale.set(
                                1 + Math.sin(time * 2) * 0.1,
                                1 + Math.sin(time * 2) * 0.1,
                                1
                            );
                        });
                        break;
                }
            }

            scene.userData.animation = animateHeredite;
        }

        // Animation
        function animate() {
            animationId = requestAnimationFrame(animate);

            if(isPlaying) {
                const time = Date.now() * 0.001 * animationSpeed;

                // Exécuter l'animation spécifique à la simulation
                if(scene.userData.animation) {
                    scene.userData.animation(time);
                }
            }

            controls.update();
            renderer.render(scene, camera);
        }

        // Gestionnaires d'événements
        document.querySelectorAll('.type-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentSimulation = this.dataset.type;
                createSimulation(currentSimulation);
            });
        });

        document.getElementById('animation-speed').addEventListener('input', function() {
            animationSpeed = parseFloat(this.value);
        });

        document.getElementById('camera-distance').addEventListener('input', function() {
            camera.position.z = parseFloat(this.value);
        });

        document.getElementById('play-pause').addEventListener('click', function() {
            isPlaying = !isPlaying;
            const icon = this.querySelector('i');
            
            if(isPlaying) {
                icon.className = 'fas fa-pause';
                this.innerHTML = '<i class="fas fa-pause"></i> Pause';
            } else {
                icon.className = 'fas fa-play';
                this.innerHTML = '<i class="fas fa-play"></i> Play';
            }
        });

        document.getElementById('reset').addEventListener('click', function() {
            camera.position.set(0, 0, 10);
            controls.reset();
        });

        // Gestion du redimensionnement
        window.addEventListener('resize', function() {
            camera.aspect = window.innerWidth / (window.innerHeight - 70);
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight - 70);
        });

        // Initialisation
        init();
    </script>
</body>
</html> 
