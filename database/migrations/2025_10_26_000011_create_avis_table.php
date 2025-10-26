<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Avis', function (Blueprint $table) {
            $table->increments('id_avis');
            $table->unsignedInteger('id_produit');
            $table->unsignedInteger('id_utilisateur');
            $table->integer('note');
            $table->string('commentaire', 254);
            $table->dateTime('dateAvis');

            $table->foreign('id_produit')
                ->references('id_produit')->on('Produit')
                ->restrictOnDelete()->restrictOnUpdate();

            $table->foreign('id_utilisateur')
                ->references('id_utilisateur')->on('Client')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('Avis');
    }
};
