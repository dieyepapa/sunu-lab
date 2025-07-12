<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('simulations', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->text('description');
    $table->string('chapitre');
    $table->date('date');
    $table->enum('type_simulation', ['HTML5', 'UNITY', 'THREEJS']);
    $table->enum('contexte', ['classe', 'maison']);
    $table->string('lien_meet')->nullable();
    $table->boolean('notification_envoyee')->nullable();
    $table->foreignId('professeur_id')->constrained('professeurs');
    $table->foreignId('classe_id')->constrained('classes');
    $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('simulation');
    }
};
