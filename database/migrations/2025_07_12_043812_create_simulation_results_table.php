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
        Schema::create('simulation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('experiment_id')->constrained('simulation_experiments')->onDelete('cascade');
            $table->json('resultats_etapes'); // Résultats par étape
            $table->json('donnees_collectees'); // Données collectées par l'élève
            $table->integer('temps_total'); // en secondes
            $table->integer('etapes_completees');
            $table->integer('score'); // Score sur 100
            $table->text('observations_eleve')->nullable();
            $table->text('commentaires_professeur')->nullable();
            $table->timestamp('date_debut');
            $table->timestamp('date_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_results');
    }
};
