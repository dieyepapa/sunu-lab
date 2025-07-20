<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Supprimer la mauvaise contrainte de clé étrangère si elle existe
        Schema::table('videos', function (Blueprint $table) {
            // Pour MySQL, le nom de la contrainte est souvent videos_user_id_foreign
            $table->dropForeign(['user_id']);
        });

        // Ajouter la bonne contrainte vers users.idUser
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('user_id')->references('idUser')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Supprimer la contrainte vers users.idUser
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        // Remettre la contrainte par défaut (vers users.id)
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
