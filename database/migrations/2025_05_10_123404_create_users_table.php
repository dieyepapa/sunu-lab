<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
   Schema::create('users', function (Blueprint $table) {
    $table->bigIncrements('idUser');
    $table->string('nom');
    $table->string('prenom');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('status', ['professeur', 'eleve', 'admin']);
    $table->timestamps();
});
}
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
