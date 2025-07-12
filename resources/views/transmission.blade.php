<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmission Nerveuse 3D - Laboratoire Virtuel SVT</title>
    <style>
        body { 
            margin: 0;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        
        #info {
            position: absolute;
            top: 10px;
            width: 100%;
            text-align: center;
            color: white;
            background-color: rgba(0,0,0,0.5);
            padding: 10px;
            z-index: 100;
        }
        
        #controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            display: flex;
            gap: 10px;
        }
        
        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        #progress-container {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 10px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 100;
        }
        
        #progress-bar {
            height: 100%;
            width: 0%;
            background-color: #3498db;
            transition: width 0.3s;
        }
        
        #tooltip {
            position: absolute;
            background-color: rgba(0,0,0,0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            max-width: 200px;
            display: none;
            z-index: 100;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div id="info">Transmission de l'Influx Nerveux - Laboratoire Virtuel SVT 3D</div>
    <div id="progress-container"><div id="progress-bar"></div></div>
    <div id="controls">
        <button id="startBtn">Démarrer</button>
        <button id="pauseBtn">Pause</button>
        <button id="resetBtn">Réinitialiser</button>
        <button id="zoomBtn">Zoom Synapse</button>
    </div>
    <div id="tooltip"></div>
    
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
    <script>
        // Variables globales
        let scene, camera, renderer, controls;
        let animationInProgress = false;
        let isPaused = false;
        let animationIntervals = [];
        let highlightedObjects = [];
        
        // Initialisation de la scène Three.js
        function init() {
            // Créer la scène
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0xf0f0f0);
            
            // Créer la caméra
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.set(0, 5, 15);
            
            // Créer le rendu
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            document.body.appendChild(renderer.domElement);
            
            // Contrôles de la caméra
            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;
            
            // Lumière
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(1, 1, 1);
            scene.add(directionalLight);
            
            // Créer le modèle 3D
            createNervousSystem();
            
            // Gestion du redimensionnement
            window.addEventListener('resize', onWindowResize);
            
            // Gestion des événements
            setupEventListeners();
            
            // Animation
            animate();
        }
        
        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        
        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }
        
        function createNervousSystem() {
            // Récepteur (main)
            const handGeometry = new THREE.SphereGeometry(1, 32, 32);
            const handMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xf5d5b3,
                transparent: true,
                opacity: 0.8
            });
            const hand = new THREE.Mesh(handGeometry, handMaterial);
            hand.position.set(-5, 0, 0);
            hand.name = "Main (récepteur)";
            scene.add(hand);
            
            // Aiguille
            const needleGeometry = new THREE.CylinderGeometry(0.05, 0.05, 1, 8);
            const needleMaterial = new THREE.MeshPhongMaterial({ color: 0xcccccc });
            const needle = new THREE.Mesh(needleGeometry, needleMaterial);
            needle.rotation.z = Math.PI / 2;
            needle.position.set(-4, 0.5, 0);
            scene.add(needle);
            
            // Neurone sensitif
            createNeuron(-3, 0, 0, 0x3498db, "Neurone sensitif");
            
            // Moelle épinière
            const spineGeometry = new THREE.CylinderGeometry(0.8, 0.8, 5, 32);
            const spineMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xffffff,
                transparent: true,
                opacity: 0.7
            });
            const spine = new THREE.Mesh(spineGeometry, spineMaterial);
            spine.position.set(0, 0, 0);
            scene.add(spine);
            
            // Substance grise
            const grayMatterGeometry = new THREE.CylinderGeometry(0.5, 0.5, 5, 32);
            const grayMatterMaterial = new THREE.MeshPhongMaterial({ color: 0xbdc3c7 });
            const grayMatter = new THREE.Mesh(grayMatterGeometry, grayMatterMaterial);
            grayMatter.position.set(0, 0, 0);
            scene.add(grayMatter);
            
            // Interneurone
            createNeuron(0, 0, 0, 0x2ecc71, "Interneurone");
            
            // Neurone moteur
            createNeuron(3, 0, 0, 0xe74c3c, "Neurone moteur");
            
            // Muscle (effecteur)
            const muscleGeometry = new THREE.BoxGeometry(2, 1, 2);
            const muscleMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xf39c12,
                transparent: true,
                opacity: 0.8
            });
            const muscle = new THREE.Mesh(muscleGeometry, muscleMaterial);
            muscle.position.set(6, 0, 0);
            muscle.name = "Muscle (effecteur)";
            scene.add(muscle);
            
            // Synapse (cachée au départ)
            createSynapse(1.5, 0, 0);
        }
        
        function createNeuron(x, y, z, color, name) {
            const group = new THREE.Group();
            group.position.set(x, y, z);
            group.name = name;
            
            // Corps cellulaire
            const somaGeometry = new THREE.SphereGeometry(0.5, 32, 32);
            const somaMaterial = new THREE.MeshPhongMaterial({ color: color });
            const soma = new THREE.Mesh(somaGeometry, somaMaterial);
            soma.name = "Corps cellulaire";
            group.add(soma);
            
            // Dendrites
            for (let i = 0; i < 3; i++) {
                const dendriteGeometry = new THREE.ConeGeometry(0.3, 1, 8);
                const dendriteMaterial = new THREE.MeshPhongMaterial({ color: color });
                const dendrite = new THREE.Mesh(dendriteGeometry, dendriteMaterial);
                dendrite.rotation.z = Math.PI / 2;
                dendrite.position.set(-0.8, i * 0.4 - 0.4, 0);
                dendrite.name = "Dendrites";
                group.add(dendrite);
            }
            
            // Axone
            const axonGeometry = new THREE.CylinderGeometry(0.1, 0.1, 2, 8);
            const axonMaterial = new THREE.MeshPhongMaterial({ color: color });
            const axon = new THREE.Mesh(axonGeometry, axonMaterial);
            axon.position.set(1.2, 0, 0);
            axon.rotation.z = Math.PI / 2;
            axon.name = "Axone";
            group.add(axon);
            
            // Gaine de myéline
            for (let i = 0; i < 5; i++) {
                const myelinGeometry = new THREE.SphereGeometry(0.15, 16, 16);
                const myelinMaterial = new THREE.MeshPhongMaterial({ 
                    color: 0xffffff,
                    transparent: true,
                    opacity: 0.9
                });
                const myelin = new THREE.Mesh(myelinGeometry, myelinMaterial);
                myelin.position.set(0.5 + i * 0.4, 0, 0);
                myelin.name = "Gaine de myéline";
                group.add(myelin);
            }
            
            scene.add(group);
            return group;
        }
        
        function createSynapse(x, y, z) {
            const group = new THREE.Group();
            group.position.set(x, y, z);
            group.visible = false;
            group.name = "Synapse";
            
            // Terminaison pré-synaptique
            const preSynapticGeometry = new THREE.SphereGeometry(0.4, 32, 32);
            const preSynapticMaterial = new THREE.MeshPhongMaterial({ color: 0x3498db });
            const preSynaptic = new THREE.Mesh(preSynapticGeometry, preSynapticMaterial);
            preSynaptic.position.set(-0.5, 0, 0);
            preSynaptic.name = "Terminaison pré-synaptique";
            group.add(preSynaptic);
            
            // Vésicules synaptiques
            for (let i = 0; i < 3; i++) {
                const vesicleGeometry = new THREE.SphereGeometry(0.1, 16, 16);
                const vesicleMaterial = new THREE.MeshPhongMaterial({ color: 0x9b59b6 });
                const vesicle = new THREE.Mesh(vesicleGeometry, vesicleMaterial);
                vesicle.position.set(-0.3, i * 0.1 - 0.1, 0);
                vesicle.name = "Vésicules synaptiques";
                group.add(vesicle);
            }
            
            // Fente synaptique
            const cleftGeometry = new THREE.BoxGeometry(0.2, 0.8, 0.8);
            const cleftMaterial = new THREE.MeshPhongMaterial({ color: 0xf1c40f });
            const cleft = new THREE.Mesh(cleftGeometry, cleftMaterial);
            cleft.position.set(0, 0, 0);
            cleft.name = "Fente synaptique";
            group.add(cleft);
            
            // Terminaison post-synaptique
            const postSynapticGeometry = new THREE.SphereGeometry(0.4, 32, 32);
            const postSynapticMaterial = new THREE.MeshPhongMaterial({ color: 0x2ecc71 });
            const postSynaptic = new THREE.Mesh(postSynapticGeometry, postSynapticMaterial);
            postSynaptic.position.set(0.5, 0, 0);
            postSynaptic.name = "Terminaison post-synaptique";
            group.add(postSynaptic);
            
            // Récepteurs
            for (let i = 0; i < 3; i++) {
                const receptorGeometry = new THREE.CylinderGeometry(0.05, 0.05, 0.3, 8);
                const receptorMaterial = new THREE.MeshPhongMaterial({ color: 0x2ecc71 });
                const receptor = new THREE.Mesh(receptorGeometry, receptorMaterial);
                receptor.position.set(0.3, i * 0.2 - 0.2, 0);
                receptor.rotation.z = Math.PI / 4;
                receptor.name = "Récepteurs";
                group.add(receptor);
            }
            
            scene.add(group);
            return group;
        }
        
        function animateSignal() {
            if (animationInProgress && !isPaused) return;
            
            // Réinitialiser d'abord si nécessaire
            if (!isPaused) {
                resetAnimation();
            }
            
            animationInProgress = true;
            isPaused = false;
            
            // Chemin du signal sensitif (bleu)
            const sensoryPath = [
                { x: -4, y: 0.5, z: 0, name: "Stimulation des récepteurs" },
                { x: -4, y: 0, z: 0, name: "Dendrites du neurone sensitif" },
                { x: -3.5, y: 0, z: 0, name: "Corps cellulaire" },
                { x: -2.5, y: 0, z: 0, name: "Axone myélinisé" },
                { x: -1, y: 0, z: 0, name: "Terminaison synaptique" },
                { x: -0.5, y: 0, z: 0, name: "Synapse (libération neurotransmetteurs)" }
            ];
            
            // Chemin du signal moteur (rouge)
            const motorPath = [
                { x: 0.5, y: 0, z: 0, name: "Interneurone dans la moelle épinière" },
                { x: 1.5, y: 0, z: 0, name: "Corps cellulaire du neurone moteur" },
                { x: 2.5, y: 0, z: 0, name: "Axone myélinisé" },
                { x: 4.5, y: 0, z: 0, name: "Terminaison motrice" },
                { x: 6, y: 0, z: 0, name: "Contraction musculaire" }
            ];
            
            // Afficher le zoom sur la synapse au bon moment
            const showSynapse = () => {
                const synapse = scene.getObjectByName("Synapse");
                if (synapse) {
                    synapse.visible = true;
                    
                    // Animation des neurotransmetteurs
                    setTimeout(() => {
                        const vesicles = [];
                        synapse.traverse(child => {
                            if (child.name === "Vésicules synaptiques") {
                                vesicles.push(child);
                            }
                        });
                        
                        vesicles.forEach((vesicle, i) => {
                            setTimeout(() => {
                                vesicle.position.x += 0.8;
                            }, i * 300);
                        });
                    }, 500);
                }
            };
            
            // Cacher le zoom sur la synapse
            const hideSynapse = () => {
                const synapse = scene.getObjectByName("Synapse");
                if (synapse) {
                    synapse.visible = false;
                    
                    // Réinitialiser la position des vésicules
                    synapse.traverse(child => {
                        if (child.name === "Vésicules synaptiques") {
                            child.position.x = -0.3;
                        }
                    });
                }
            };
            
            // Créer et animer une sphère représentant l'influx nerveux
            const createSignal = (color, path, isMotor = false) => {
                const geometry = new THREE.SphereGeometry(0.2, 16, 16);
                const material = new THREE.MeshPhongMaterial({ 
                    color: color,
                    emissive: color,
                    emissiveIntensity: 0.5
                });
                const signal = new THREE.Mesh(geometry, material);
                scene.add(signal);
                
                let i = 0;
                signal.position.set(path[0].x, path[0].y, path[0].z);
                
                // Mettre à jour la barre de progression
                const updateProgress = () => {
                    const progress = (i / (path.length - 1)) * 100;
                    document.getElementById('progress-bar').style.width = `${progress}%`;
                };
                
                const interval = setInterval(() => {
                    if (isPaused) return;
                    
                    if (i < path.length - 1) {
                        i++;
                        signal.position.set(path[i].x, path[i].y, path[i].z);
                        
                        // Mettre à jour l'info
                        document.getElementById('info').textContent = path[i].name;
                        
                        // Gestion spéciale pour la synapse
                        if (path[i].name.includes("Synapse")) {
                            showSynapse();
                        } else if (isMotor && i === 0) {
                            hideSynapse();
                        }
                        
                        updateProgress();
                    } else {
                        clearInterval(interval);
                        setTimeout(() => {
                            scene.remove(signal);
                            
                            if (!isMotor) {
                                // Passer au chemin moteur
                                createSignal(0xe74c3c, motorPath, true);
                            } else {
                                // Animation terminée
                                animationInProgress = false;
                                document.getElementById('info').textContent = "Animation terminée!";
                            }
                        }, 1000);
                    }
                }, 1500); // Vitesse ralentie à 1.5s entre chaque point
                
                animationIntervals.push(interval);
                highlightedObjects.push(signal);
                
                return signal;
            };
            
            // Démarrer l'animation avec le chemin sensitif
            createSignal(0x3498db, sensoryPath);
        }
        
        function resetAnimation() {
            // Arrêter toutes les animations en cours
            clearAllIntervals();
            
            // Supprimer tous les objets d'animation
            highlightedObjects.forEach(obj => {
                if (obj.parent) {
                    scene.remove(obj);
                }
            });
            highlightedObjects = [];
            
            // Cacher la synapse
            const synapse = scene.getObjectByName("Synapse");
            if (synapse) {
                synapse.visible = false;
                
                // Réinitialiser la position des vésicules
                synapse.traverse(child => {
                    if (child.name === "Vésicules synaptiques") {
                        child.position.x = -0.3;
                    }
                });
            }
            
            // Réinitialiser la barre de progression
            document.getElementById('progress-bar').style.width = "0%";
            document.getElementById('info').textContent = "Transmission de l'Influx Nerveux - Laboratoire Virtuel SVT 3D";
            
            animationInProgress = false;
            isPaused = false;
        }
        
        function clearAllIntervals() {
            animationIntervals.forEach(interval => clearInterval(interval));
            animationIntervals = [];
        }
        
        function setupEventListeners() {
            // Gestion des boutons
            document.getElementById('startBtn').addEventListener('click', function() {
                if (!animationInProgress || isPaused) {
                    if (isPaused) {
                        // Reprendre l'animation
                        isPaused = false;
                        document.getElementById('info').textContent = "Animation reprise";
                    } else {
                        // Démarrer une nouvelle animation
                        animateSignal();
                    }
                }
            });
            
            document.getElementById('pauseBtn').addEventListener('click', function() {
                if (animationInProgress && !isPaused) {
                    isPaused = true;
                    document.getElementById('info').textContent = "Animation en pause";
                }
            });
            
            document.getElementById('resetBtn').addEventListener('click', resetAnimation);
            
            document.getElementById('zoomBtn').addEventListener('click', function() {
                const synapse = scene.getObjectByName("Synapse");
                if (synapse) {
                    synapse.visible = !synapse.visible;
                    
                    if (synapse.visible) {
                        // Centrer la caméra sur la synapse
                        camera.position.set(1.5, 2, 3);
                        controls.target.set(1.5, 0, 0);
                    }
                }
            });
            
            // Gestion des tooltips
            const tooltip = document.getElementById('tooltip');
            const raycaster = new THREE.Raycaster();
            const mouse = new THREE.Vector2();
            
            window.addEventListener('mousemove', (event) => {
                // Calculer la position de la souris en coordonnées normalisées (-1 à +1)
                mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
                mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
                
                // Mettre à jour le rayon
                raycaster.setFromCamera(mouse, camera);
                
                // Calculer les objets intersectés
                const intersects = raycaster.intersectObjects(scene.children, true);
                
                if (intersects.length > 0) {
                    let obj = intersects[0].object;
                    
                    // Remonter jusqu'à l'objet parent nommé si nécessaire
                    while (obj.parent !== null && (!obj.name || obj.name === "")) {
                        obj = obj.parent;
                    }
                    
                    if (obj.name && obj.name !== "") {
                        tooltip.style.display = 'block';
                        tooltip.textContent = obj.name;
                        tooltip.style.left = `${event.clientX + 10}px`;
                        tooltip.style.top = `${event.clientY + 10}px`;
                        return;
                    }
                }
                
                tooltip.style.display = 'none';
            });
        }
        
        // Démarrer l'application
        init();
    </script>
</body>
</html>