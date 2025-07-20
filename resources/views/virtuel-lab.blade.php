<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labo-Virtuel SVT 3ème</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --table-color: #95a5a6;
            --panel-bg: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            height: 100vh;
        }

        .lab-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .lab-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
        }

        .user-controls button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            margin-left: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-controls button:hover {
            background-color: #2980b9;
        }

        .main-content {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .tools-panel {
            width: 250px;
            background-color: var(--panel-bg);
            padding: 1rem;
            overflow-y: auto;
            border-right: 1px solid #ddd;
            box-shadow: var(--shadow);
        }

        .tools-category {
            margin-bottom: 1.5rem;
        }

        .tools-category h3 {
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            padding-bottom: 0.3rem;
            border-bottom: 1px solid #eee;
        }

        .tool-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border-radius: 4px;
            cursor: grab;
            transition: background-color 0.2s;
        }

        .tool-item:hover {
            background-color: #f0f0f0;
        }

        .tool-item img {
            width: 32px;
            height: 32px;
            margin-right: 0.5rem;
        }

        .lab-table-container {
            flex: 1;
            position: relative;
            background-color: #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        #lab-table {
            flex: 1;
            background-color: var(--table-color);
            margin: 1rem;
            border-radius: 8px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .table-controls {
            display: flex;
            justify-content: center;
            padding: 0.5rem;
            background-color: var(--panel-bg);
            border-top: 1px solid #ddd;
        }

        .table-controls button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .info-panel {
            width: 300px;
            background-color: var(--panel-bg);
            padding: 1rem;
            overflow-y: auto;
            border-left: 1px solid #ddd;
            box-shadow: var(--shadow);
        }

        .info-content {
            margin-top: 1rem;
        }

        .simulation-controls {
            margin-top: 1.5rem;
        }

        .simulation-controls button {
            display: block;
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #start-sim-btn {
            background-color: #2ecc71;
            color: white;
        }

        #pause-sim-btn {
            background-color: #f39c12;
            color: white;
        }

        #stop-sim-btn {
            background-color: #e74c3c;
            color: white;
        }

        .simulation-params {
            margin-top: 1.5rem;
        }

        .simulation-params label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .simulation-params input {
            width: 100%;
        }

        .lab-footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 0.5rem;
            font-size: 0.8rem;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 2rem;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 1200px) {
            .tools-panel, .info-panel {
                width: 200px;
            }
        }

        @media (max-width: 900px) {
            .tools-panel, .info-panel {
                display: none;
            }
            
            .tools-panel.active, .info-panel.active {
                display: block;
                position: absolute;
                z-index: 10;
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="lab-container">
        <header class="lab-header">
            <h1>Labo-Virtuel SVT 3ème</h1>
            <div class="user-controls">
                <button id="help-btn">Aide</button>
                <button id="reset-btn">Réinitialiser</button>
            </div>
        </header>

        <div class="main-content">
            <aside class="tools-panel">
                <h2>Expériences à Simuler</h2>
                
                <div class="tools-category">
                    <h3>Système Circulatoire</h3>
                    <div class="tool-item" data-model="heart-circulation">
                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583344.png" alt="Cœur">
                        <span>Circulation sanguine</span>
                    </div>
                </div>

                <div class="tools-category">
                    <h3>Digestion</h3>
                    <div class="tool-item" data-model="enzyme-digestion">
                        <img src="https://cdn-icons-png.flaticon.com/512/3038/3038032.png" alt="Enzymes">
                        <span>Digestion enzymatique</span>
                    </div>
                </div>

                <div class="tools-category">
                    <h3>Reproduction</h3>
                    <div class="tool-item" data-model="fertilization">
                        <img src="https://cdn-icons-png.flaticon.com/512/411/411712.png" alt="Fécondation">
                        <span>Cycle de fécondation</span>
                    </div>
                </div>

                <div class="tools-category">
                    <h3>Respiration</h3>
                    <div class="tool-item" data-model="cellular-respiration">
                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583433.png" alt="Respiration">
                        <span>Respiration cellulaire</span>
                    </div>
                </div>

                <div class="tools-category">
                    <h3>Division Cellulaire</h3>
                    <div class="tool-item" data-model="mitosis">
                        <img src="https://cdn-icons-png.flaticon.com/512/3038/3038032.png" alt="Mitose">
                        <span>Mitose cellulaire</span>
                    </div>
                </div>

                <div class="tools-category">
                    <h3>Système Nerveux</h3>
                    <div class="tool-item" data-model="nerve-transmission">
                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583418.png" alt="Neurone">
                        <span>Transmission nerveuse</span>
                    </div>
                </div>
            </aside>

            <div class="lab-table-container">
                <div id="lab-table"></div>
                <div class="table-controls">
                    <button id="rotate-btn">Rotation</button>
                    <button id="zoom-in-btn">Zoom +</button>
                    <button id="zoom-out-btn">Zoom -</button>
                </div>
            </div>

            <aside class="info-panel">
                <h2>Informations</h2>
                <div class="info-content">
                    <p id="selected-object-info">Sélectionnez une expérience pour voir ses détails.</p>
                    <div class="simulation-controls">
                        <h3>Contrôles de Simulation</h3>
                        <button id="start-sim-btn">Démarrer Simulation</button>
                        <button id="pause-sim-btn" disabled>Pause</button>
                        <button id="stop-sim-btn" disabled>Arrêter</button>
                    </div>
                    <div class="simulation-params">
                        <h3>Paramètres</h3>
                        <label for="sim-speed">Vitesse:</label>
                        <input type="range" id="sim-speed" min="1" max="10" value="5">
                    </div>
                </div>
            </aside>
        </div>

        <div class="lab-footer">
            <p>Laboratoire Virtuel SVT - Collège 3ème © {{ date('Y') }}</p>
        </div>
    </div>

    <div id="help-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Aide du Laboratoire Virtuel</h2>
            <p>1. Sélectionnez une expérience depuis le panneau de gauche pour la charger sur la table de travail.</p>
            <p>2. Utilisez les boutons de rotation et zoom pour examiner les modèles.</p>
            <p>3. Consultez les informations détaillées dans le panneau de droite.</p>
            <p>4. Utilisez les contrôles de simulation pour démarrer les expériences virtuelles.</p>
            <p>5. Réglez la vitesse avec le curseur pour adapter le rythme de la simulation.</p>
        </div>
    </div>

    <!-- Chargement des scripts Three.js -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/DRACOLoader.js"></script>

    <script>
        // Initialisation de la scène Three.js
        let scene, camera, renderer, controls;
        let objects = [];
        let selectedObject = null;
        let mixer = null;
        let clock = new THREE.Clock();

        // Modèles disponibles avec leurs URLs
        const models = {
            'heart-circulation': { 
                name: 'Circulation Sanguine', 
                description: 'Simulation du parcours du sang dans le cœur et les vaisseaux sanguins. Observez le trajet du sang oxygéné (rouge) et non oxygéné (bleu) à travers les différentes cavités cardiaques.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/Heart/glTF/Heart.gltf',
                scale: 0.5
            },
            'enzyme-digestion': { 
                name: 'Digestion Enzymatique', 
                description: 'Simulation de l\'action des enzymes digestives sur les aliments. Observez comment les amylases, protéases et lipases décomposent les macromolécules en nutriments assimilables.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/DNA/glTF/DNA.gltf',
                scale: 0.5
            },
            'fertilization': { 
                name: 'Cycle de Fécondation', 
                description: 'Simulation du processus de fécondation et des premières divisions cellulaires. Suivez le parcours des spermatozoïdes, la pénétration de l\'ovocyte et la formation de la zygote.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/Cell/glTF/Cell.gltf',
                scale: 0.8
            },
            'cellular-respiration': { 
                name: 'Respiration Cellulaire', 
                description: 'Simulation des échanges gazeux et de la production d\'ATP dans la mitochondrie. Visualisez le cycle de Krebs et la chaîne respiratoire avec les transferts d\'électrons.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/Lungs/glTF/Lungs.gltf',
                scale: 0.3
            },
            'mitosis': { 
                name: 'Mitose Cellulaire', 
                description: 'Simulation des différentes phases de la mitose: prophase, métaphase, anaphase et télophase. Observez la répartition des chromosomes et la division du cytoplasme.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/Cell/glTF/Cell.gltf',
                scale: 0.8
            },
            'nerve-transmission': { 
                name: 'Transmission Nerveuse', 
                description: 'Simulation de la propagation du potentiel d\'action le long d\'un neurone. Visualisez les échanges ioniques et la libération des neurotransmetteurs au niveau de la synapse.',
                url: 'https://raw.githubusercontent.com/KhronosGroup/glTF-Sample-Models/master/2.0/BrainStem/glTF/BrainStem.gltf',
                scale: 0.8
            }
        };

        function init() {
            // Initialiser la scène Three.js
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0xf0f0f0);
            
            // Configurer la caméra
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 5, 10);
            
            // Configurer le rendu
            const tableContainer = document.getElementById('lab-table');
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(tableContainer.offsetWidth, tableContainer.offsetHeight);
            renderer.shadowMap.enabled = true;
            tableContainer.appendChild(renderer.domElement);
            
            // Ajouter des contrôles orbitaux
            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.25;
            
            // Ajouter de l'éclairage
            const ambientLight = new THREE.AmbientLight(0x404040);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(1, 1, 1);
            directionalLight.castShadow = true;
            scene.add(directionalLight);
            
            // Créer la table de laboratoire
            createLabTable();
            
            // Gestion des événements
            setupEventListeners();
            
            // Commencer l'animation
            animate();
        }

        function createLabTable() {
            // Créer la surface de la table
            const tableGeometry = new THREE.BoxGeometry(10, 0.2, 6);
            const tableMaterial = new THREE.MeshStandardMaterial({ 
                color: 0x8B4513,
                roughness: 0.8,
                metalness: 0.2
            });
            const table = new THREE.Mesh(tableGeometry, tableMaterial);
            table.position.y = -0.1;
            table.receiveShadow = true;
            scene.add(table);
            
            // Ajouter un bord à la table
            const tableBorderGeometry = new THREE.BoxGeometry(10.2, 0.5, 6.2);
            const tableBorderMaterial = new THREE.MeshStandardMaterial({ color: 0x654321 });
            const tableBorder = new THREE.Mesh(tableBorderGeometry, tableBorderMaterial);
            tableBorder.position.y = -0.35;
            scene.add(tableBorder);
            
            // Ajouter des pieds à la table
            const legGeometry = new THREE.CylinderGeometry(0.2, 0.2, 0.8, 16);
            const legMaterial = new THREE.MeshStandardMaterial({ color: 0x654321 });
            
            for (let i = 0; i < 4; i++) {
                const leg = new THREE.Mesh(legGeometry, legMaterial);
                leg.position.x = (i % 2 === 0 ? 1 : -1) * 4.8;
                leg.position.z = (i < 2 ? 1 : -1) * 2.8;
                leg.position.y = -0.8;
                leg.castShadow = true;
                scene.add(leg);
            }
        }

        function setupEventListeners() {
            // Gestion des outils glissables
            const toolItems = document.querySelectorAll('.tool-item');
            
            toolItems.forEach(item => {
                item.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('model', this.getAttribute('data-model'));
                });
            });
            
            // Zone de dépôt
            const labTable = document.getElementById('lab-table');
            
            labTable.addEventListener('dragover', function(e) {
                e.preventDefault();
            });
            
            labTable.addEventListener('drop', function(e) {
                e.preventDefault();
                const modelType = e.dataTransfer.getData('model');
                loadGLTFModel(modelType);
            });
            
            // Boutons de contrôle
            document.getElementById('rotate-btn').addEventListener('click', toggleRotation);
            document.getElementById('zoom-in-btn').addEventListener('click', zoomIn);
            document.getElementById('zoom-out-btn').addEventListener('click', zoomOut);
            document.getElementById('reset-btn').addEventListener('click', resetScene);
            document.getElementById('help-btn').addEventListener('click', showHelp);
            document.querySelector('.close-btn').addEventListener('click', hideHelp);
            
            // Simulation controls
            document.getElementById('start-sim-btn').addEventListener('click', startSimulation);
            document.getElementById('pause-sim-btn').addEventListener('click', pauseSimulation);
            document.getElementById('stop-sim-btn').addEventListener('click', stopSimulation);
            
            // Redimensionnement
            window.addEventListener('resize', onWindowResize);
        }

        function loadGLTFModel(modelType) {
            const loader = new THREE.GLTFLoader();
            const dracoLoader = new THREE.DRACOLoader();
            dracoLoader.setDecoderPath('https://www.gstatic.com/draco/v1/decoders/');
            loader.setDRACOLoader(dracoLoader);

            const modelInfo = models[modelType];
            
            loader.load(
                modelInfo.url,
                function(gltf) {
                    const model = gltf.scene;
                    
                    // Position aléatoire sur la table
                    model.position.x = (Math.random() - 0.5) * 6;
                    model.position.z = (Math.random() - 0.5) * 4;
                    model.position.y = 0.5;
                    
                    // Ajuster l'échelle
                    model.scale.set(modelInfo.scale, modelInfo.scale, modelInfo.scale);
                    
                    // Activer les ombres
                    model.traverse(function(node) {
                        if (node.isMesh) {
                            node.castShadow = true;
                            node.receiveShadow = true;
                        }
                    });
                    
                    // Stocker les informations du modèle
                    model.userData = {
                        type: modelType,
                        name: modelInfo.name,
                        description: modelInfo.description
                    };
                    
                    // Permettre la sélection
                    model.userData.selectable = true;
                    
                    // Gérer les animations si elles existent
                    if (gltf.animations && gltf.animations.length) {
                        mixer = new THREE.AnimationMixer(model);
                        const action = mixer.clipAction(gltf.animations[0]);
                        action.play();
                    }
                    
                    scene.add(model);
                    objects.push(model);
                    
                    // Mettre à jour les informations
                    updateObjectInfo(model.userData);
                },
                undefined,
                function(error) {
                    console.error('Erreur de chargement du modèle:', error);
                    // Fallback: créer un modèle basique
                    addBasicModel(modelType);
                }
            );
        }

        function addBasicModel(modelType) {
            // Fallback si le modèle GLTF ne charge pas
            let geometry, material, mesh;
            
            switch(modelType) {
                case 'heart-circulation':
                    geometry = new THREE.SphereGeometry(1, 32, 32);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0xff0000, 
                        roughness: 0.3,
                        metalness: 0.1
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                case 'enzyme-digestion':
                    geometry = new THREE.ConeGeometry(0.8, 1.5, 4);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0x00ff00,
                        transparent: true,
                        opacity: 0.8
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                case 'fertilization':
                    geometry = new THREE.SphereGeometry(0.8, 32, 32);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0xffff00,
                        transparent: true,
                        opacity: 0.7
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                case 'cellular-respiration':
                    geometry = new THREE.TorusGeometry(0.6, 0.2, 16, 32);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0x00ffff,
                        metalness: 0.3
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                case 'mitosis':
                    geometry = new THREE.IcosahedronGeometry(0.8, 1);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0xff00ff,
                        wireframe: true
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                case 'nerve-transmission':
                    geometry = new THREE.CylinderGeometry(0.1, 0.1, 2, 8);
                    material = new THREE.MeshStandardMaterial({ 
                        color: 0xffffff,
                        emissive: 0x555555
                    });
                    mesh = new THREE.Mesh(geometry, material);
                    break;
                    
                default:
                    geometry = new THREE.BoxGeometry(1, 1, 1);
                    material = new THREE.MeshStandardMaterial({ color: 0xffffff });
                    mesh = new THREE.Mesh(geometry, material);
            }
            
            // Position aléatoire sur la table
            mesh.position.x = (Math.random() - 0.5) * 6;
            mesh.position.z = (Math.random() - 0.5) * 4;
            mesh.position.y = 0.5;
            
            mesh.castShadow = true;
            mesh.receiveShadow = true;
            
            // Stocker les informations du modèle
            mesh.userData = {
                type: modelType,
                name: models[modelType].name,
                description: models[modelType].description
            };
            
            scene.add(mesh);
            objects.push(mesh);
            
            // Mettre à jour les informations
            updateObjectInfo(mesh.userData);
        }

        function updateObjectInfo(data) {
            const infoPanel = document.getElementById('selected-object-info');
            infoPanel.innerHTML = `
                <h3>${data.name}</h3>
                <p>${data.description}</p>
            `;
        }

        function toggleRotation() {
            controls.autoRotate = !controls.autoRotate;
        }

        function zoomIn() {
            camera.fov -= 5;
            camera.updateProjectionMatrix();
        }

        function zoomOut() {
            camera.fov += 5;
            camera.updateProjectionMatrix();
        }

        function resetScene() {
            // Réinitialiser la caméra
            camera.position.set(0, 5, 10);
            controls.reset();
            
            // Supprimer tous les objets
            objects.forEach(obj => {
                scene.remove(obj);
            });
            objects = [];
            
            // Réinitialiser les informations
            document.getElementById('selected-object-info').textContent = 'Sélectionnez une expérience pour voir ses détails.';
        }

        function showHelp() {
            document.getElementById('help-modal').style.display = 'block';
        }

        function hideHelp() {
            document.getElementById('help-modal').style.display = 'none';
        }

        function startSimulation() {
            document.getElementById('start-sim-btn').disabled = true;
            document.getElementById('pause-sim-btn').disabled = false;
            document.getElementById('stop-sim-btn').disabled = false;
            
            // Ici vous pourriez démarrer des animations spécifiques
            if (mixer) {
                mixer.timeScale = 1.0;
            }
            
            // Animation spécifique selon le modèle sélectionné
            if (selectedObject) {
                switch(selectedObject.userData.type) {
                    case 'heart-circulation':
                        // Animation pour la circulation sanguine
                        break;
                    case 'enzyme-digestion':
                        // Animation pour la digestion enzymatique
                        break;
                    // Ajouter les autres cas ici
                }
            }
        }

        function pauseSimulation() {
            document.getElementById('start-sim-btn').disabled = false;
            document.getElementById('pause-sim-btn').disabled = true;
            
            // Mettre en pause les animations
            if (mixer) {
                mixer.timeScale = 0;
            }
        }

        function stopSimulation() {
            document.getElementById('start-sim-btn').disabled = false;
            document.getElementById('pause-sim-btn').disabled = true;
            document.getElementById('stop-sim-btn').disabled = true;
            
            // Réinitialiser les animations
            if (mixer) {
                mixer.stopAllAction();
            }
        }

        function onWindowResize() {
            const tableContainer = document.getElementById('lab-table');
            camera.aspect = tableContainer.offsetWidth / tableContainer.offsetHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(tableContainer.offsetWidth, tableContainer.offsetHeight);
        }

        function animate() {
            requestAnimationFrame(animate);
            
            // Mettre à jour les animations
            const delta = clock.getDelta();
            if (mixer) mixer.update(delta);
            
            controls.update();
            renderer.render(scene, camera);
        }

        // Démarrer l'application
        init();
    </script>
</body>
</html>
