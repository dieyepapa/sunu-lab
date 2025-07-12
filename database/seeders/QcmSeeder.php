<?php

namespace Database\Seeders;

use App\Models\QcmQuestion;
use App\Models\User;
use Illuminate\Database\Seeder;

class QcmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer un professeur
        $professeur = User::where('status', 'professeur')->first();
        
        if (!$professeur) {
            return;
        }

        $questions = [
            [
                'titre' => 'La photosynthèse',
                'question' => 'Quel est le principal pigment responsable de la photosynthèse chez les plantes vertes ?',
                'options' => [
                    'A' => 'La chlorophylle',
                    'B' => 'Le carotène',
                    'C' => 'L\'anthocyane',
                    'D' => 'La xanthophylle'
                ],
                'bonne_reponse' => 'A',
                'matiere' => 'photosynthese',
                'niveau' => 'facile',
                'explication' => 'La chlorophylle est le pigment principal qui capture l\'énergie lumineuse pour la photosynthèse.'
            ],
            [
                'titre' => 'La respiration cellulaire',
                'question' => 'Quel organite cellulaire est responsable de la respiration cellulaire ?',
                'options' => [
                    'A' => 'Le noyau',
                    'B' => 'La mitochondrie',
                    'C' => 'Le réticulum endoplasmique',
                    'D' => 'L\'appareil de Golgi'
                ],
                'bonne_reponse' => 'B',
                'matiere' => 'respiration',
                'niveau' => 'moyen',
                'explication' => 'La mitochondrie est l\'organite où se déroule la respiration cellulaire et la production d\'ATP.'
            ],
            [
                'titre' => 'La digestion',
                'question' => 'Quel enzyme est responsable de la digestion des protéines dans l\'estomac ?',
                'options' => [
                    'A' => 'L\'amylase',
                    'B' => 'La lipase',
                    'C' => 'La pepsine',
                    'D' => 'La trypsine'
                ],
                'bonne_reponse' => 'C',
                'matiere' => 'digestion',
                'niveau' => 'difficile',
                'explication' => 'La pepsine est l\'enzyme gastrique qui dégrade les protéines en peptides.'
            ],
            [
                'titre' => 'La circulation sanguine',
                'question' => 'Quelle est la fonction principale des globules rouges ?',
                'options' => [
                    'A' => 'Lutter contre les infections',
                    'B' => 'Transporter l\'oxygène',
                    'C' => 'Coaguler le sang',
                    'D' => 'Produire des anticorps'
                ],
                'bonne_reponse' => 'B',
                'matiere' => 'circulation',
                'niveau' => 'facile',
                'explication' => 'Les globules rouges contiennent l\'hémoglobine qui transporte l\'oxygène dans le sang.'
            ],
            [
                'titre' => 'La reproduction',
                'question' => 'Quel est le nom de la cellule reproductrice mâle chez les plantes à fleurs ?',
                'options' => [
                    'A' => 'L\'ovule',
                    'B' => 'Le pollen',
                    'C' => 'L\'embryon',
                    'D' => 'La graine'
                ],
                'bonne_reponse' => 'B',
                'matiere' => 'reproduction',
                'niveau' => 'moyen',
                'explication' => 'Le pollen contient les gamètes mâles qui fécondent l\'ovule pour former l\'embryon.'
            ]
        ];

        foreach ($questions as $questionData) {
            QcmQuestion::create([
                'titre' => $questionData['titre'],
                'question' => $questionData['question'],
                'options' => $questionData['options'],
                'bonne_reponse' => $questionData['bonne_reponse'],
                'matiere' => $questionData['matiere'],
                'niveau' => $questionData['niveau'],
                'explication' => $questionData['explication'],
                'professeur_id' => $professeur->idUser,
                'actif' => true
            ]);
        }
    }
}
