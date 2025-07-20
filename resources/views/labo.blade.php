@extends('layouts.app')

@section('title', 'Connexion - Laboratoire Virtuel SVT')

@section('content')
<div class="main-container">
    <div class="floating-elements">
        <!-- Éléments flottants décoratifs -->
        <div class="floating-element" style="width: 80px; height: 80px; top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="floating-element" style="width: 120px; height: 120px; top: 70%; left: 80%; animation-delay: 3s;"></div>
        <div class="floating-element" style="width: 60px; height: 60px; top: 40%; left: 50%; animation-delay: 6s;"></div>
        <div class="floating-element" style="width: 100px; height: 100px; top: 80%; left: 20%; animation-delay: 9s;"></div>
        <div class="floating-element" style="width: 70px; height: 70px; top: 30%; left: 70%; animation-delay: 12s;"></div>
    </div>

    <div class="login-section">
        <div class="logo-container">
            <a href="#" class="logo">
                <i class="fas fa-flask"></i>
                <span>SUNU LAB</span>
            </a>
            <h1>Laboratoire Virtuel</h1>
            <p class="subtitle">Sciences de la Vie et de la Terre</p>
        </div>

        <form class="login-form" action="{{ url('/labo') }}" method="POST">
            @csrf
            
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-group">
                <label for="email">
                    <i class="fas fa-user"></i>
                    Identifiant
                </label>
                <input type="text" name="email" required placeholder="Votre identifiant" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                    Mot de passe
                </label>
                <input type="password" name="password" required placeholder="Votre mot de passe" class="form-control">
                <div class="forgot-password">
                    <a href="#">
                        <i class="fas fa-key"></i>
                        Mot de passe oublié ?
                    </a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                Se connecter
            </button>
        </form>

        <div class="demo-access">
            <a href="#">
                <i class="fas fa-eye"></i>
                Accéder à la démo sans connexion
            </a>
        </div>
    </div>

    <div class="image-section">
        <div class="image-overlay">
            <h2>Découvrez nos expériences</h2>
            <p>Simulations interactives et protocoles virtuels pour l'apprentissage des SVT</p>
            
            <div class="features">
                <div class="feature">
                    <i class="fas fa-microscope"></i>
                    <h3>Microscopie</h3>
                    <p>Observations virtuelles</p>
                </div>
                <div class="feature">
                    <i class="fas fa-dna"></i>
                    <h3>Génétique</h3>
                    <p>Manipulations ADN</p>
                </div>
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Écologie</h3>
                    <p>Écosystèmes virtuels</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .main-container {
        display: flex;
        width: 1100px;
        max-width: 95%;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        transform: perspective(1000px);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 1;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        margin: 50px auto;
    }

    .main-container:hover {
        transform: perspective(1000px) translateY(-8px) rotateX(2deg);
        box-shadow: 
            0 35px 70px rgba(0, 0, 0, 0.35),
            0 0 0 1px rgba(255, 255, 255, 0.2);
    }

    .login-section {
        width: 50%;
        padding: 60px 50px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
        backdrop-filter: blur(20px);
    }

    .logo-container {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }

    .logo {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-color);
        text-decoration: none;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        filter: drop-shadow(0 5px 15px rgba(102, 126, 234, 0.3));
    }

    .logo i {
        font-size: 3rem;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .logo:hover {
        transform: scale(1.05) rotate(-2deg);
        filter: drop-shadow(0 8px 20px rgba(102, 126, 234, 0.4));
    }

    .logo:hover i {
        animation: pulse 1s infinite;
    }

    .login-form {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .forgot-password {
        text-align: right;
        margin: -10px 0 25px;
    }

    .forgot-password a {
        color: var(--primary-color);
        font-size: 0.9rem;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .forgot-password a:hover {
        color: var(--primary-dark);
        transform: translateX(5px);
    }

    .demo-access {
        text-align: center;
        margin-top: 30px;
    }

    .demo-access a {
        color: var(--primary-color);
        font-size: 0.95rem;
        text-decoration: none;
        font-weight: 600;
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .demo-access a::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width 0.3s;
    }

    .demo-access a:hover::after {
        width: 100%;
    }

    .demo-access a:hover {
        transform: translateY(-2px);
    }

    .image-section {
        width: 50%;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
                    url('https://images.unsplash.com/photo-1576086213369-97a306d36557?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;
        position: relative;
        transition: all 0.5s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-container:hover .image-section {
        transform: scale(1.02);
    }

    .image-overlay {
        text-align: center;
        padding: 40px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        max-width: 80%;
    }

    .image-overlay h2 {
        font-size: 2.2rem;
        margin-bottom: 15px;
        font-weight: 700;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .image-overlay p {
        opacity: 0.9;
        font-size: 1.1rem;
        color: #e0e0e0;
        line-height: 1.6;
    }

    .features {
        display: flex;
        justify-content: space-around;
        margin-top: 30px;
        gap: 20px;
    }

    .feature {
        text-align: center;
        color: white;
    }

    .feature i {
        font-size: 2rem;
        margin-bottom: 10px;
        color: var(--accent-color);
    }

    .feature h3 {
        font-size: 1rem;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .feature p {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
    }

    .floating-element {
        position: absolute;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(156, 39, 176, 0.1));
        border-radius: 50%;
        animation: float 20s infinite linear;
        backdrop-filter: blur(5px);
    }

    @keyframes float {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) rotate(720deg);
            opacity: 0;
        }
    }

    @media (max-width: 768px) {
        .main-container {
            flex-direction: column;
            margin: 20px 0;
            width: 95%;
        }

        .login-section, .image-section {
            width: 100%;
        }

        .image-section {
            height: 250px;
        }

        .login-section {
            padding: 40px 30px;
        }

        .logo {
            font-size: 2rem;
        }

        .logo i {
            font-size: 2.5rem;
        }

        .features {
            flex-direction: column;
            gap: 15px;
        }
    }

    .main-container {
        animation: fadeInUp 1s ease-out forwards;
    }

    .login-section {
        animation: fadeInUp 1s ease-out 0.2s both;
    }

    .image-section {
        animation: fadeInUp 1s ease-out 0.4s both;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Effet sur les labels
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const label = this.parentNode.querySelector('label');
                label.style.color = 'var(--primary-color)';
                label.style.transform = 'translateX(5px)';
            });
            input.addEventListener('blur', function() {
                const label = this.parentNode.querySelector('label');
                label.style.color = 'var(--dark-color)';
                label.style.transform = 'translateX(0)';
            });
        });

        // Création d'éléments flottants dynamiques
        const floatingContainer = document.querySelector('.floating-elements');
        for (let i = 0; i < 8; i++) {
            const element = document.createElement('div');
            element.className = 'floating-element';
            const size = Math.random() * 80 + 40;
            const posX = Math.random() * 100;
            const delay = Math.random() * 15;
            const duration = Math.random() * 15 + 15;
            
            element.style.width = `${size}px`;
            element.style.height = `${size}px`;
            element.style.left = `${posX}%`;
            element.style.animationDelay = `${delay}s`;
            element.style.animationDuration = `${duration}s`;
            element.style.opacity = Math.random() * 0.2 + 0.1;
            
            floatingContainer.appendChild(element);
        }
    });
</script>
@endpush
@endsection
