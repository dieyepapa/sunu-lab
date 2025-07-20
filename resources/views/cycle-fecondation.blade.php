<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratoire Virtuel SVT 3ème - Fécondation Humaine</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            background-color: #f0f8ff;
        }
        
        #container {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        
        #info-panel {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            max-width: 300px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            z-index: 100;
        }
        
        #controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            gap: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            z-index: 100;
        }
        
        button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #2980b9;
        }
        
        button:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        
        h2 {
            color: #2c3e50;
            margin-top: 0;
        }
        
        #progress-container {
            width: 100%;
            height: 5px;
            background-color: #ddd;
            margin-top: 10px;
            border-radius: 5px;
        }
        
        #progress-bar {
            height: 100%;
            width: 0%;
            background-color: #3498db;
            border-radius: 5px;
            transition: width 0.3s;
        }
    </style>
</head>
<body>
    <div id="container"></div>
    
    <div id="info-panel">
        <h2>Fécondation Humaine</h2>
        <p id="step-description">Cliquez sur "Démarrer" pour commencer la simulation du processus de fécondation.</p>
        <div id="progress-container">
            <div id="progress-bar"></div>
        </div>
    </div>
    
    <div id="controls">
        <button id="start-btn">Démarrer</button>
        <button id="reset-btn">Réinitialiser</button>
        <button id="prev-btn">Étape précédente</button>
        <button id="next-btn">Étape suivante</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
    <script>
        // Initialisation de la scène Three.js
        const container = document.getElementById('container');
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf0f8ff);
        
        // Caméra
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 0, 50);
        
        // Rendu
        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);
        
        // Contrôles
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        
        // Lumière
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);
        
        // Variables pour les objets 3D
        let ovule, uterus, spermatozoids = [], zygote, embryo;
        let currentStep = 0;
        const totalSteps = 5;
        let animationInProgress = false;
        
        // Création des modèles 3D simplifiés
        function createModels() {
            // Utérus et trompes
            const uterusGeometry = new THREE.TorusGeometry(15, 3, 16, 100, Math.PI * 2);
            const uterusMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xffcccc,
                transparent: true,
                opacity: 0.6
            });
            uterus = new THREE.Mesh(uterusGeometry, uterusMaterial);
            uterus.rotation.x = Math.PI / 2;
            scene.add(uterus);
            
            // Ovule
            const ovuleGeometry = new THREE.SphereGeometry(2, 32, 32);
            const ovuleMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xff99cc,
                shininess: 30
            });
            ovule = new THREE.Mesh(ovuleGeometry, ovuleMaterial);
            ovule.position.set(10, 0, 0);
            scene.add(ovule);
            
            // Zone pellucide (enveloppe de l'ovule)
            const zonaGeometry = new THREE.SphereGeometry(2.2, 32, 32);
            const zonaMaterial = new THREE.MeshPhongMaterial({
                color: 0xffffff,
                transparent: true,
                opacity: 0.3,
                wireframe: true
            });
            const zona = new THREE.Mesh(zonaGeometry, zonaMaterial);
            ovule.add(zona);
            
            // Spermatozoïdes (seront créés lors de la simulation)
            
            // Zygote
            const zygoteGeometry = new THREE.SphereGeometry(2.5, 32, 32);
            const zygoteMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xff66b3,
                shininess: 50
            });
            zygote = new THREE.Mesh(zygoteGeometry, zygoteMaterial);
            zygote.position.set(10, 0, 0);
            zygote.visible = false;
            scene.add(zygote);
            
            // Embryon
            const embryoGeometry = new THREE.SphereGeometry(3, 32, 32);
            const embryoMaterial = new THREE.MeshPhongMaterial({ 
                color: 0xff3399,
                shininess: 20
            });
            embryo = new THREE.Mesh(embryoGeometry, embryoMaterial);
            embryo.position.set(0, -10, 0);
            embryo.visible = false;
            scene.add(embryo);
        }
        
        // Créer des spermatozoïdes
        function createSpermatozoids(count) {
            // Supprimer les anciens spermatozoïdes s'ils existent
            spermatozoids.forEach(sperm => scene.remove(sperm.mesh));
            spermatozoids = [];
            
            for (let i = 0; i < count; i++) {
                // Tête du spermatozoïde
                const headGeometry = new THREE.SphereGeometry(0.5, 16, 16);
                const headMaterial = new THREE.MeshPhongMaterial({ color: 0x333333 });
                const head = new THREE.Mesh(headGeometry, headMaterial);
                
                // Flagelle
                const tailGeometry = new THREE.CylinderGeometry(0.1, 0.2, 3, 8);
                const tailMaterial = new THREE.MeshPhongMaterial({ color: 0x666666 });
                const tail = new THREE.Mesh(tailGeometry, tailMaterial);
                tail.position.y = -1.5;
                tail.rotation.z = Math.PI / 2;
                
                // Groupe pour le spermatozoïde complet
                const spermGroup = new THREE.Group();
                spermGroup.add(head);
                spermGroup.add(tail);
                
                // Position aléatoire dans la trompe
                const angle = Math.random() * Math.PI * 2;
                const distance = 5 + Math.random() * 5;
                spermGroup.position.set(
                    Math.cos(angle) * distance,
                    Math.sin(angle) * distance,
                    (Math.random() - 0.5) * 10
                );
                
                // Orientation vers l'ovule
                spermGroup.lookAt(ovule.position);
                
                // Ajouter à la scène
                scene.add(spermGroup);
                
                // Stocker les références pour l'animation
                spermatozoids.push({
                    mesh: spermGroup,
                    speed: 0.05 + Math.random() * 0.05,
                    arrived: false,
                    winner: i === 0 // Le premier est le "gagnant"
                });
            }
        }
        
        // Animation des spermatozoïdes
        function animateSpermatozoids() {
            let arrivedCount = 0;
            
            spermatozoids.forEach(sperm => {
                if (!sperm.arrived) {
                    // Direction vers l'ovule
                    const direction = new THREE.Vector3().subVectors(ovule.position, sperm.mesh.position).normalize();
                    
                    // Distance à l'ovule
                    const distance = sperm.mesh.position.distanceTo(ovule.position);
                    
                    if (distance < 2.5) {
                        // Arrivé à l'ovule
                        sperm.arrived = true;
                        arrivedCount++;
                        
                        if (sperm.winner) {
                            // Le spermatozoïde gagnant
                            setTimeout(() => {
                                ovule.visible = false;
                                zygote.visible = true;
                                updateStepDescription(2);
                                currentStep = 2;
                                updateProgressBar();
                            }, 1000);
                        } else {
                            // Les autres disparaissent progressivement
                            sperm.mesh.children.forEach(part => {
                                part.material.transparent = true;
                                part.material.opacity = 0.5;
                            });
                        }
                    } else {
                        // Déplacement vers l'ovule
                        sperm.mesh.position.add(direction.multiplyScalar(sperm.speed));
                        
                        // Petit mouvement de nage aléatoire
                        sperm.mesh.rotation.z = Math.sin(Date.now() * 0.01) * 0.5;
                    }
                }
            });
            
            return arrivedCount === spermatozoids.length;
        }
        
        // Animation de la division cellulaire
        function animateCellDivision() {
            if (!zygote.userData.scale) zygote.userData.scale = 1;
            
            zygote.userData.scale += 0.005;
            zygote.scale.set(
                zygote.userData.scale,
                zygote.userData.scale,
                zygote.userData.scale
            );
            
            if (zygote.userData.scale >= 1.5) {
                zygote.visible = false;
                embryo.visible = true;
                embryo.position.set(0, -12, 0);
                updateStepDescription(3);
                currentStep = 3;
                updateProgressBar();
                return true;
            }
            return false;
        }
        
        // Animation de la nidation
        function animateImplantation() {
            if (embryo.position.y < -5) {
                embryo.position.y += 0.05;
                return false;
            } else {
                updateStepDescription(4);
                currentStep = 4;
                updateProgressBar();
                return true;
            }
        }
        
        // Mise à jour de la description de l'étape
        function updateStepDescription(step) {
            const descriptions = [
                "Prêt à commencer la simulation de la fécondation humaine.",
                "1. Migration des spermatozoïdes: Les spermatozoïdes remontent les voies génitales femelles vers l'ovule.",
                "2. Fécondation: Un spermatozoïde pénètre l'ovule, formant un zygote avec 46 chromosomes.",
                "3. Division cellulaire: Le zygote se divise par mitose pour former un embryon.",
                "4. Nidation: L'embryon s'implante dans la paroi utérine, début de la grossesse."
            ];
            
            document.getElementById('step-description').textContent = descriptions[step];
        }
        
        // Mise à jour de la barre de progression
        function updateProgressBar() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
        }
        
        // Gestion des boutons
        document.getElementById('start-btn').addEventListener('click', () => {
            if (currentStep === 0) {
                startSimulation();
            }
        });
        
        document.getElementById('reset-btn').addEventListener('click', resetSimulation);
        
        document.getElementById('prev-btn').addEventListener('click', prevStep);
        
        document.getElementById('next-btn').addEventListener('click', nextStep);
        
        function startSimulation() {
            currentStep = 1;
            updateStepDescription(currentStep);
            updateProgressBar();
            createSpermatozoids(15);
            animationInProgress = true;
            
            document.getElementById('start-btn').disabled = true;
            document.getElementById('prev-btn').disabled = true;
        }
        
        function resetSimulation() {
            currentStep = 0;
            animationInProgress = false;
            
            // Réinitialiser les modèles
            ovule.visible = true;
            zygote.visible = false;
            zygote.scale.set(1, 1, 1);
            embryo.visible = false;
            embryo.position.set(0, -12, 0);
            
            // Supprimer les spermatozoïdes
            spermatozoids.forEach(sperm => scene.remove(sperm.mesh));
            spermatozoids = [];
            
            // Réinitialiser l'interface
            updateStepDescription(currentStep);
            updateProgressBar();
            
            document.getElementById('start-btn').disabled = false;
            document.getElementById('prev-btn').disabled = false;
            document.getElementById('next-btn').disabled = false;
        }
        
        function prevStep() {
            if (currentStep > 1 && !animationInProgress) {
                currentStep--;
                updateStepDescription(currentStep);
                updateProgressBar();
                
                // Réinitialiser l'état selon l'étape
                if (currentStep === 1) {
                    ovule.visible = true;
                    zygote.visible = false;
                    embryo.visible = false;
                    createSpermatozoids(15);
                } else if (currentStep === 2) {
                    ovule.visible = false;
                    zygote.visible = true;
                    zygote.scale.set(1, 1, 1);
                    embryo.visible = false;
                } else if (currentStep === 3) {
                    zygote.visible = false;
                    embryo.visible = true;
                }
            }
        }
        
        function nextStep() {
            if (currentStep < totalSteps - 1 && !animationInProgress) {
                currentStep++;
                updateStepDescription(currentStep);
                updateProgressBar();
                
                // Mettre à jour l'état selon l'étape
                if (currentStep === 1) {
                    createSpermatozoids(15);
                } else if (currentStep === 2) {
                    ovule.visible = false;
                    zygote.visible = true;
                } else if (currentStep === 3) {
                    zygote.visible = false;
                    embryo.visible = true;
                    embryo.position.set(0, -12, 0);
                }
            }
        }
        
        // Animation principale
        function animate() {
            requestAnimationFrame(animate);
            
            controls.update();
            
            if (animationInProgress) {
                let animationComplete = false;
                
                switch(currentStep) {
                    case 1:
                        animationComplete = animateSpermatozoids();
                        break;
                    case 2:
                        animationComplete = animateCellDivision();
                        break;
                    case 3:
                        animationComplete = animateImplantation();
                        break;
                }
                
                if (animationComplete) {
                    animationInProgress = false;
                    if (currentStep < totalSteps - 1) {
                        document.getElementById('next-btn').disabled = false;
                    }
                }
            }
            
            renderer.render(scene, camera);
        }
        
        // Gestion du redimensionnement
        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        
        window.addEventListener('resize', onWindowResize);
        
        // Initialisation
        createModels();
        updateStepDescription(0);
        updateProgressBar();
        document.getElementById('prev-btn').disabled = true;
        animate();
    </script>
</body>
</html>
