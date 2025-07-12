# SEN_LAB - Laboratoire Virtuel SVT

Un laboratoire virtuel de Sciences de la Vie et de la Terre (SVT) conçu pour les élèves de 3ème, avec un système de gestion des rôles (élèves, professeurs, administrateurs).

## 🚀 Fonctionnalités

### Pour les Élèves
- Accès aux simulations virtuelles
- Participation aux QCM
- Suivi des résultats
- Interface adaptée aux jeunes apprenants

### Pour les Professeurs
- Gestion des QCM (création, modification, suppression)
- Suivi des résultats des élèves
- Gestion des simulations
- Tableau de bord complet

### Pour les Administrateurs
- Gestion des utilisateurs
- Gestion des classes
- Gestion des établissements
- Statistiques globales

## 🛠️ Technologies Utilisées

- **Backend**: Laravel 10
- **Frontend**: Vue.js, Blade Templates
- **Base de données**: MySQL
- **CSS**: Bootstrap, CSS personnalisé
- **3D**: Three.js (pour les simulations)

## 📋 Prérequis

- PHP 8.1 ou supérieur
- Composer
- MySQL
- Node.js et npm

## 🔧 Installation

1. **Cloner le repository**
   ```bash
   git clone [URL_DU_REPO]
   cd SEN_LAB
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances Node.js**
   ```bash
   npm install
   ```

4. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurer la base de données**
   - Modifier le fichier `.env` avec vos paramètres de base de données
   - Créer la base de données

6. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Lancer le serveur de développement**
   ```bash
   php artisan serve
   ```

## 👥 Utilisateurs de Test

Le seeder crée automatiquement des utilisateurs de test :

- **Admin**: admin@senlab.com / password
- **Professeur**: prof@senlab.com / password  
- **Élève**: eleve@senlab.com / password

## 📁 Structure du Projet

```
SEN_LAB/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Models/              # Modèles Eloquent
│   └── Providers/           # Fournisseurs de services
├── database/
│   ├── migrations/          # Migrations de base de données
│   └── seeders/            # Seeders pour les données de test
├── resources/
│   ├── views/              # Vues Blade
│   ├── js/                 # Composants Vue.js
│   └── css/                # Styles CSS
└── public/
    ├── images/             # Images des simulations
    └── models/             # Modèles 3D
```

## 🎯 Simulations Disponibles

- **Tectonique des plaques**
- **Circulation sanguine**
- **Cycle de fécondation**
- **Digestion enzymatique**
- **Photosynthèse**
- **Transmission nerveuse**

## 🔐 Sécurité

- Authentification Laravel Sanctum
- Middleware de rôles personnalisé
- Protection CSRF
- Validation des données

## 📝 Licence

Ce projet est développé pour un usage éducatif.

## 👨‍💻 Développement

Pour contribuer au projet :

1. Fork le repository
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Créer une Pull Request

## 📞 Support

Pour toute question ou problème, veuillez ouvrir une issue sur GitHub.
