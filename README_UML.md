# Diagramme de Cas d'Utilisation - SUNU-LAB

## Description
Ce diagramme UML représente les cas d'utilisation du système de laboratoire virtuel SVT (Sciences de la Vie et de la Terre) pour les élèves de 3ème.

## Acteurs Identifiés

### 1. **Visiteur**
- Utilisateur non connecté
- Peut se connecter et s'inscrire
- Accès limité aux informations publiques

### 2. **Élève**
- Utilisateur connecté avec statut "élève"
- Accès aux simulations et expériences virtuelles
- Peut répondre aux QCM
- Peut visualiser les vidéos

### 3. **Professeur**
- Utilisateur connecté avec statut "professeur"
- Tous les droits des élèves
- Peut créer, modifier et supprimer des simulations
- Peut créer et gérer des QCM
- Peut uploader des vidéos
- Accès aux statistiques

### 4. **Administrateur**
- Utilisateur avec tous les droits
- Gestion complète du système
- Gestion des utilisateurs, classes et établissements
- Accès à toutes les fonctionnalités

## Packages Fonctionnels

### 🔐 Authentification
- Connexion/Déconnexion
- Inscription
- Gestion des profils

### 🏢 Gestion Administrative
- Gestion des établissements
- Gestion des classes
- Gestion des utilisateurs
- Statistiques système
- Notifications

### 🧪 Gestion des Simulations
- CRUD des simulations
- Exécution des simulations 3D
- Visualisation interactive
- Consultation des résultats

### 📝 Gestion des QCM
- CRUD des QCM
- Réponses aux questions
- Statistiques des résultats
- Soumission des réponses

### 🎥 Gestion des Vidéos
- Upload de vidéos
- Visualisation
- Suppression
- Statistiques d'utilisation

### 🔬 Expériences Virtuelles
- **Mitose** : Division cellulaire
- **Fécondation** : Fusion ovule-spermatozoïde
- **Circulation sanguine** : Flux sanguin
- **Séismes** : Ondes sismiques
- **Volcanisme** : Éruptions volcaniques
- **Chaînes alimentaires** : Interactions écologiques
- **Hérédité** : Transmission génétique
- **Photosynthèse** : Processus végétal
- **Tectonique** : Mouvement des plaques
- **Transmission nerveuse** : Influx nerveux
- **Digestion enzymatique** : Processus digestif

### 🧭 Navigation et Interface
- Accès à l'accueil
- Consultation des informations
- Navigation dans l'interface

## Relations

### Relations d'Inclusion (<<include>>)
- L'exécution d'une simulation inclut la visualisation 3D
- La réponse à un QCM inclut la soumission

### Relations d'Extension (<<extend>>)
- L'accès au laboratoire virtuel peut être étendu par différentes expériences

## Comment Visualiser le Diagramme

### Option 1 : PlantUML Online
1. Allez sur [PlantUML Online Server](http://www.plantuml.com/plantuml/uml/)
2. Copiez le contenu du fichier `diagramme_cas_utilisation.puml`
3. Collez-le dans l'éditeur
4. Le diagramme sera généré automatiquement

### Option 2 : Extension VS Code
1. Installez l'extension "PlantUML" dans VS Code
2. Ouvrez le fichier `.puml`
3. Utilisez `Ctrl+Shift+P` et tapez "PlantUML: Preview"

### Option 3 : IntelliJ IDEA
1. Installez le plugin PlantUML
2. Ouvrez le fichier `.puml`
3. Le diagramme sera affiché automatiquement

## Technologies Utilisées

- **Backend** : Laravel (PHP)
- **Frontend** : Blade Templates, Three.js
- **Base de données** : MySQL
- **Authentification** : Laravel Sanctum
- **Visualisation 3D** : Three.js
- **Diagramme UML** : PlantUML

## Points Clés du Système

1. **Sécurité** : Authentification et autorisation par rôles
2. **Interactivité** : Simulations 3D interactives
3. **Pédagogie** : Contenu adapté au niveau 3ème
4. **Gestion** : Interface d'administration complète
5. **Suivi** : Statistiques et résultats des élèves

## Évolutions Possibles

- Ajout de nouvelles expériences virtuelles
- Intégration de réalité virtuelle (VR)
- Système de notation automatique
- Collaboration en temps réel
- Export des résultats en PDF
- Intégration avec d'autres plateformes éducatives 