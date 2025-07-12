<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratoire Virtuel - Photosynthèse (SVT 3ème)</title>
    <style>
        body { 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
        }
        #info-panel {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 300px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            border-radius: 10px;
            z-index: 100;
            box-shadow: 0 0 20px rgba(0, 100, 0, 0.5);
        }
        #controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 50, 0, 0.8);
            padding: 15px;
            border-radius: 15px;
            color: white;
            z-index: 100;
            display: flex;
            gap: 10px;
            align-items: center;
            box-shadow: 0 0 15px rgba(0, 80, 0, 0.6);
        }
        button {
            background: linear-gradient(to bottom, #4CAF50, #2E8B57);
            border: none;
            color: white;
            padding: 12px 20px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button:hover {
            background: linear-gradient(to bottom, #45a049, #2E7D32);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        button:disabled {
            background: linear-gradient(to bottom, #cccccc, #999999);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .slider-container {
            margin: 0 15px;
        }
        .slider-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #ffffff;
        }
        input[type="range"] {
            width: 200px;
            height: 8px;
            -webkit-appearance: none;
            background: linear-gradient(to right, #2E8B57, #98FB98);
            border-radius: 5px;
            outline: none;
        }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: #ffffff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
        #molecule-counter {
            background-color: rgba(0, 80, 0, 0.7);
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            margin-left: 15px;
            min-width: 250px;
        }
        #explanation {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 100;
            font-size: 14px;
            line-height: 1.5;
        }
        #explanation h3 {
            color: #2E8B57;
            margin-top: 0;
            border-bottom: 2px solid #2E8B57;
            padding-bottom: 5px;
        }
        .step-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 100, 0, 0.9);
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            font-size: 24px;
            font-weight: bold;
            z-index: 200;
            display: none;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
            text-align: center;
        }
        .completion-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 100, 0, 0.9);
            color: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            text-align: center;
            z-index: 200;
            box-shadow: 0 0 30px rgba(0, 255, 0, 0.7);
            display: none;
        }
        .completion-message h2 {
            margin-top: 0;
            color: #98FB98;
        }
        .completion-message ul {
            text-align: left;
            margin: 20px 0;
            padding-left: 20px;
        }
        .completion-message li {
            margin-bottom: 8px;
        }
        #credits {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 100;
        }

        #progress-container {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            background-color: rgba(0, 80, 0, 0.7);
            padding: 10px;
            border-radius: 8px;
            display: none;
            z-index: 101;
        }
        #progress-bar {
            height: 20px;
            background: linear-gradient(to right, #2E8B57, #98FB98);
            border-radius: 5px;
            width: 0%;
            transition: width 0.3s;
        }
        #reset-effects {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            opacity: 0;
            z-index: 500;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div id="info-panel">
        <h2 style="color: #98FB98; text-align: center; margin-top: 0;">Photosynthèse</h2>
        <p style="text-align: center;">Laboratoire Virtuel - SVT 3ème</p>
        <div style="border-top: 1px solid #2E8B57; margin: 10px 0; padding-top: 10px;">
            <p><strong>Objectif :</strong> Comprendre comment les plantes transforment la lumière en énergie chimique.</p>
        </div>
    </div>

    <div id="controls">
        <button id="startBtn">Démarrer l'Expérience</button>
        <button id="resetBtn" disabled>Réinitialiser</button>
        
        <div class="slider-container">
            <label for="lightIntensity">Intensité Lumineuse ☀️</label>
            <input type="range" id="lightIntensity" min="0" max="2" step="0.1" value="0" disabled>
        </div>
        
        <div class="slider-container">
            <label for="co2Amount">Concentration CO₂ 🏭</label>
            <input type="range" id="co2Amount" min="1" max="10" step="1" value="1" disabled>
        </div>
        
        <div id="molecule-counter">
            <div>🌱 État: <span id="state-display">Prêt</span></div>
            <div>CO₂: <span id="co2-count">0</span> | H₂O: <span id="h2o-count">0</span></div>
            <div>O₂: <span id="o2-count">0</span> | Glucose: <span id="glucose-count">0</span></div>
        </div>
    </div>

    <div id="explanation">
        <h3>Explications Scientifiques</h3>
        <div id="current-explanation">Cliquez sur "Démarrer" pour commencer l'expérience.</div>
    </div>

    <div id="step-indicator" class="step-indicator"></div>

    <div id="completion-message" class="completion-message">
        <h2>🎉 Photosynthèse Réussie !</h2>
        <p>La plante a transformé avec succès :</p>
        <ul>
            <li><strong>6 CO₂</strong> + <strong>6 H₂O</strong></li>
            <li>en <strong>1 Glucose</strong> (C₆H₁₂O₆)</li>
            <li>et <strong>6 O₂</strong> (rejeté dans l'air)</li>
        </ul>
        <p>Équation chimique :<br>
        6CO₂ + 6H₂O + lumière → C₆H₁₂O₆ + 6O₂</p>
        <button id="close-message" style="margin-top: 15px;">Fermer</button>
    </div>

    <div id="credits">Simulation créée pour le projet de laboratoire virtuel SVT</div>

    <div id="progress-container">
        <div style="color: white; text-align: center; margin-bottom: 5px;">Réinitialisation en cours...</div>
        <div id="progress-bar"></div>
    </div>
    
    <div id="reset-effects"></div>

    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        // ========== CONFIGURATION ==========

   // 1. Système de réinitialisation renforcé
        async function resetSimulation() {
            // Désactiver les contrôles pendant la réinitialisation
            document.getElementById('resetBtn').disabled = true;
            document.getElementById('progress-container').style.display = 'block';
            
            // Effet visuel de flash blanc
            gsap.to("#reset-effects", {
                opacity: 0.8,
                duration: 0.3,
                onComplete: () => {
                    gsap.to("#reset-effects", { 
                        opacity: 0, 
                        duration: 0.5 
                    });
                }
            });
            
            // Animation de la barre de progression
            gsap.to("#progress-bar", {
                width: "100%",
                duration: 1.5,
                ease: "power2.inOut"
            });
            
            // Étape 1: Suppression des molécules (avec effet)
            await removeAllMolecules();
            updateProgress(25);
            
            // Étape 2: Réinitialisation des chloroplastes
            await resetChloroplasts();
            updateProgress(50);
            
            // Étape 3: Réinitialisation de l'environnement
            await resetEnvironment();
            updateProgress(75);
            
            // Étape 4: Remise à zéro complète
            completeReset();
            updateProgress(100);
            
            // Fin de la réinitialisation
            setTimeout(() => {
                document.getElementById('progress-container').style.display = 'none';
                document.getElementById('progress-bar').style.width = '0%';
                
                // Message de confirmation
                showTemporaryMessage("Réinitialisation terminée !", 2000);
            }, 500);
        }
        
        async function removeAllMolecules() {
            return new Promise(resolve => {
                // Animation de disparition des molécules
                const allMolecules = [...co2Molecules, ...h2oMolecules, ...o2Molecules, ...glucoseMolecules];
                const animations = [];
                
                allMolecules.forEach(mol => {
                    animations.push(
                        gsap.to(mol.scale, {
                            x: 0.1,
                            y: 0.1,
                            z: 0.1,
                            duration: 0.3,
                            onComplete: () => scene.remove(mol)
                        })
                    );
                });
                
                // Animation des particules
                particleSystems.forEach(ps => {
                    animations.push(
                        gsap.to(ps.material, {
                            opacity: 0,
                            duration: 0.5,
                            onComplete: () => scene.remove(ps)
                        })
                    );
                });
                
                Promise.all(animations).then(() => {
                    co2Molecules = [];
                    h2oMolecules = [];
                    o2Molecules = [];
                    glucoseMolecules = [];
                    particleSystems = [];
                    resolve();
                });
            });
        }
        
        async function resetChloroplasts() {
            return new Promise(resolve => {
                const animations = [];
                activeChloroplasts = 0;
                
                chloroplasts.forEach(chloro => {
                    chloro.userData.active = false;
                    animations.push(
                        gsap.to(chloro.material, {
                            emissiveIntensity: 0,
                            duration: 0.8,
                            ease: "power2.out"
                        })
                    );
                });
                
                Promise.all(animations).then(resolve);
            });
        }
        
        async function resetEnvironment() {
            return new Promise(resolve => {
                // Réinitialiser la lumière
                gsap.to(sunLight, {
                    intensity: CONFIG.light.minIntensity,
                    duration: 1,
                    onComplete: resolve
                });
                
                // Réinitialiser les curseurs
                document.getElementById('lightIntensity').value = 0;
                document.getElementById('co2Amount').value = 1;
            });
        }
        
        function completeReset() {
            // Réinitialiser les compteurs
            moleculeCounts = { co2: 0, h2o: 0, o2: 0, glucose: 0 };
            updateMoleculeCount();
            
            // Réinitialiser l'état
            animationState = 'idle';
            document.getElementById('state-display').textContent = 'Prêt';
            
            // Réactiver le bouton de démarrage
            document.getElementById('startBtn').disabled = false;
            
            // Recentrer la caméra
            gsap.to(camera.position, {
                x: 0,
                y: 8,
                z: 15,
                duration: 1.5,
                ease: "power2.inOut"
            });
            
            controls.reset();
            
            // Mettre à jour les explications
            updateExplanation();
        }
        
        function updateProgress(percent) {
            document.getElementById('progress-bar').style.width = percent + '%';
        }
        
        // 2. Nouveaux effets visuels
        function showTemporaryMessage(message, duration) {
            const msgElement = document.createElement('div');
            msgElement.style.position = 'fixed';
            msgElement.style.top = '50%';
            msgElement.style.left = '50%';
            msgElement.style.transform = 'translate(-50%, -50%)';
            msgElement.style.backgroundColor = 'rgba(0, 100, 0, 0.9)';
            msgElement.style.color = 'white';
            msgElement.style.padding = '20px 30px';
            msgElement.style.borderRadius = '10px';
            msgElement.style.zIndex = '600';
            msgElement.style.textAlign = 'center';
            msgElement.style.fontSize = '20px';
            msgElement.style.boxShadow = '0 0 20px rgba(0, 255, 0, 0.5)';
            msgElement.textContent = message;
            
            document.body.appendChild(msgElement);
            
            setTimeout(() => {
                gsap.to(msgElement, {
                    opacity: 0,
                    duration: 0.5,
                    onComplete: () => {
                        document.body.removeChild(msgElement);
                    }
                });
            }, duration - 500);
            
            setTimeout(() => {
                if (msgElement.parentNode) {
                    document.body.removeChild(msgElement);
                }
            }, duration);
        }
        
        // 3. Protection contre les clics multiples
        let isResetting = false;
        
        function safeReset() {
            if (!isResetting) {
                isResetting = true;
                resetSimulation().then(() => {
                    isResetting = false;
                });
            }
        }
        
        // Mettre à jour l'écouteur d'événements
        document.getElementById('resetBtn').addEventListener('click', safeReset);
        
        const CONFIG = {
            light: {
                minIntensity: 0,
                maxIntensity: 2,
                activationThreshold: 0.7
            },
            molecules: {
                co2: {
                    max: 20,
                    absorptionRate: 0.2
                },
                h2o: {
                    max: 15,
                    absorptionRate: 0.3
                },
                o2: {
                    releaseInterval: 800,
                    bubbleSpeed: 0.5
                },
                glucose: {
                    formationTime: 3000,
                    size: 0.8
                }
            },
            animation: {
                chloroplastPulseSpeed: 0.002,
                moleculeRotationSpeed: 0.01
            }
        };

        // ========== INITIALISATION ==========
        let scene, camera, renderer, controls;
        let sunLight, leaf, chloroplasts = [];
        let co2Molecules = [], h2oMolecules = [], o2Molecules = [], glucoseMolecules = [];
        let particleSystems = [];
        let animationState = 'idle'; // idle, light, water, co2, reaction, complete
        let moleculeCounts = { co2: 0, h2o: 0, o2: 0, glucose: 0 };
        let activeChloroplasts = 0;

        init();

        function init() {
            createScene();
            createCamera();
            createRenderer();
            createLights();
            createEnvironment();
            createPlant();
            setupEventListeners();
            animate();
            window.addEventListener('resize', onWindowResize);
        }

        function createScene() {
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x87CEEB);
            scene.fog = new THREE.FogExp2(0x87CEEB, 0.002);
        }

        function createCamera() {
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 8, 15);
            camera.lookAt(0, 5, 0);
        }

        function createRenderer() {
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            document.body.appendChild(renderer.domElement);
        }

        function createLights() {
            // Lumière ambiante
            const ambientLight = new THREE.AmbientLight(0x404040, 0.5);
            scene.add(ambientLight);

            // Soleil (lumière directionnelle)
            sunLight = new THREE.DirectionalLight(0xffffbb, CONFIG.light.minIntensity);
            sunLight.position.set(10, 20, 10);
            sunLight.castShadow = true;
            sunLight.shadow.mapSize.width = 2048;
            sunLight.shadow.mapSize.height = 2048;
            sunLight.shadow.camera.near = 0.5;
            sunLight.shadow.camera.far = 50;
            scene.add(sunLight);

            // Helper pour visualiser la lumière (désactivé en production)
            // const helper = new THREE.DirectionalLightHelper(sunLight, 5);
            // scene.add(helper);
        }

        function createEnvironment() {
            // Sol
            const groundGeometry = new THREE.CircleGeometry(30, 32);
            const groundMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x3a5f0b,
                roughness: 0.8,
                metalness: 0.2
            });
            const ground = new THREE.Mesh(groundGeometry, groundMaterial);
            ground.rotation.x = -Math.PI / 2;
            ground.receiveShadow = true;
            scene.add(ground);

            // Ciel
            const skyGeometry = new THREE.SphereGeometry(100, 32, 32);
            const skyMaterial = new THREE.MeshBasicMaterial({ 
                color: 0x87CEEB,
                side: THREE.BackSide,
                fog: true
            });
            const sky = new THREE.Mesh(skyGeometry, skyMaterial);
            scene.add(sky);

            // Soleil visuel
            const sunGeometry = new THREE.SphereGeometry(2, 32, 32);
            const sunMaterial = new THREE.MeshBasicMaterial({ 
                color: 0xffff00,
                transparent: true,
                opacity: 0.7
            });
            const sun = new THREE.Mesh(sunGeometry, sunMaterial);
            sun.position.copy(sunLight.position);
            scene.add(sun);

            // Nuages (optionnel)
            for (let i = 0; i < 5; i++) {
                const cloud = createCloud();
                cloud.position.set(
                    (Math.random() - 0.5) * 100,
                    15 + Math.random() * 10,
                    (Math.random() - 0.5) * 100
                );
                scene.add(cloud);
            }
        }

        function createCloud() {
            const cloud = new THREE.Group();
            const cloudGeometry = new THREE.SphereGeometry(1, 8, 8);
            const cloudMaterial = new THREE.MeshLambertMaterial({ 
                color: 0xffffff,
                transparent: true,
                opacity: 0.8
            });

            for (let i = 0; i < 5; i++) {
                const part = new THREE.Mesh(cloudGeometry, cloudMaterial);
                part.position.set(
                    (Math.random() - 0.5) * 3,
                    (Math.random() - 0.5) * 2,
                    (Math.random() - 0.5) * 3
                );
                part.scale.set(
                    1 + Math.random() * 2,
                    0.8 + Math.random() * 0.4,
                    1 + Math.random() * 2
                );
                cloud.add(part);
            }

            return cloud;
        }

        function createPlant() {
            // Pot
            const potGeometry = new THREE.CylinderGeometry(2, 1.5, 2, 32);
            const potMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x8B4513,
                roughness: 0.7,
                metalness: 0.1
            });
            const pot = new THREE.Mesh(potGeometry, potMaterial);
            pot.position.y = 1;
            pot.castShadow = true;
            pot.receiveShadow = true;
            scene.add(pot);

            // Terre
            const soilGeometry = new THREE.CylinderGeometry(1.4, 1.4, 1, 32);
            const soilMaterial = new THREE.MeshStandardMaterial({ color: 0x5E2605 });
            const soil = new THREE.Mesh(soilGeometry, soilMaterial);
            soil.position.y = 2;
            soil.castShadow = true;
            soil.receiveShadow = true;
            scene.add(soil);

            // Tige
            const stemGeometry = new THREE.CylinderGeometry(0.2, 0.3, 6, 8);
            const stemMaterial = new THREE.MeshStandardMaterial({ color: 0x2E8B57 });
            const stem = new THREE.Mesh(stemGeometry, stemMaterial);
            stem.position.y = 5;
            stem.castShadow = true;
            stem.receiveShadow = true;
            scene.add(stem);

            // Feuille principale
            const leafGeometry = new THREE.SphereGeometry(2, 32, 32);
            leafGeometry.scale(2, 0.5, 1);
            const leafMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x32CD32,
                roughness: 0.7,
                metalness: 0.1,
                transparent: true,
                opacity: 0.9
            });
            leaf = new THREE.Mesh(leafGeometry, leafMaterial);
            leaf.position.set(0, 7, 0);
            leaf.rotation.z = Math.PI / 4;
            leaf.castShadow = true;
            leaf.receiveShadow = true;
            scene.add(leaf);

            // Chloroplastes (plusieurs dans la feuille)
            const chloroplastGeometry = new THREE.SphereGeometry(0.3, 16, 16);
            const chloroplastMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x00FF00,
                emissive: 0x005500,
                emissiveIntensity: 0
            });

            for (let i = 0; i < 15; i++) {
                const chloroplast = new THREE.Mesh(chloroplastGeometry, chloroplastMaterial.clone());
                
                // Position aléatoire dans la feuille
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.random() * Math.PI;
                const radius = 1.5 * Math.random();
                
                chloroplast.position.x = radius * Math.sin(phi) * Math.cos(theta);
                chloroplast.position.y = radius * Math.sin(phi) * Math.sin(theta);
                chloroplast.position.z = radius * Math.cos(phi);
                
                chloroplast.position.add(leaf.position);
                chloroplast.userData = { active: false };
                chloroplasts.push(chloroplast);
                scene.add(chloroplast);
            }

            // Racines (simplifiées)
            createRootSystem(stem.position.clone().sub(new THREE.Vector3(0, 3, 0)));
        }

        function createRootSystem(basePosition) {
            const rootMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x8B4513,
                roughness: 0.9,
                metalness: 0
            });

            // Racine principale
            const mainRootGeometry = new THREE.CylinderGeometry(0.15, 0.1, 3, 8);
            const mainRoot = new THREE.Mesh(mainRootGeometry, rootMaterial);
            mainRoot.position.copy(basePosition);
            mainRoot.rotation.z = Math.PI / 2;
            scene.add(mainRoot);

            // Racines secondaires
            for (let i = 0; i < 8; i++) {
                const length = 1 + Math.random() * 2;
                const rootGeometry = new THREE.CylinderGeometry(0.08, 0.03, length, 6);
                const root = new THREE.Mesh(rootGeometry, rootMaterial);
                
                root.position.copy(basePosition);
                root.position.x += (Math.random() - 0.5) * 0.5;
                root.position.z += (Math.random() - 0.5) * 0.5;
                root.position.y -= length / 2;
                
                root.rotation.x = Math.random() * Math.PI / 4 - Math.PI / 8;
                root.rotation.z = Math.random() * Math.PI / 4 - Math.PI / 8;
                
                scene.add(root);
            }
        }

        function createCO2Molecule(position) {
            const group = new THREE.Group();
            
            // Atome de carbone (noir)
            const carbon = new THREE.Mesh(
                new THREE.SphereGeometry(0.15, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0x333333,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            
            // Atomes d'oxygène (rouge)
            const oxygen1 = new THREE.Mesh(
                new THREE.SphereGeometry(0.12, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0xFF3333,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            oxygen1.position.x = -0.35;
            
            const oxygen2 = new THREE.Mesh(
                new THREE.SphereGeometry(0.12, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0xFF3333,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            oxygen2.position.x = 0.35;
            
            group.add(carbon, oxygen1, oxygen2);
            group.position.copy(position || new THREE.Vector3(
                (Math.random() - 0.5) * 10,
                10,
                (Math.random() - 0.5) * 10
            ));
            
            group.userData = { 
                type: 'co2', 
                state: 'falling',
                speed: 0.5 + Math.random() * 0.5,
                rotationSpeed: 0.01 + Math.random() * 0.02
            };
            
            // Ajouter un halo lumineux
            const haloGeometry = new THREE.SphereGeometry(0.25, 16, 16);
            const haloMaterial = new THREE.MeshBasicMaterial({
                color: 0xFF0000,
                transparent: true,
                opacity: 0.3
            });
            const halo = new THREE.Mesh(haloGeometry, haloMaterial);
            group.add(halo);
            
            return group;
        }

        function createH2OMolecule(position) {
            const group = new THREE.Group();
            
            // Atome d'oxygène (bleu)
            const oxygen = new THREE.Mesh(
                new THREE.SphereGeometry(0.15, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0x3399FF,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            
            // Atomes d'hydrogène (blanc)
            const hydrogen1 = new THREE.Mesh(
                new THREE.SphereGeometry(0.08, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0xFFFFFF,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            hydrogen1.position.set(-0.2, 0.25, 0);
            
            const hydrogen2 = new THREE.Mesh(
                new THREE.SphereGeometry(0.08, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0xFFFFFF,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            hydrogen2.position.set(0.2, 0.25, 0);
            
            group.add(oxygen, hydrogen1, hydrogen2);
            group.position.copy(position || new THREE.Vector3(
                (Math.random() - 0.5) * 3,
                -1,
                (Math.random() - 0.5) * 3
            ));
            
            group.userData = { 
                type: 'h2o', 
                state: 'rising',
                speed: 0.3 + Math.random() * 0.3,
                rotationSpeed: 0.01 + Math.random() * 0.01
            };
            
            return group;
        }

        function createO2Molecule(position) {
            const group = new THREE.Group();
            
            // Deux atomes d'oxygène (bleu clair)
            const oxygen1 = new THREE.Mesh(
                new THREE.SphereGeometry(0.12, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0x00FFFF,
                    emissive: 0x0088AA,
                    emissiveIntensity: 0.3,
                    specular: 0x111111,
                    shininess: 50
                })
            );
            oxygen1.position.x = -0.25;
            
            const oxygen2 = new THREE.Mesh(
                new THREE.SphereGeometry(0.12, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: 0x00FFFF,
                    emissive: 0x0088AA,
                    emissiveIntensity: 0.3,
                    specular: 0x111111,
                    shininess: 50
                })
            );
            oxygen2.position.x = 0.25;
            
            group.add(oxygen1, oxygen2);
            group.position.copy(position || leaf.position.clone());
            
            group.userData = { 
                type: 'o2', 
                state: 'rising',
                speed: 0.4 + Math.random() * 0.3,
                rotationSpeed: 0.02 + Math.random() * 0.02
            };
            
            return group;
        }

        function createGlucoseMolecule(position) {
            const group = new THREE.Group();
            const size = CONFIG.molecules.glucose.size;
            
            // Structure simplifiée du glucose (C₆H₁₂O₆)
            const carbonColor = 0x333333;
            const oxygenColor = 0xFF3333;
            const hydrogenColor = 0xEEEEEE;
            
            // Position des atomes dans une structure cyclique
            const atomPositions = [
                { x: 0, y: size * 1.2, z: 0 },       // Haut
                { x: size * 0.9, y: size * 0.6, z: 0 },  // Haut droite
                { x: size * 0.9, y: -size * 0.6, z: 0 }, // Bas droite
                { x: 0, y: -size * 1.2, z: 0 },      // Bas
                { x: -size * 0.9, y: -size * 0.6, z: 0 }, // Bas gauche
                { x: -size * 0.9, y: size * 0.6, z: 0 }   // Haut gauche
            ];
            
            // Atomes de carbone (cycle)
            atomPositions.forEach(pos => {
                const carbon = new THREE.Mesh(
                    new THREE.SphereGeometry(size * 0.15, 16, 16),
                    new THREE.MeshPhongMaterial({ 
                        color: carbonColor,
                        specular: 0x111111,
                        shininess: 30
                    })
                );
                carbon.position.set(pos.x, pos.y, pos.z);
                group.add(carbon);
            });
            
            // Atomes d'oxygène (positionnés sur certains carbones)
            const oxygen1 = new THREE.Mesh(
                new THREE.SphereGeometry(size * 0.12, 16, 16),
                new THREE.MeshPhongMaterial({ 
                    color: oxygenColor,
                    specular: 0x111111,
                    shininess: 30
                })
            );
            oxygen1.position.set(0, size * 1.6, 0);
            group.add(oxygen1);
            
            // Atomes d'hydrogène (simplifiés)
            for (let i = 0; i < 12; i++) {
                const angle = (i / 12) * Math.PI * 2;
                const radius = size * 1.8;
                const hydrogen = new THREE.Mesh(
                    new THREE.SphereGeometry(size * 0.08, 16, 16),
                    new THREE.MeshPhongMaterial({ 
                        color: hydrogenColor,
                        specular: 0x111111,
                        shininess: 30
                    })
                );
                hydrogen.position.set(
                    Math.cos(angle) * radius * (0.8 + Math.random() * 0.4),
                    Math.sin(angle) * radius * (0.8 + Math.random() * 0.4),
                    (Math.random() - 0.5) * 0.5
                );
                group.add(hydrogen);
            }
            
            group.position.copy(position || new THREE.Vector3(
                (Math.random() - 0.5) * 2,
                4,
                (Math.random() - 0.5) * 2
            ));
            
            group.userData = { 
                type: 'glucose', 
                state: 'stored',
                rotationSpeed: 0.005 + Math.random() * 0.005
            };
            
            // Ajouter un effet de brillance
            const glow = new THREE.Mesh(
                new THREE.SphereGeometry(size * 0.5, 16, 16),
                new THREE.MeshBasicMaterial({
                    color: 0x88FF88,
                    transparent: true,
                    opacity: 0.2
                })
            );
            group.add(glow);
            
            return group;
        }

        function createPhotonParticles(count, color, position) {
            const particlesGeometry = new THREE.BufferGeometry();
            const particlesMaterial = new THREE.PointsMaterial({
                color: color,
                size: 0.1,
                transparent: true,
                opacity: 0.8,
                blending: THREE.AdditiveBlending
            });
            
            const positions = new Float32Array(count * 3);
            const sizes = new Float32Array(count);
            const colors = new Float32Array(count * 3);
            
            const hsl = { h: 0, s: 0, l: 0 };
            THREE.Color.prototype.getHSL.call(new THREE.Color(color), hsl);
            
            for (let i = 0; i < count; i++) {
                positions[i * 3] = (Math.random() - 0.5) * 2;
                positions[i * 3 + 1] = (Math.random() - 0.5) * 2;
                positions[i * 3 + 2] = (Math.random() - 0.5) * 2;
                
                sizes[i] = 0.05 + Math.random() * 0.1;
                
                // Variation de couleur
                colors[i * 3] = hsl.h + (Math.random() - 0.5) * 0.1;
                colors[i * 3 + 1] = hsl.s;
                colors[i * 3 + 2] = hsl.l * (0.9 + Math.random() * 0.2);
            }
            
            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            particlesGeometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
            particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
            
            const particleSystem = new THREE.Points(particlesGeometry, particlesMaterial);
            particleSystem.position.copy(position);
            particleSystem.userData = {
                type: 'photon',
                time: 0,
                speed: 0.5 + Math.random()
            };
            
            return particleSystem;
        }

        function createEnergyParticles(type, count, position) {
            const color = type === 'atp' ? 0xFF00FF : 0x00FF00;
            const particles = createPhotonParticles(count, color, position);
            particles.userData.subType = type;
            return particles;
        }

        function setupEventListeners() {
            // Boutons de contrôle
            document.getElementById('startBtn').addEventListener('click', startSimulation);
            document.getElementById('resetBtn').addEventListener('click', resetSimulation);
            document.getElementById('close-message').addEventListener('click', () => {
                document.getElementById('completion-message').style.display = 'none';
            });
            
            // Sliders
            document.getElementById('lightIntensity').addEventListener('input', function() {
                const value = parseFloat(this.value);
                sunLight.intensity = value;
                
                // Mise à jour de l'explication
                updateExplanation();
                
                // Activation des chloroplastes quand la lumière est suffisante
                if (value > CONFIG.light.activationThreshold && animationState === 'light') {
                    activateChloroplasts();
                }
            });
            
            document.getElementById('co2Amount').addEventListener('input', function() {
                if (animationState === 'co2') {
                    const count = parseInt(this.value);
                    addCO2Molecules(count);
                    updateExplanation();
                }
            });
            
            // Contrôles de la caméra
            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;
            controls.minDistance = 5;
            controls.maxDistance = 30;
            controls.maxPolarAngle = Math.PI * 0.9;
        }

        function startSimulation() {
            document.getElementById('startBtn').disabled = true;
            document.getElementById('lightIntensity').disabled = false;
            document.getElementById('state-display').textContent = 'Phase Lumineuse';
            
            animationState = 'light';
            updateMoleculeCount();
            updateExplanation();
            
            // Animation d'introduction
            showStepMessage("Phase Lumineuse", "Augmentez l'intensité lumineuse pour activer les chloroplastes");
            
            gsap.to(camera.position, {
                x: 0,
                y: 7,
                z: 12,
                duration: 2,
                onComplete: () => {
                    document.getElementById('co2Amount').disabled = false;
                    animationState = 'co2';
                    document.getElementById('state-display').textContent = 'Absorption CO₂';
                    updateExplanation();
                    showStepMessage("Absorption CO₂", "Réglez la concentration en CO₂ pour commencer la photosynthèse");
                }
            });
        }

        function resetSimulation() {
            // Réinitialiser toutes les molécules
            co2Molecules.forEach(mol => scene.remove(mol));
            h2oMolecules.forEach(mol => scene.remove(mol));
            o2Molecules.forEach(mol => scene.remove(mol));
            glucoseMolecules.forEach(mol => scene.remove(mol));
            
            // Réinitialiser les particules
            particleSystems.forEach(sys => scene.remove(sys));
            
            // Réinitialiser les compteurs
            co2Molecules = [];
            h2oMolecules = [];
            o2Molecules = [];
            glucoseMolecules = [];
            particleSystems = [];
            moleculeCounts = { co2: 0, h2o: 0, o2: 0, glucose: 0 };
            activeChloroplasts = 0;
            
            // Réinitialiser les contrôles
            document.getElementById('startBtn').disabled = false;
            document.getElementById('resetBtn').disabled = true;
            document.getElementById('lightIntensity').value = 0;
            document.getElementById('lightIntensity').disabled = true;
            document.getElementById('co2Amount').value = 1;
            document.getElementById('co2Amount').disabled = true;
            document.getElementById('state-display').textContent = 'Prêt';
            
            // Réinitialiser l'état
            animationState = 'idle';
            updateMoleculeCount();
            updateExplanation();
            
            // Réinitialiser la lumière
            sunLight.intensity = CONFIG.light.minIntensity;
            
            // Réinitialiser la caméra
            gsap.to(camera.position, {
                x: 0,
                y: 8,
                z: 15,
                duration: 1
            });
            
            // Réinitialiser les chloroplastes
            chloroplasts.forEach(chloro => {
                chloro.material.emissiveIntensity = 0;
                chloro.userData.active = false;
            });
            
            // Masquer le message de complétion
            document.getElementById('completion-message').style.display = 'none';
        }

        function activateChloroplasts() {
            document.getElementById('state-display').textContent = 'Activation Chloroplastes';
            updateExplanation();
            
            chloroplasts.forEach((chloroplast, i) => {
                // Activer progressivement
                setTimeout(() => {
                    chloroplast.userData.active = true;
                    activeChloroplasts++;
                    
                    gsap.to(chloroplast.material, {
                        emissiveIntensity: 0.5,
                        duration: 1,
                        onComplete: () => {
                            if (activeChloroplasts === chloroplasts.length) {
                                startChemicalReactions();
                            }
                        }
                    });
                    
                    // Ajouter des particules de photons
                    const particles = createPhotonParticles(50, 0xffff00, chloroplast.position);
                    scene.add(particles);
                    particleSystems.push(particles);
                    
                    // Animation des particules
                    particles.userData.time = 0;
                    
                }, i * 200);
            });
            
            // Ajouter des molécules d'eau depuis les racines
            addH2OMolecules(5);
        }

        function addCO2Molecules(count) {
            const co2Amount = parseInt(document.getElementById('co2Amount').value);
            const actualCount = Math.min(count, CONFIG.molecules.co2.max - moleculeCounts.co2);
            
            if (actualCount <= 0) return;
            
            for (let i = 0; i < actualCount; i++) {
                setTimeout(() => {
                    const co2 = createCO2Molecule();
                    scene.add(co2);
                    co2Molecules.push(co2);
                    moleculeCounts.co2++;
                    updateMoleculeCount();
                    
                    // Animation de chute vers la feuille
                    const targetPos = new THREE.Vector3(
                        (Math.random() - 0.5) * 3,
                        7 + (Math.random() - 0.5),
                        (Math.random() - 0.5) * 3
                    );
                    
                    const duration = 2 + Math.random() * 2;
                    
                    gsap.to(co2.position, {
                        x: targetPos.x,
                        y: targetPos.y,
                        z: targetPos.z,
                        duration: duration,
                        onComplete: () => {
                            co2.userData.state = 'absorbed';
                            // Animation d'absorption
                            gsap.to(co2.scale, {
                                x: 0.1,
                                y: 0.1,
                                z: 0.1,
                                duration: 0.5,
                                onComplete: () => scene.remove(co2)
                            });
                        }
                    });
                    
                    // Rotation pendant la chute
                    gsap.to(co2.rotation, {
                        y: Math.PI * 4,
                        duration: duration
                    });
                    
                }, i * 300);
            }
        }

        function addH2OMolecules(count) {
            const actualCount = Math.min(count, CONFIG.molecules.h2o.max - moleculeCounts.h2o);
            
            if (actualCount <= 0) return;
            
            for (let i = 0; i < actualCount; i++) {
                setTimeout(() => {
                    const h2o = createH2OMolecule();
                    scene.add(h2o);
                    h2oMolecules.push(h2o);
                    moleculeCounts.h2o++;
                    updateMoleculeCount();
                    
                    // Animation de montée vers la feuille
                    const targetPos = new THREE.Vector3(
                        (Math.random() - 0.5) * 2,
                        6 + (Math.random() - 0.5),
                        (Math.random() - 0.5) * 2
                    );
                    
                    const duration = 3 + Math.random() * 2;
                    
                    gsap.to(h2o.position, {
                        x: targetPos.x,
                        y: targetPos.y,
                        z: targetPos.z,
                        duration: duration,
                        onComplete: () => {
                            h2o.userData.state = 'absorbed';
                            // Animation d'absorption
                            gsap.to(h2o.scale, {
                                x: 0.1,
                                y: 0.1,
                                z: 0.1,
                                duration: 0.5,
                                onComplete: () => scene.remove(h2o)
                            });
                        }
                    });
                    
                }, i * 500);
            }
        }

        function startChemicalReactions() {
            animationState = 'reaction';
            document.getElementById('state-display').textContent = 'Réactions Chimiques';
            updateExplanation();
            
            showStepMessage("Phase Photochimique", "La lumière est convertie en énergie chimique (ATP et NADPH)");
            
            // Phase lumineuse - production d'ATP et NADPH
            createEnergyPhase();
            
            // Après un délai, commencer le cycle de Calvin
            setTimeout(() => {
                startCalvinCycle();
            }, 4000);
        }

        function createEnergyPhase() {
            // Créer des particules représentant l'ATP et NADPH
            const atpParticles = createEnergyParticles('atp', 30, leaf.position);
            const nadphParticles = createEnergyParticles('nadph', 30, leaf.position);
            
            scene.add(atpParticles);
            scene.add(nadphParticles);
            particleSystems.push(atpParticles, nadphParticles);
            
            // Animation des particules d'énergie
            atpParticles.userData.direction = new THREE.Vector3(
                Math.random() - 0.5,
                Math.random() * 0.5 + 0.5,
                Math.random() - 0.5
            ).normalize();
            
            nadphParticles.userData.direction = new THREE.Vector3(
                Math.random() - 0.5,
                Math.random() * 0.5 + 0.5,
                Math.random() - 0.5
            ).normalize();
        }

        function startCalvinCycle() {
            showStepMessage("Cycle de Calvin", "Le CO₂ est transformé en glucose grâce à l'ATP et NADPH");
            
            // Produire de l'O₂ (bulles qui s'échappent)
            produceOxygen();
            
            // Après un délai, produire du glucose
            setTimeout(() => {
                produceGlucose();
                completeSimulation();
            }, CONFIG.molecules.glucose.formationTime);
        }

        function produceOxygen() {
            const o2Count = Math.min(6, Math.floor(moleculeCounts.co2 * CONFIG.molecules.co2.absorptionRate));
            
            for (let i = 0; i < o2Count; i++) {
                setTimeout(() => {
                    const o2 = createO2Molecule();
                    scene.add(o2);
                    o2Molecules.push(o2);
                    moleculeCounts.o2++;
                    moleculeCounts.co2--;
                    updateMoleculeCount();
                    
                    // Position de départ aléatoire sur la feuille
                    const startPos = leaf.position.clone();
                    startPos.x += (Math.random() - 0.5) * 2;
                    startPos.z += (Math.random() - 0.5) * 2;
                    o2.position.copy(startPos);
                    
                    // Animation de bulles qui montent
                    const duration = 8 + Math.random() * 4;
                    const targetPos = new THREE.Vector3(
                        startPos.x + (Math.random() - 0.5) * 5,
                        startPos.y + 15,
                        startPos.z + (Math.random() - 0.5) * 5
                    );
                    
                    gsap.to(o2.position, {
                        x: targetPos.x,
                        y: targetPos.y,
                        z: targetPos.z,
                        duration: duration,
                        onComplete: () => {
                            scene.remove(o2);
                            moleculeCounts.o2--;
                            updateMoleculeCount();
                        }
                    });
                    
                    // Rotation aléatoire
                    gsap.to(o2.rotation, {
                        x: Math.PI * 2,
                        y: Math.PI * 2,
                        z: Math.PI * 2,
                        duration: duration * 0.5,
                        repeat: -1
                    });
                    
                    // Effet de bulle
                    gsap.to(o2.scale, {
                        x: 1.2,
                        y: 1.2,
                        z: 1.2,
                        duration: 0.5,
                        yoyo: true,
                        repeat: -1
                    });
                    
                }, i * CONFIG.molecules.o2.releaseInterval);
            }
        }

        function produceGlucose() {
            const glucoseCount = Math.min(1, Math.floor(moleculeCounts.co2 * CONFIG.molecules.co2.absorptionRate / 6));
            
            for (let i = 0; i < glucoseCount; i++) {
                const glucose = createGlucoseMolecule();
                scene.add(glucose);
                glucoseMolecules.push(glucose);
                moleculeCounts.glucose++;
                updateMoleculeCount();
                
                // Position de départ (dans la feuille)
                glucose.position.copy(leaf.position);
                glucose.position.y += 0.5;
                
                // Animation de formation
                glucose.scale.set(0.1, 0.1, 0.1);
                gsap.to(glucose.scale, {
                    x: CONFIG.molecules.glucose.size,
                    y: CONFIG.molecules.glucose.size,
                    z: CONFIG.molecules.glucose.size,
                    duration: 2,
                    ease: "elastic.out(1, 0.5)"
                });
                
                // Animation de stockage
                gsap.to(glucose.position, {
                    y: 4 + Math.random(),
                    x: -3 + i * 2,
                    z: -1 + Math.random() * 2,
                    duration: 3,
                    delay: 0.5
                });
            }
        }

        function completeSimulation() {
            animationState = 'complete';
            document.getElementById('resetBtn').disabled = false;
            document.getElementById('state-display').textContent = 'Photosynthèse Complète';
            
            // Afficher le message de complétion
            setTimeout(() => {
                document.getElementById('completion-message').style.display = 'block';
            }, 1000);
            
            // Mettre à jour l'explication
            updateExplanation();
        }

        function updateMoleculeCount() {
            document.getElementById('co2-count').textContent = moleculeCounts.co2;
            document.getElementById('h2o-count').textContent = moleculeCounts.h2o;
            document.getElementById('o2-count').textContent = moleculeCounts.o2;
            document.getElementById('glucose-count').textContent = moleculeCounts.glucose;
        }

        function updateExplanation() {
            let explanation = "";
            
            switch (animationState) {
                case 'idle':
                    explanation = "Prêt à démarrer l'expérience. Cliquez sur 'Démarrer' pour commencer la simulation de photosynthèse.";
                    break;
                    
                case 'light':
                    explanation = `
                        <strong>Phase Lumineuse:</strong><br>
                        La chlorophylle dans les chloroplastes absorbe l'énergie lumineuse.<br>
                        <span style="color: #4CAF50;">➤ Augmentez l'intensité lumineuse pour activer les chloroplastes.</span><br><br>
                        <small>La lumière doit dépasser ${CONFIG.light.activationThreshold} pour activer la photosynthèse.</small>
                    `;
                    break;
                    
                case 'co2':
                    explanation = `
                        <strong>Absorption des Réactifs:</strong><br>
                        La plante absorbe le dioxyde de carbone (CO₂) par les stomates et l'eau (H₂O) par les racines.<br>
                        <span style="color: #4CAF50;">➤ Réglez la concentration en CO₂ avec le curseur.</span><br><br>
                        <small>Équation: 6CO₂ + 6H₂O + lumière → C₆H₁₂O₆ + 6O₂</small>
                    `;
                    break;
                    
                case 'reaction':
                    explanation = `
                        <strong>Réactions Chimiques:</strong><br>
                        1. <u>Phase Photochimique:</u> L'énergie lumineuse est convertie en ATP et NADPH.<br>
                        2. <u>Cycle de Calvin:</u> Le CO₂ est transformé en glucose grâce à l'énergie de l'ATP et NADPH.<br><br>
                        <small>Les chloroplastes verts clignotent lorsqu'ils sont actifs.</small>
                    `;
                    break;
                    
                case 'complete':
                    explanation = `
                        <strong>Photosynthèse Complète!</strong><br>
                        La plante a produit:<br>
                        - <span style="color: #00FFFF;">Oxygène (O₂)</span> rejeté dans l'atmosphère<br>
                        - <span style="color: #98FB98;">Glucose (C₆H₁₂O₆)</span> stocké comme réserve d'énergie<br><br>
                        <small>Cliquez sur 'Réinitialiser' pour recommencer l'expérience.</small>
                    `;
                    break;
            }
            
            document.getElementById('current-explanation').innerHTML = explanation;
        }

        function showStepMessage(title, description) {
            const stepIndicator = document.getElementById('step-indicator');
            stepIndicator.innerHTML = `<div style="font-size: 28px; margin-bottom: 10px;">${title}</div><div style="font-size: 18px;">${description}</div>`;
            stepIndicator.style.display = 'block';
            
            // Disparaître après 3 secondes
            setTimeout(() => {
                stepIndicator.style.opacity = '1';
                gsap.to(stepIndicator, {
                    opacity: 0,
                    duration: 1,
                    delay: 3,
                    onComplete: () => {
                        stepIndicator.style.display = 'none';
                        stepIndicator.style.opacity = '1';
                    }
                });
            }, 10);
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            requestAnimationFrame(animate);
            
            // Mettre à jour les contrôles de la caméra
            controls.update();
            
            // Animer les molécules
            animateMolecules();
            
            // Animer les chloroplastes
            animateChloroplasts();
            
            // Animer les particules
            animateParticles();
            
            // Rendu
            renderer.render(scene, camera);
        }

        function animateMolecules() {
            // Animer les molécules de CO₂
            co2Molecules.forEach(mol => {
                if (mol.userData.state === 'falling') {
                    mol.rotation.y += mol.userData.rotationSpeed;
                }
            });
            
            // Animer les molécules d'eau
            h2oMolecules.forEach(mol => {
                if (mol.userData.state === 'rising') {
                    mol.rotation.x += mol.userData.rotationSpeed;
                }
            });
            
            // Animer les molécules d'O₂
            o2Molecules.forEach(mol => {
                mol.rotation.x += mol.userData.rotationSpeed;
                mol.rotation.y += mol.userData.rotationSpeed * 0.5;
            });
            
            // Animer les molécules de glucose
            glucoseMolecules.forEach(mol => {
                mol.rotation.y += mol.userData.rotationSpeed;
            });
        }

        function animateChloroplasts() {
            chloroplasts.forEach(chloro => {
                if (chloro.userData.active) {
                    const pulse = Math.sin(Date.now() * CONFIG.animation.chloroplastPulseSpeed);
                    chloro.scale.x = 1 + pulse * 0.1;
                    chloro.scale.y = 1 + pulse * 0.1;
                    chloro.scale.z = 1 + pulse * 0.1;
                    
                    chloro.material.emissiveIntensity = 0.3 + pulse * 0.2;
                }
            });
        }

        function animateParticles() {
            const deltaTime = 0.016; // Approximation pour 60 FPS
            
            particleSystems.forEach((particles, index) => {
                if (particles.userData.type === 'photon') {
                    particles.userData.time += deltaTime;
                    
                    // Animation des particules de photons
                    const positions = particles.geometry.attributes.position.array;
                    const sizes = particles.geometry.attributes.size.array;
                    
                    for (let i = 0; i < positions.length / 3; i++) {
                        // Déplacement aléatoire
                        positions[i * 3] += (Math.random() - 0.5) * 0.05;
                        positions[i * 3 + 1] += (Math.random() - 0.5) * 0.05;
                        positions[i * 3 + 2] += (Math.random() - 0.5) * 0.05;
                        
                        // Taille pulsée
                        sizes[i] = 0.05 + Math.sin(particles.userData.time * 3 + i) * 0.05;
                    }
                    
                    particles.geometry.attributes.position.needsUpdate = true;
                    particles.geometry.attributes.size.needsUpdate = true;
                    
                } else if (particles.userData.type === 'energy') {
                    // Animation des particules d'énergie (ATP/NADPH)
                    particles.position.add(
                        new THREE.Vector3(
                            particles.userData.direction.x * 0.05,
                            particles.userData.direction.y * 0.05,
                            particles.userData.direction.z * 0.05
                        )
                    );
                    
                    // Faire tourner les particules
                    particles.rotation.x += 0.01;
                    particles.rotation.y += 0.01;
                    
                    // Disparaître après un certain temps
                    particles.userData.lifetime = (particles.userData.lifetime || 0) + deltaTime;
                    if (particles.userData.lifetime > 5) {
                        particles.material.opacity -= 0.02;
                        if (particles.material.opacity <= 0) {
                            scene.remove(particles);
                            particleSystems.splice(index, 1);
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>