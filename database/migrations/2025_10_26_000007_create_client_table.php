<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Client', function (Blueprint $table) {
            $table->unsignedInteger('id_utilisateur')->primary();
            $table->string('adresse', 254);
            $table->string('telephone', 254);

            $table->foreign('id_utilisateur')
                ->references('id_utilisateur')->on('Utilisateur')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('Client');
    }
};
