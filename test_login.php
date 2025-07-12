<?php
// Script de test pour vérifier la fonctionnalité de connexion
echo "=== Test de la fonctionnalité de connexion ===\n\n";

echo "Utilisateurs de test créés :\n";
echo "1. Élève - Email: eleve@test.com, Mot de passe: password\n";
echo "2. Professeur - Email: professeur@test.com, Mot de passe: password\n";
echo "3. Admin - Email: admin@test.com, Mot de passe: password\n\n";

echo "Instructions de test :\n";
echo "1. Allez sur http://localhost/laboratoireVirtuel/SEN_LAB/public/labo\n";
echo "2. Connectez-vous avec l'un des comptes ci-dessus\n";
echo "3. Vous devriez être redirigé vers la page correspondante à votre statut\n\n";

echo "Redirections attendues :\n";
echo "- Élève → /eleve (page eleve.blade.php)\n";
echo "- Professeur → /professeur (page professeur.blade.php)\n";
echo "- Admin → /admin/dashboard (page admin.blade.php)\n\n";

echo "Test terminé !\n";
?> 