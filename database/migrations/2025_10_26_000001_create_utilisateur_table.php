<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Utilisateur', function (Blueprint $table) {
            $table->increments('id_utilisateur');
            $table->string('nom', 254);
            $table->string('prenom', 254);
            $table->string('email', 254);
            $table->string('motDePasse', 254);
            $table->string('role', 254);
            $table->dateTime('dateInscription')->default(now());
        });
    }
    public function down(): void {
        Schema::dropIfExists('Utilisateur');
    }
};
