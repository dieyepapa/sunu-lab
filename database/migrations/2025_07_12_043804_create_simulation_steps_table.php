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
        Schema::create('simulation_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experiment_id')->constrained('simulation_experiments')->onDelete('cascade');
            $table->integer('ordre');
            $table->string('titre');
            $table->text('description');
            $table->text('instructions');
            $table->json('actions_possibles'); // Actions que l'élève peut effectuer
            $table->json('resultats_attendus'); // Résultats attendus
            $table->json('donnees_simulation'); // Données pour la simulation
            $table->boolean('obligatoire')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_steps');
    }
};
