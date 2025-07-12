<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simulation_experiments', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('matiere'); // photosynthese, respiration, digestion, etc.
            $table->string('niveau'); // facile, moyen, difficile
            $table->json('objectifs'); // Objectifs d'apprentissage
            $table->json('materiel_virtuel'); // Matériel nécessaire
            $table->integer('duree_estimee'); // en minutes
            $table->text('instructions_generales');
            $table->foreignId('professeur_id')->constrained('users')->onDelete('cascade');
            $table->boolean('actif')->default(true);
            $table->boolean('public')->default(false); // Visible par tous les professeurs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_experiments');
    }
};
