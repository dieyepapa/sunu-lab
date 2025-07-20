<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation Tectonique 3D Interactive</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #2196F3;
            --accent: #FF9800;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }
        
        body { 
            margin: 0;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: var(--light);
        }
        
        #header {
            position: absolute;
            top: 0;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            z-index: 100;
            background: rgba(0,0,0,0.7);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--primary);
        }
        
        #header h1 {
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 10px rgba(198,40,40,0.3);
            letter-spacing: 1px;
        }
        
        #header p {
            margin: 5px 0 0;
            font-size: 1rem;
            opacity: 0.8;
        }
        
        #controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            background: rgba(0,0,0,0.7);
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            z-index: 100;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        button {
            background: linear-gradient(145deg, var(--primary), #5a6fd8);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(198,40,40,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(198,40,40,0.6);
        }
        
        button:active {
            transform: translateY(1px);
        }
        
        button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0) 45%,
                rgba(255,255,255,0.3) 48%,
                rgba(255,255,255,0) 50%,
                rgba(255,255,255,0) 100%
            );
            transform: rotate(30deg);
            transition: all 0.3s;
        }
        
        button:hover::after {
            left: 100%;
        }
        
        #reset-btn {
            background: linear-gradient(145deg, #555, #333);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        #reset-btn:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }
        
        #explanation {
            position: absolute;
            top: 100px;
            right: 20px;
            width: 300px;
            background: rgba(0,0,0,0.8);
            padding: 20px;
            border-radius: 15px;
            z-index: 100;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            transform: translateX(0);
            transition: transform 0.5s ease, opacity 0.5s ease;
            opacity: 0.9;
        }
        
        #explanation:hover {
            opacity: 1;
        }
        
        #explanation h3 {
            color: var(--accent);
            margin-top: 0;
            font-size: 1.3rem;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
            display: inline-block;
        }
        
        #explanation p {
            line-height: 1.6;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        
        #explanation strong {
            color: var(--secondary);
        }
        
        .step {
            position: relative;
            padding-left: 20px;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        
        .step::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 12px;
            height: 12px;
            background: var(--primary);
            border-radius: 50%;
        }
        
        .result {
            background: rgba(198,40,40,0.1);
            padding: 12px;
            border-radius: 8px;
            border-left: 3px solid var(--primary);
            margin-top: 12px;
            font-size: 0.9rem;
        }
        
        #toggle-explanation {
            position: absolute;
            top: 120px;
            right: 20px;
            background: rgba(0,0,0,0.7);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 101;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        #toggle-explanation:hover {
            background: var(--primary);
            transform: scale(1.1);
        }
        
        #explanation.hidden {
            transform: translateX(calc(100% + 20px));
        }
        
        #earth-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: url('https://cdn-icons-png.flaticon.com/512/44/44386.png') no-repeat center;
            background-size: contain;
            z-index: 100;
            filter: drop-shadow(0 0 10px rgba(33,150,243,0.7));
            animation: pulse 2s infinite alternate;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        
        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div id="earth-icon"></div>
    
    <div id="header">
        <h1>DYNAMIQUE TECTONIQUE 3D</h1>
        <p>Simulation interactive des mouvements des plaques terrestres</p>
    </div>
    
    <button id="toggle-explanation">?</button>
    
    <div id="explanation">
        <h3>Bienvenue dans la simulation</h3>
        <p>Sélectionnez un type de mouvement tectonique pour commencer l'expérience interactive.</p>
        <div class="result">
            <strong>Conseil :</strong> Cliquez sur les différents boutons pour découvrir tous les phénomènes géologiques.
        </div>
    </div>
    
    <div id="controls">
        <button onclick="showDivergent()">Dorsale</button>
        <button onclick="showSubduction()">Subduction</button>
        <button onclick="showCollision()">Collision</button>
        <button onclick="showTransform()">Faille</button>
        <button id="reset-btn" onclick="resetScene()">Réinitialiser</button>
    </div>
    
    <div id="canvas-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script>
        // Initialisation de la scène
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ 
            antialias: true,
            alpha: true
        });
        
        const explanation = document.getElementById('explanation');
        const toggleBtn = document.getElementById('toggle-explanation');
        const canvasContainer = document.getElementById('canvas-container');
        
        // Configuration du rendu
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        canvasContainer.appendChild(renderer.domElement);
        
        // Lumière
        const ambientLight = new THREE.AmbientLight(0x404040, 0.8);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(10, 10, 10);
        directionalLight.castShadow = true;
        directionalLight.shadow.mapSize.width = 2048;
        directionalLight.shadow.mapSize.height = 2048;
        scene.add(directionalLight);
        
        // Position de la caméra
        camera.position.z = 10;
        camera.position.y = 5;
        camera.lookAt(0, 0, 0);
        
        // Variables globales
        let currentAnimation = null;
        const plateMaterials = [
            new THREE.MeshPhongMaterial({ 
                color: 0x4CAF50,
                shininess: 30,
                specular: 0x111111
            }),
            new THREE.MeshPhongMaterial({ 
                color: 0x2196F3,
                shininess: 30,
                specular: 0x111111
            }),
            new THREE.MeshPhongMaterial({ 
                color: 0xFF9800,
                shininess: 30,
                specular: 0x111111
            }),
            new THREE.MeshPhongMaterial({ 
                color: 0x9C27B0,
                shininess: 30,
                specular: 0x111111
            })
        ];
        
        // Toggle pour l'explication
        toggleBtn.addEventListener('click', () => {
            explanation.classList.toggle('hidden');
            toggleBtn.textContent = explanation.classList.contains('hidden') ? '?' : '×';
        });
        
        // Création du modèle de base (croûte terrestre)
        function createEarthCrust() {
            const crustGeometry = new THREE.BoxGeometry(15, 1, 15);
            const crustMaterial = new THREE.MeshPhongMaterial({ 
                color: 0x795548,
                wireframe: false,
                shininess: 20,
                specular: 0x111111
            });
            const crust = new THREE.Mesh(crustGeometry, crustMaterial);
            crust.position.y = -2;
            crust.receiveShadow = true;
            scene.add(crust);
            return crust;
        }
        
        // Création d'une plaque tectonique
        function createPlate(width, height, depth, colorIndex, x, z) {
            const geometry = new THREE.BoxGeometry(width, height, depth);
            const plate = new THREE.Mesh(geometry, plateMaterials[colorIndex]);
            plate.position.set(x, 0, z);
            plate.castShadow = true;
            plate.receiveShadow = true;
            plate.userData = { 
                originalPosition: { x, z },
                colorIndex: colorIndex
            };
            scene.add(plate);
            
            // Effet de bordure
            const edges = new THREE.EdgesGeometry(geometry);
            const line = new THREE.LineSegments(
                edges,
                new THREE.LineBasicMaterial({ 
                    color: 0x000000, 
                    linewidth: 2 
                })
            );
            plate.add(line);
            
            return plate;
        }
        
        // Animation divergente (dorsale)
        function showDivergent() {
            resetScene();
            
            explanation.innerHTML = `
                <h3>DORSALE OCÉANIQUE</h3>
                <div class="step"><strong>Étape 1 :</strong> Deux plaques s'éloignent l'une de l'autre.</div>
                <div class="step"><strong>Étape 2 :</strong> Le magma remonte du manteau.</div>
                <div class="step"><strong>Étape 3 :</strong> Formation de nouvelle croûte océanique.</div>
                <div class="result">
                    <strong>Exemple :</strong> Dorsale médio-atlantique
                </div>
            `;
            explanation.classList.remove('hidden');
            
            const plate1 = createPlate(6, 0.5, 8, 0, -4, 0);
            const plate2 = createPlate(6, 0.5, 8, 1, 4, 0);
            
            // Magma qui remonte
            const magmaGeometry = new THREE.BoxGeometry(2, 1, 8);
            const magmaMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xFF5722,
                emissive: 0xFF7043,
                emissiveIntensity: 0.8,
                transparent: true,
                opacity: 0.9,
                shininess: 100
            });
            const magma = new THREE.Mesh(magmaGeometry, magmaMaterial);
            magma.position.y = -0.5;
            magma.castShadow = true;
            scene.add(magma);
            
            currentAnimation = () => {
                plate1.position.x -= 0.01;
                plate2.position.x += 0.01;
                magma.scale.y = 1 + Math.sin(Date.now() * 0.005) * 0.5;
            };
        }
        
        // Animation de subduction
        function showSubduction() {
            resetScene();
            
            explanation.innerHTML = `
                <h3>SUBDUCTION OCÉANIQUE</h3>
                <div class="step"><strong>Étape 1 :</strong> Plaque océanique dense rencontre plaque continentale.</div>
                <div class="step"><strong>Étape 2 :</strong> La plaque océanique plonge sous la continentale.</div>
                <div class="step"><strong>Étape 3 :</strong> Frottement provoque séismes et volcanisme.</div>
                <div class="result">
                    <strong>Exemple :</strong> Ceinture de feu du Pacifique
                </div>
            `;
            explanation.classList.remove('hidden');
            
            const oceanicPlate = createPlate(8, 0.5, 8, 0, 0, -3);
            const continentalPlate = createPlate(8, 1, 8, 1, 0, 3);
            
            // Volcan
            const volcanoGeometry = new THREE.ConeGeometry(0.8, 3, 32);
            const volcanoMaterial = new THREE.MeshPhongMaterial({ 
                color: 0x5D4037,
                shininess: 10
            });
            const volcano = new THREE.Mesh(volcanoGeometry, volcanoMaterial);
            volcano.position.set(0, 1, 4);
            volcano.rotation.x = Math.PI;
            volcano.castShadow = true;
            scene.add(volcano);
            
            // Animation de lave
            const lavaGeometry = new THREE.SphereGeometry(0.4, 16, 16);
            const lavaMaterial = new THREE.MeshPhongMaterial({
                color: 0xFF5722,
                emissive: 0xFF7043,
                emissiveIntensity: 1.5,
                transparent: true,
                opacity: 0.9
            });
            const lava = new THREE.Mesh(lavaGeometry, lavaMaterial);
            lava.position.set(0, 1.5, 4);
            scene.add(lava);
            
            currentAnimation = () => {
                oceanicPlate.position.z += 0.01;
                oceanicPlate.rotation.x = -Math.PI/4 * (oceanicPlate.position.z/10);
                
                // Animation de la lave
                lava.scale.y = 1 + Math.sin(Date.now() * 0.01) * 0.3;
                
                // Éruption occasionnelle
                if (Math.random() < 0.005) {
                    triggerEruption(volcano.position);
                }
            };
        }
        
        // Animation de collision continentale
        function showCollision() {
            resetScene();
            
            explanation.innerHTML = `
                <h3>COLLISION CONTINENTALE</h3>
                <div class="step"><strong>Étape 1 :</strong> Deux plaques continentales entrent en collision.</div>
                <div class="step"><strong>Étape 2 :</strong> Aucune plaque ne peut plonger sous l'autre.</div>
                <div class="step"><strong>Étape 3 :</strong> Les bords des plaques se soulèvent.</div>
                <div class="result">
                    <strong>Exemple :</strong> Chaîne de l'Himalaya
                </div>
            `;
            explanation.classList.remove('hidden');
            
            const plate1 = createPlate(6, 1.5, 8, 0, -4, 0);
            const plate2 = createPlate(6, 1.5, 8, 1, 4, 0);
            
            currentAnimation = () => {
                if (plate1.position.x < 0) {
                    plate1.position.x += 0.01;
                    plate2.position.x -= 0.01;
                    
                    // Formation des montagnes
                    if (Math.abs(plate1.position.x - plate2.position.x) < 3) {
                        plate1.position.y += 0.005;
                        plate2.position.y += 0.005;
                        
                        // Déformation des plaques
                        deformPlate(plate1);
                        deformPlate(plate2);
                    }
                }
            };
        }
        
        // Animation de faille transformante
        function showTransform() {
            resetScene();
            
            explanation.innerHTML = `
                <h3>FAILLE TRANSFORMANTE</h3>
                <div class="step"><strong>Étape 1 :</strong> Deux plaques glissent horizontalement.</div>
                <div class="step"><strong>Étape 2 :</strong> Frottement bloque temporairement le mouvement.</div>
                <div class="step"><strong>Étape 3 :</strong> Relâchement brutal provoque un séisme.</div>
                <div class="result">
                    <strong>Exemple :</strong> Faille de San Andreas
                </div>
            `;
            explanation.classList.remove('hidden');
            
            const plate1 = createPlate(8, 0.5, 8, 0, 0, -2);
            const plate2 = createPlate(8, 0.5, 8, 1, 0, 2);
            
            // Faille
            const faultGeometry = new THREE.BoxGeometry(8, 0.1, 0.2);
            const faultMaterial = new THREE.MeshPhongMaterial({ 
                color: 0x000000,
                emissive: 0x333333,
                emissiveIntensity: 0.3
            });
            const fault = new THREE.Mesh(faultGeometry, faultMaterial);
            scene.add(fault);
            
            currentAnimation = () => {
                plate1.position.x -= 0.02;
                plate2.position.x += 0.02;
                
                // Séisme occasionnel
                if (Math.random() < 0.005) {
                    triggerEarthquake();
                }
            };
        }
        
        function triggerEruption(position) {
            // Créer une explosion de particules
            const particleCount = 100;
            const particles = new THREE.BufferGeometry();
            const positions = new Float32Array(particleCount * 3);
            const colors = new Float32Array(particleCount * 3);
            
            for (let i = 0; i < particleCount; i++) {
                positions[i * 3] = position.x;
                positions[i * 3 + 1] = position.y + 2;
                positions[i * 3 + 2] = position.z;
                
                // Couleurs aléatoires entre orange et rouge
                colors[i * 3] = 0.8 + Math.random() * 0.2; // R
                colors[i * 3 + 1] = 0.2 + Math.random() * 0.3; // G
                colors[i * 3 + 2] = 0.0; // B
            }
            
            particles.setAttribute('position', new THREE.BufferAttribute(positions, 3));
            particles.setAttribute('color', new THREE.BufferAttribute(colors, 3));
            
            const particleMaterial = new THREE.PointsMaterial({
                size: 0.5,
                vertexColors: true,
                transparent: true,
                opacity: 1.0,
                blending: THREE.AdditiveBlending
            });
            
            const particleSystem = new THREE.Points(particles, particleMaterial);
            particleSystem.name = 'eruptionParticles';
            scene.add(particleSystem);
            
            // Animation de l'éruption
            const duration = 1000; // ms
            const startTime = Date.now();
            
            const animateEruption = () => {
                const elapsed = Date.now() - startTime;
                const progress = elapsed / duration;
                
                if (progress >= 1) {
                    scene.remove(particleSystem);
                    return;
                }
                
                const positions = particleSystem.geometry.attributes.position.array;
                for (let i = 0; i < positions.length; i += 3) {
                    const angle = Math.random() * Math.PI * 2;
                    const radius = progress * 5;
                    positions[i] = position.x + Math.cos(angle) * radius;
                    positions[i + 1] = position.y + 2 + progress * 10;
                    positions[i + 2] = position.z + Math.sin(angle) * radius;
                }
                
                particleSystem.geometry.attributes.position.needsUpdate = true;
                particleMaterial.opacity = 1 - progress;
                
                requestAnimationFrame(animateEruption);
            };
            
            animateEruption();
        }
        
        function deformPlate(plate) {
            if (!plate.geometry.attributes.position) return;
            
            const positions = plate.geometry.attributes.position.array;
            for (let i = 0; i < positions.length; i += 3) {
                if (positions[i + 1] > 0) { // Ne déformer que le dessus
                    positions[i + 1] += (Math.random() - 0.5) * 0.02;
                }
            }
            
            plate.geometry.attributes.position.needsUpdate = true;
            plate.geometry.computeVertexNormals();
        }
        
        function triggerEarthquake() {
            const intensity = 0.2;
            const originalPosition = camera.position.clone();
            const originalRotation = camera.rotation.clone();
            
            // Animation GSAP pour des secousses plus fluides
            gsap.to(camera.position, {
                x: originalPosition.x + (Math.random() - 0.5) * intensity,
                y: originalPosition.y + (Math.random() - 0.5) * intensity,
                duration: 0.1,
                repeat: 10,
                yoyo: true,
                onComplete: () => {
                    camera.position.copy(originalPosition);
                    camera.rotation.copy(originalRotation);
                }
            });
            
            gsap.to(camera.rotation, {
                z: originalRotation.z + (Math.random() - 0.5) * intensity * 0.2,
                duration: 0.1,
                repeat: 10,
                yoyo: true
            });
            
            // Ondes sismiques visuelles
            createSeismicWaves();
        }
        
        function createSeismicWaves() {
            const waveGeometry = new THREE.RingGeometry(0.1, 0.2, 32);
            const waveMaterial = new THREE.MeshBasicMaterial({
                color: 0xFF0000,
                side: THREE.DoubleSide,
                transparent: true,
                opacity: 0.8
            });
            
            const wave = new THREE.Mesh(waveGeometry, waveMaterial);
            wave.rotation.x = Math.PI / 2;
            wave.position.y = -1.5;
            scene.add(wave);
            
            gsap.to(wave.scale, {
                x: 20,
                y: 20,
                duration: 2,
                ease: "power1.out",
                onUpdate: () => {
                    waveMaterial.opacity = 1 - wave.scale.x / 20;
                },
                onComplete: () => {
                    scene.remove(wave);
                }
            });
        }
        
        // Nettoyage de la scène
        function resetScene() {
            while(scene.children.length > 0){ 
                scene.remove(scene.children[0]); 
            }
            
            scene.add(ambientLight);
            scene.add(directionalLight);
            createEarthCrust();
            currentAnimation = null;
        }
        
        // Gestion de la fenêtre
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
        
        // Animation
        function animate() {
            requestAnimationFrame(animate);
            
            if (currentAnimation) {
                currentAnimation();
            }
            
            renderer.render(scene, camera);
        }
        
        // Initialisation
        createEarthCrust();
        animate();
    </script>
</body>
</html>
