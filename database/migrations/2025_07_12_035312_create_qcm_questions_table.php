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
        Schema::create('qcm_questions', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('question');
            $table->json('options'); // ['A' => 'option1', 'B' => 'option2', ...]
            $table->string('bonne_reponse'); // 'A', 'B', 'C', ou 'D'
            $table->string('matiere'); // 'photosynthese', 'respiration', 'digestion', etc.
            $table->string('niveau'); // 'facile', 'moyen', 'difficile'
            $table->text('explication')->nullable(); // Explication de la réponse
            $table->foreignId('professeur_id')->constrained('users')->onDelete('cascade');
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qcm_questions');
    }
};
