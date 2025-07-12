<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratoire Virtuel SVT - Digestion Enzymatique</title>
    <style>
        :root {
            --primary: #c62828;
            --primary-light: #ff5f52;
            --primary-dark: #8e0000;
            --secondary: #f5f5f5;
            --text: #333;
            --light: #fff;
            --amidon: #FFF9C4;
            --amylase: #D4E6F1;
            --digere: #C8E6C9;
            --eau: #E3F2FD;
            --eau-amidon: #BBDEFB;
            --amidon-amylase: #C8E6C9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--secondary);
            color: var(--text);
            line-height: 1.6;
        }

        header {
            background-color: var(--primary);
            color: var(--light);
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        h1 {
            margin-bottom: 0.5rem;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* Styles pour la section des tubes */
        .tube-experiment {
            background-color: var(--light);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-top: 5px solid var(--primary);
        }

        .lab-table {
            display: flex;
            justify-content: space-around;
            margin: 2rem 0;
            flex-wrap: wrap;
            min-height: 250px;
            position: relative;
        }

        .tube-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 1rem;
            position: relative;
            transition: transform 0.5s;
            z-index: 1;
        }

        .tube {
            width: 80px;
            height: 180px;
            position: relative;
            margin-bottom: 1rem;
        }

        .tube-body {
            width: 60px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid #333;
            border-top: none;
            border-radius: 0 0 10px 10px;
            position: absolute;
            bottom: 0;
            left: 10px;
            overflow: hidden;
        }

        .tube-neck {
            width: 30px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid #333;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            position: absolute;
            top: 0;
            left: 25px;
        }

        .liquid {
            position: absolute;
            bottom: 0;
            width: 100%;
            transition: height 0.5s, background-color 1s;
        }

        .tube-label {
            font-weight: bold;
            text-align: center;
            margin-top: 0.5rem;
        }

        .tube-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .tube-result {
            margin-top: 1rem;
            padding: 1rem;
            background-color: var(--light);
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
            font-size: 1.1rem;
            display: none;
        }

        /* Animation de versement */
        .pouring {
            position: absolute;
            width: 40px;
            height: 0;
            background-color: transparent;
            border-radius: 0 0 20px 20px;
            transform-origin: top center;
            transform: rotate(0deg);
            transition: all 0.5s;
            z-index: 10;
            overflow: hidden;
        }

        .pouring-liquid {
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 0;
        }

        /* Styles existants */
        .simulation-area {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .animation-container {
            flex: 1;
            min-width: 300px;
            background-color: var(--light);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            border-top: 5px solid var(--primary);
        }

        .controls {
            flex: 1;
            min-width: 300px;
            background-color: var(--light);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .enzyme-selector {
            margin-bottom: 1.5rem;
        }

        .enzyme-option {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            cursor: pointer;
            padding: 0.8rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .enzyme-option:hover {
            background-color: rgba(198, 40, 40, 0.1);
        }

        .enzyme-option.active {
            background-color: rgba(198, 40, 40, 0.2);
            border-left: 4px solid var(--primary);
        }

        .enzyme-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }

        .slider-container {
            margin: 1.5rem 0;
        }

        .slider-container label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .slider {
            width: 100%;
            height: 8px;
            -webkit-appearance: none;
            appearance: none;
            background: #ddd;
            outline: none;
            border-radius: 4px;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--primary);
            cursor: pointer;
            border-radius: 50%;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(198, 40, 40, 0.1);
        }

        .food-molecule {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transition: transform 0.5s;
        }

        .enzyme {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .product {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #2196F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .digestion-tube {
            width: 100%;
            height: 200px;
            background-color: #FFE0B2;
            border-radius: 10px;
            position: relative;
            margin: 2rem 0;
            overflow: hidden;
        }

        .explanation {
            background-color: var(--light);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .explanation h3 {
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .simulation-area {
                flex-direction: column;
            }
            
            .lab-table {
                flex-direction: column;
                align-items: center;
            }
            
            .tube-container {
                margin: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Laboratoire Virtuel SVT - 3ème</h1>
        <p>Simulation de la digestion enzymatique</p>
    </header>

    <div class="container">
        <!-- Section pour l'expérience des tubes -->
        <div class="tube-experiment">
            <h2>Expérience : Digestion de l'amidon par l'amylase</h2>
            <div class="lab-table" id="labTable">
                <!-- Tube d'eau -->
                <div class="tube-container" id="containerEau">
                    <div class="tube">
                        <div class="tube-neck"></div>
                        <div class="tube-body">
                            <div class="liquid" id="liquidEau" style="height: 100%; background-color: var(--eau);"></div>
                        </div>
                    </div>
                    <div class="tube-label">Eau distillée</div>
                </div>
                
                <!-- Tube d'amidon -->
                <div class="tube-container" id="containerAmidon">
                    <div class="tube">
                        <div class="tube-neck"></div>
                        <div class="tube-body">
                            <div class="liquid" id="liquidAmidon" style="height: 100%; background-color: var(--amidon);"></div>
                        </div>
                    </div>
                    <div class="tube-label">Amidon</div>
                </div>
                
                <!-- Tube d'amylase -->
                <div class="tube-container" id="containerAmylase">
                    <div class="tube">
                        <div class="tube-neck"></div>
                        <div class="tube-body">
                            <div class="liquid" id="liquidAmylase" style="height: 100%; background-color: var(--amylase);"></div>
                        </div>
                    </div>
                    <div class="tube-label">Amylase</div>
                </div>
                
                <!-- Tube vide pour mélange -->
                <div class="tube-container" id="containerMelange">
                    <div class="tube">
                        <div class="tube-neck"></div>
                        <div class="tube-body">
                            <div class="liquid" id="liquidMelange" style="height: 0%;"></div>
                        </div>
                    </div>
                    <div class="tube-label">Mélange</div>
                </div>
            </div>
            
            <div class="tube-controls">
                <button class="btn" id="btnEauAmidon">Verser eau + amidon</button>
                <button class="btn" id="btnAmidonAmylase">Verser amidon + amylase</button>
                <button class="btn" id="btnResetTubes">Réinitialiser</button>
            </div>
            
            <div class="tube-result" id="tubeResult"></div>
        </div>

        <!-- Section de simulation moléculaire -->
        <div class="simulation-area">
            <div class="animation-container">
                <h2>Tube digestif</h2>
                <div class="digestion-tube" id="digestionTube">
                    <!-- Les éléments seront ajoutés dynamiquement par JavaScript -->
                </div>
                <div class="animation-controls">
                    <button class="btn" id="startBtn">Démarrer la simulation</button>
                    <button class="btn btn-outline" id="resetBtn">Réinitialiser</button>
                </div>
            </div>

            <div class="controls">
                <h2>Paramètres de l'expérience</h2>
                
                <div class="enzyme-selector">
                    <h3>Sélectionnez une enzyme :</h3>
                    <div class="enzyme-option active" data-enzyme="amylase">
                        <div class="enzyme-icon">A</div>
                        <div>
                            <h4>Amylase</h4>
                            <p>Dégrade l'amidon en maltose</p>
                        </div>
                    </div>
                    <div class="enzyme-option" data-enzyme="pepsine">
                        <div class="enzyme-icon">P</div>
                        <div>
                            <h4>Pepsine</h4>
                            <p>Dégrade les protéines en peptides</p>
                        </div>
                    </div>
                    <div class="enzyme-option" data-enzyme="lipase">
                        <div class="enzyme-icon">L</div>
                        <div>
                            <h4>Lipase</h4>
                            <p>Dégrade les lipides en acides gras</p>
                        </div>
                    </div>
                </div>

                <div class="slider-container">
                    <label for="phSlider">pH du milieu : <span id="phValue">7</span></label>
                    <input type="range" min="1" max="14" value="7" class="slider" id="phSlider">
                </div>

                <div class="slider-container">
                    <label for="tempSlider">Température (°C) : <span id="tempValue">37</span></label>
                    <input type="range" min="0" max="60" value="37" class="slider" id="tempSlider">
                </div>

                <div class="slider-container">
                    <label for="enzymeSlider">Concentration enzymatique : <span id="enzymeValue">50</span>%</label>
                    <input type="range" min="0" max="100" value="50" class="slider" id="enzymeSlider">
                </div>
            </div>
        </div>

        <div class="explanation">
            <h3>Explications scientifiques</h3>
            <div id="amylaseExplanation">
                <p><strong>Amylase salivaire et pancréatique :</strong> Ces enzymes hydrolysent les liaisons α(1-4) glycosidiques de l'amidon pour former du maltose (un disaccharide). L'action commence dans la bouche et se poursuit dans l'intestin grêle.</p>
                <p>Conditions optimales : pH ~7 (neutre), température ~37°C (corporelle).</p>
            </div>
            <div id="pepsineExplanation" class="hidden">
                <p><strong>Pepsine :</strong> Enzyme gastrique qui hydrolyse les protéines en peptides plus courts. Elle est sécrétée sous forme inactive (pepsinogène) activée par l'acide chlorhydrique de l'estomac.</p>
                <p>Conditions optimales : pH ~2 (très acide), température ~37°C.</p>
            </div>
            <div id="lipaseExplanation" class="hidden">
                <p><strong>Lipase pancréatique :</strong> Hydrolyse les triglycérides (lipides) en acides gras et monoglycérides. Nécessite la présence de sels biliaires pour émulsionner les lipides.</p>
                <p>Conditions optimales : pH ~8 (légèrement basique), température ~37°C.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /******************************************************
             * Partie 1: Simulation des tubes à essai
             ******************************************************/
            // Éléments DOM
            const labTable = document.getElementById('labTable');
            const containerEau = document.getElementById('containerEau');
            const containerAmidon = document.getElementById('containerAmidon');
            const containerAmylase = document.getElementById('containerAmylase');
            const containerMelange = document.getElementById('containerMelange');
            const liquidEau = document.getElementById('liquidEau');
            const liquidAmidon = document.getElementById('liquidAmidon');
            const liquidAmylase = document.getElementById('liquidAmylase');
            const liquidMelange = document.getElementById('liquidMelange');
            const btnEauAmidon = document.getElementById('btnEauAmidon');
            const btnAmidonAmylase = document.getElementById('btnAmidonAmylase');
            const btnResetTubes = document.getElementById('btnResetTubes');
            const tubeResult = document.getElementById('tubeResult');
            
            // Variables de simulation
            let isTubeSimulating = false;
            
            // Animation de versement d'un tube à l'autre
            function pourTube(fromContainer, toContainer, liquidColor, callback) {
                return new Promise((resolve) => {
                    const fromRect = fromContainer.getBoundingClientRect();
                    const labRect = labTable.getBoundingClientRect();
                    
                    // Calculer la position centrale du tube de mélange
                    const toRect = toContainer.getBoundingClientRect();
                    const centerX = toRect.left + toRect.width/2 - labRect.left;
                    const centerY = toRect.top + toRect.height/2 - labRect.top;
                    
                    // Calculer la position de départ
                    const startX = fromRect.left + fromRect.width/2 - labRect.left;
                    const startY = fromRect.top + fromRect.height/2 - labRect.top;
                    
                    // Créer l'animation de versement
                    const pouring = document.createElement('div');
                    pouring.className = 'pouring';
                    pouring.style.left = `${startX - 20}px`;
                    pouring.style.top = `${startY}px`;
                    labTable.appendChild(pouring);
                    
                    // Créer le liquide qui coule
                    const pouringLiquid = document.createElement('div');
                    pouringLiquid.className = 'pouring-liquid';
                    pouringLiquid.style.backgroundColor = liquidColor;
                    pouring.appendChild(pouringLiquid);
                    
                    // Déplacer le tube vers le centre
                    fromContainer.style.transform = `translate(${centerX - startX}px, ${centerY - startY}px)`;
                    
                    // Animation de versement
                    setTimeout(() => {
                        // Incliner le tube et faire couler le liquide
                        pouring.style.transform = 'rotate(45deg)';
                        pouring.style.height = '100px';
                        pouringLiquid.style.height = '100%';
                        
                        // Réduire le liquide dans le tube source
                        const fromLiquid = fromContainer.querySelector('.liquid');
                        let sourceHeight = parseInt(fromLiquid.style.height);
                        const sourceInterval = setInterval(() => {
                            if (sourceHeight <= 0) {
                                clearInterval(sourceInterval);
                                return;
                            }
                            sourceHeight -= 2;
                            fromLiquid.style.height = sourceHeight + '%';
                        }, 50);
                        
                        // Augmenter le liquide dans le tube cible
                        const toLiquid = toContainer.querySelector('.liquid');
                        let targetHeight = parseInt(toLiquid.style.height);
                        let currentColor = toLiquid.style.backgroundColor;
                        
                        const targetInterval = setInterval(() => {
                            if (targetHeight >= 100) {
                                clearInterval(targetInterval);
                                
                                // Fin de l'animation
                                setTimeout(() => {
                                    pouring.style.transform = 'rotate(0deg)';
                                    pouring.style.height = '0';
                                    fromContainer.style.transform = 'translate(0, 0)';
                                    
                                    setTimeout(() => {
                                        pouring.remove();
                                        resolve();
                                    }, 500);
                                }, 500);
                                return;
                            }
                            
                            targetHeight += 2;
                            toLiquid.style.height = targetHeight + '%';
                            
                            // Mélange des couleurs
                            if (liquidColor) {
                                if (!currentColor || currentColor === 'transparent') {
                                    toLiquid.style.backgroundColor = liquidColor;
                                } else {
                                    // Mélange progressif des couleurs
                                    const ratio = targetHeight / 100;
                                    if (liquidColor === 'rgb(255, 249, 196)') { // Amidon
                                        if (currentColor.includes('187, 222, 251')) { // Si mélange avec eau
                                            toLiquid.style.backgroundColor = `rgb(221, 235, ${Math.floor(196 + (251 - 196) * (1 - ratio))})`;
                                        } else {
                                            toLiquid.style.backgroundColor = liquidColor;
                                        }
                                    } else if (liquidColor === 'rgb(212, 230, 241)') { // Amylase
                                        // Mélange amidon + amylase = vert clair
                                        if (currentColor.includes('255, 249, 196')) {
                                            toLiquid.style.backgroundColor = `rgb(233, 239, ${196 + Math.floor(45 * ratio)})`;
                                        } else {
                                            toLiquid.style.backgroundColor = liquidColor;
                                        }
                                    } else if (liquidColor === 'rgb(227, 242, 253)') { // Eau
                                        // Mélange eau + amidon = bleu clair
                                        if (currentColor.includes('255, 249, 196')) {
                                            toLiquid.style.backgroundColor = `rgb(241, 245, ${196 + Math.floor(57 * ratio)})`;
                                        } else {
                                            toLiquid.style.backgroundColor = liquidColor;
                                        }
                                    }
                                }
                            }
                        }, 50);
                    }, 500);
                });
            }
            
            // Simulation eau + amidon
            btnEauAmidon.addEventListener('click', async function() {
                if (isTubeSimulating) return;
                isTubeSimulating = true;
                btnEauAmidon.disabled = true;
                btnAmidonAmylase.disabled = true;
                
                // Vider le tube de mélange
                liquidMelange.style.height = '0%';
                liquidMelange.style.backgroundColor = 'transparent';
                tubeResult.style.display = 'none';
                
                // Animation
                await pourTube(containerEau, containerMelange, 'var(--eau)');
                await pourTube(containerAmidon, containerMelange, 'var(--amidon)');
                
                // Résultat final
                liquidMelange.style.backgroundColor = 'var(--eau-amidon)';
                tubeResult.textContent = "Observation : Le mélange devient bleu clair. Conclusion : Il n'y a pas de digestion (l'eau seule ne digère pas l'amidon).";
                tubeResult.style.display = 'block';
                isTubeSimulating = false;
            });
            
            // Simulation amidon + amylase
            btnAmidonAmylase.addEventListener('click', async function() {
                if (isTubeSimulating) return;
                isTubeSimulating = true;
                btnEauAmidon.disabled = true;
                btnAmidonAmylase.disabled = true;
                
                // Vider le tube de mélange
                liquidMelange.style.height = '0%';
                liquidMelange.style.backgroundColor = 'transparent';
                tubeResult.style.display = 'none';
                
                // Animation
                await pourTube(containerAmidon, containerMelange, 'var(--amidon)');
                await pourTube(containerAmylase, containerMelange, 'var(--amylase)');
                
                // Résultat final
                liquidMelange.style.backgroundColor = 'var(--amidon-amylase)';
                tubeResult.textContent = "Observation : Le mélange devient vert clair. Conclusion : Il y a digestion (l'amylase transforme l'amidon).";
                tubeResult.style.display = 'block';
                isTubeSimulating = false;
            });
            
            // Réinitialisation des tubes
            btnResetTubes.addEventListener('click', function() {
                isTubeSimulating = false;
                liquidEau.style.height = '100%';
                liquidAmidon.style.height = '100%';
                liquidAmylase.style.height = '100%';
                liquidMelange.style.height = '0%';
                liquidMelange.style.backgroundColor = 'transparent';
                btnEauAmidon.disabled = false;
                btnAmidonAmylase.disabled = false;
                tubeResult.style.display = 'none';
                
                // Réinitialiser les positions
                containerEau.style.transform = 'translate(0, 0)';
                containerAmidon.style.transform = 'translate(0, 0)';
                containerAmylase.style.transform = 'translate(0, 0)';
                
                // Supprimer toutes les animations de versement
                document.querySelectorAll('.pouring').forEach(el => el.remove());
            });

            /******************************************************
             * Partie 2: Simulation moléculaire
             ******************************************************/
            // Variables de la simulation
            let selectedEnzyme = 'amylase';
            let phValue = 7;
            let temperature = 37;
            let enzymeConcentration = 50;
            let simulationInterval;
            let molecules = [];
            let enzymes = [];
            let products = [];
            let isSimulationRunning = false;

            // Éléments DOM
            const digestionTube = document.getElementById('digestionTube');
            const startBtn = document.getElementById('startBtn');
            const resetBtn = document.getElementById('resetBtn');
            const phSlider = document.getElementById('phSlider');
            const phValueDisplay = document.getElementById('phValue');
            const tempSlider = document.getElementById('tempSlider');
            const tempValueDisplay = document.getElementById('tempValue');
            const enzymeSlider = document.getElementById('enzymeSlider');
            const enzymeValueDisplay = document.getElementById('enzymeValue');
            const enzymeOptions = document.querySelectorAll('.enzyme-option');
            const explanations = {
                amylase: document.getElementById('amylaseExplanation'),
                pepsine: document.getElementById('pepsineExplanation'),
                lipase: document.getElementById('lipaseExplanation')
            };

            // Écouteurs d'événements
            enzymeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    enzymeOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                    selectedEnzyme = this.dataset.enzyme;
                    
                    // Afficher l'explication correspondante
                    for (const key in explanations) {
                        if (key === selectedEnzyme) {
                            explanations[key].classList.remove('hidden');
                        } else {
                            explanations[key].classList.add('hidden');
                        }
                    }
                });
            });

            phSlider.addEventListener('input', function() {
                phValueDisplay.textContent = this.value;
                phValue = parseInt(this.value);
            });

            tempSlider.addEventListener('input', function() {
                tempValueDisplay.textContent = this.value;
                temperature = parseInt(this.value);
            });

            enzymeSlider.addEventListener('input', function() {
                enzymeValueDisplay.textContent = this.value;
                enzymeConcentration = parseInt(this.value);
            });

            startBtn.addEventListener('click', startSimulation);
            resetBtn.addEventListener('click', resetSimulation);

            // Fonctions de la simulation
            function startSimulation() {
                if (isSimulationRunning) return;
                isSimulationRunning = true;
                startBtn.textContent = 'Simulation en cours...';
                startBtn.disabled = true;

                // Créer des molécules alimentaires selon l'enzyme sélectionnée
                let moleculeType, productType;
                switch(selectedEnzyme) {
                    case 'amylase':
                        moleculeType = 'AM';
                        productType = 'MA';
                        break;
                    case 'pepsine':
                        moleculeType = 'PR';
                        productType = 'PE';
                        break;
                    case 'lipase':
                        moleculeType = 'LI';
                        productType = 'AG';
                        break;
                }

                // Créer 5 molécules alimentaires
                for (let i = 0; i < 5; i++) {
                    createMolecule(moleculeType);
                }

                // Créer des enzymes (nombre proportionnel à la concentration)
                const enzymeCount = Math.floor(enzymeConcentration / 20);
                for (let i = 0; i < enzymeCount; i++) {
                    createEnzyme();
                }

                // Démarrer l'animation
                simulationInterval = setInterval(updateSimulation, 100);
            }

            function createMolecule(type) {
                const molecule = document.createElement('div');
                molecule.className = 'food-molecule';
                molecule.textContent = type;
                
                // Position aléatoire dans le tube digestif
                const tubeRect = digestionTube.getBoundingClientRect();
                const x = Math.random() * (tubeRect.width - 40);
                const y = Math.random() * (tubeRect.height - 40);
                
                molecule.style.left = `${x}px`;
                molecule.style.top = `${y}px`;
                
                digestionTube.appendChild(molecule);
                
                molecules.push({
                    element: molecule,
                    x: x,
                    y: y,
                    type: type,
                    vx: (Math.random() - 0.5) * 2,
                    vy: (Math.random() - 0.5) * 2
                });
            }

            function createEnzyme() {
                const enzyme = document.createElement('div');
                enzyme.className = 'enzyme';
                enzyme.textContent = selectedEnzyme[0].toUpperCase();
                
                const tubeRect = digestionTube.getBoundingClientRect();
                const x = Math.random() * (tubeRect.width - 30);
                const y = Math.random() * (tubeRect.height - 30);
                
                enzyme.style.left = `${x}px`;
                enzyme.style.top = `${y}px`;
                
                digestionTube.appendChild(enzyme);
                
                enzymes.push({
                    element: enzyme,
                    x: x,
                    y: y,
                    vx: (Math.random() - 0.5) * 3,
                    vy: (Math.random() - 0.5) * 3
                });
            }

            function createProduct(type, x, y) {
                const product = document.createElement('div');
                product.className = 'product';
                product.textContent = type;
                
                product.style.left = `${x}px`;
                product.style.top = `${y}px`;
                
                digestionTube.appendChild(product);
                
                products.push({
                    element: product,
                    x: x,
                    y: y,
                    type: type,
                    vx: (Math.random() - 0.5) * 3,
                    vy: (Math.random() - 0.5) * 3
                });
            }

            function updateSimulation() {
                // Déplacer les molécules
                molecules.forEach(molecule => {
                    // Appliquer le mouvement
                    molecule.x += molecule.vx;
                    molecule.y += molecule.vy;
                    
                    // Vérifier les collisions avec les bords
                    const tubeRect = digestionTube.getBoundingClientRect();
                    const moleculeRect = molecule.element.getBoundingClientRect();
                    
                    if (molecule.x <= 0 || molecule.x >= tubeRect.width - moleculeRect.width) {
                        molecule.vx *= -1;
                    }
                    
                    if (molecule.y <= 0 || molecule.y >= tubeRect.height - moleculeRect.height) {
                        molecule.vy *= -1;
                    }
                    
                    // Appliquer la nouvelle position
                    molecule.element.style.left = `${molecule.x}px`;
                    molecule.element.style.top = `${molecule.y}px`;
                });
                
                // Déplacer les enzymes
                enzymes.forEach(enzyme => {
                    enzyme.x += enzyme.vx;
                    enzyme.y += enzyme.vy;
                    
                    const tubeRect = digestionTube.getBoundingClientRect();
                    const enzymeRect = enzyme.element.getBoundingClientRect();
                    
                    if (enzyme.x <= 0 || enzyme.x >= tubeRect.width - enzymeRect.width) {
                        enzyme.vx *= -1;
                    }
                    
                    if (enzyme.y <= 0 || enzyme.y >= tubeRect.height - enzymeRect.height) {
                        enzyme.vy *= -1;
                    }
                    
                    enzyme.element.style.left = `${enzyme.x}px`;
                    enzyme.element.style.top = `${enzyme.y}px`;
                    
                    // Vérifier les collisions avec les molécules
                    molecules.forEach((molecule, index) => {
                        const dx = enzyme.x - molecule.x;
                        const dy = enzyme.y - molecule.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        
                        // Si collision
                        if (distance < 35) {
                            // Créer des produits de digestion
                            let productType;
                            switch(selectedEnzyme) {
                                case 'amylase': productType = 'MA'; break;
                                case 'pepsine': productType = 'PE'; break;
                                case 'lipase': productType = 'AG'; break;
                            }
                            
                            createProduct(productType, molecule.x, molecule.y);
                            
                            // Supprimer la molécule
                            molecule.element.remove();
                            molecules.splice(index, 1);
                            
                            // Si toutes les molécules sont digérées, arrêter la simulation
                            if (molecules.length === 0) {
                                endSimulation();
                            }
                        }
                    });
                });
                
                // Déplacer les produits
                products.forEach(product => {
                    product.x += product.vx;
                    product.y += product.vy;
                    
                    const tubeRect = digestionTube.getBoundingClientRect();
                    const productRect = product.element.getBoundingClientRect();
                    
                    if (product.x <= 0 || product.x >= tubeRect.width - productRect.width) {
                        product.vx *= -1;
                    }
                    
                    if (product.y <= 0 || product.y >= tubeRect.height - productRect.height) {
                        product.vy *= -1;
                    }
                    
                    product.element.style.left = `${product.x}px`;
                    product.element.style.top = `${product.y}px`;
                });
            }

            function endSimulation() {
                clearInterval(simulationInterval);
                isSimulationRunning = false;
                startBtn.textContent = 'Simulation terminée';
                
                // Afficher un message de conclusion
                const message = document.createElement('div');
                message.style.position = 'absolute';
                message.style.top = '50%';
                message.style.left = '50%';
                message.style.transform = 'translate(-50%, -50%)';
                message.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
                message.style.padding = '1rem';
                message.style.borderRadius = '5px';
                message.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
                message.style.textAlign = 'center';
                message.style.zIndex = '100';
                
                let resultText = '';
                switch(selectedEnzyme) {
                    case 'amylase':
                        resultText = 'L\'amylase a transformé l\'amidon (AM) en maltose (MA)';
                        break;
                    case 'pepsine':
                        resultText = 'La pepsine a transformé les protéines (PR) en peptides (PE)';
                        break;
                    case 'lipase':
                        resultText = 'La lipase a transformé les lipides (LI) en acides gras (AG)';
                        break;
                }
                
                message.innerHTML = `<h3>Résultat de la digestion</h3><p>${resultText}</p>`;
                digestionTube.appendChild(message);
            }

            function resetSimulation() {
                clearInterval(simulationInterval);
                isSimulationRunning = false;
                startBtn.textContent = 'Démarrer la simulation';
                startBtn.disabled = false;
                
                // Supprimer tous les éléments
                molecules.forEach(molecule => molecule.element.remove());
                enzymes.forEach(enzyme => enzyme.element.remove());
                products.forEach(product => product.element.remove());
                
                // Vider les tableaux
                molecules = [];
                enzymes = [];
                products = [];
                
                // Supprimer le message de fin s'il existe
                const message = digestionTube.querySelector('div[style*="z-index: 100"]');
                if (message) {
                    message.remove();
                }
            }
        });
    </script>
</body>
</html>