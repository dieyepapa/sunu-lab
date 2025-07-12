<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Labo SVT 3ème</title>
    <style>
        :root {
            --primary: #c62828;
            --primary-light: #ff5f52;
            --primary-dark: #8e0000;
            --secondary: #1565c0;
            --dark: #263238;
            --light: #f5f5f5;
            --accent: #ffab00;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e0e0e0 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--dark);
        }

        .main-container {
            display: flex;
            width: 1000px;
            max-width: 95%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(198, 40, 40, 0.15);
            transform: perspective(1000px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
        }

        .main-container:hover {
            transform: perspective(1000px) translateY(-5px) rotateX(1deg);
            box-shadow: 0 30px 60px rgba(198, 40, 40, 0.25);
        }

        .login-section {
            width: 50%;
            padding: 50px;
            background: white;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .logo {
            height: 90px;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 10px rgba(198, 40, 40, 0.2));
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05) rotate(-5deg);
            filter: drop-shadow(0 8px 15px rgba(198, 40, 40, 0.3));
        }

        h1 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 8px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #616161;
            font-size: 1rem;
            font-weight: 500;
        }

        .login-form {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f9f9f9;
        }

        input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(198, 40, 40, 0.15);
            background-color: white;
        }

        .forgot-password {
            text-align: right;
            margin: -15px 0 20px;
        }

        .forgot-password a {
            color: var(--primary);
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-block;
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
            transform: translateX(3px);
        }

        button {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 16px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: auto;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.3);
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(198, 40, 40, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        button:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        .demo-access {
            text-align: center;
            margin-top: 25px;
        }

        .demo-access a {
            color: var(--primary);
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            display: inline-block;
        }

        .demo-access a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s;
        }

        .demo-access a:hover::after {
            width: 100%;
        }

        .image-section {
            width: 50%;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
            position: relative;
            transition: all 0.5s;
        }

        .main-container:hover .image-section {
            transform: scale(1.02);
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
        }

        .image-overlay h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .image-overlay p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .floating-element {
            position: absolute;
            background: rgba(198, 40, 40, 0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                margin: 20px 0;
            }

            .login-section, .image-section {
                width: 100%;
            }

            .image-section {
                height: 200px;
            }

            .login-section {
                padding: 40px 30px;
            }

            .logo {
                height: 70px;
            }
        }

        /* Animation d'entrée */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-container {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <div class="floating-elements">
            <!-- Éléments flottants décoratifs -->
            <div class="floating-element" style="width: 100px; height: 100px; top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="floating-element" style="width: 150px; height: 150px; top: 70%; left: 80%; animation-delay: 2s;"></div>
            <div class="floating-element" style="width: 60px; height: 60px; top: 40%; left: 50%; animation-delay: 4s;"></div>
        </div>

        <div class="login-section">
            <div class="logo-container">
                <nav class="navbar">
                    <a href="#" class="logo" style="color: #c62828;">
                      <i class="fas fa-flask"></i>
                      <span>SUNU-LAB</span>
                    </a>
                </nav>
                
            </div>

            <form class="login-form" action="{{ url('/labo') }}" method="POST">
                @csrf
                
                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="email"><i class="fas fa-user" style="margin-right: 8px;"></i>Identifiant</label>
                    <input type="text" name="email" required placeholder="Votre identifiant">
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock" style="margin-right: 8px;"></i>Mot de passe</label>
                    <input type="password" name="password" required placeholder="Votre mot de passe">
                    <div class="forgot-password">
                        <a href="#"><i class="fas fa-key" style="margin-right: 5px;"></i>Mot de passe oublié ?</a>
                    </div>
                </div>

                <button type="submit">
                    <i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i>Se connecter
                </button>
            </form>

            <div class="demo-access">
                <a href="#"><i class="fas fa-eye" style="margin-right: 8px;"></i>Accéder à la démo sans connexion</a>
            </div>
        </div>

        <div class="image-section">
            <div class="image-overlay">
                <h2>Découvrez nos expériences</h2>
                <p>Simulations interactives et protocoles virtuels</p>
            </div>
        </div>
    </div>

    <script>
        // Animation améliorée
        document.addEventListener('DOMContentLoaded', () => {
            // Effet sur les labels
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const label = this.parentNode.querySelector('label');
                    label.style.color = 'var(--primary)';
                    label.style.transform = 'translateX(5px)';
                });
                input.addEventListener('blur', function() {
                    const label = this.parentNode.querySelector('label');
                    label.style.color = 'var(--dark)';
                    label.style.transform = 'translateX(0)';
                });
            });

            // Création d'éléments flottants dynamiques
            const floatingContainer = document.querySelector('.floating-elements');
            for (let i = 0; i < 5; i++) {
                const element = document.createElement('div');
                element.className = 'floating-element';
                const size = Math.random() * 100 + 50;
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                const delay = Math.random() * 5;
                const duration = Math.random() * 10 + 10;
                
                element.style.width = `${size}px`;
                element.style.height = `${size}px`;
                element.style.top = `${posY}%`;
                element.style.left = `${posX}%`;
                element.style.animationDelay = `${delay}s`;
                element.style.animationDuration = `${duration}s`;
                element.style.opacity = Math.random() * 0.3 + 0.1;
                
                floatingContainer.appendChild(element);
            }
        });
    </script>
</body>
</html>