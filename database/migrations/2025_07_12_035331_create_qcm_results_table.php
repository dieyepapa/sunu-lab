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
        Schema::create('qcm_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('qcm_questions')->onDelete('cascade');
            $table->string('reponse_eleve'); // 'A', 'B', 'C', ou 'D'
            $table->boolean('correcte');
            $table->integer('temps_reponse')->nullable(); // en secondes
            $table->timestamp('date_reponse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qcm_results');
    }
};
