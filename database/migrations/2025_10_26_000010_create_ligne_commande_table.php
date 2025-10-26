<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('LigneCommande', function (Blueprint $table) {
            $table->increments('id_ligne_commande');
            $table->unsignedInteger('id_produit');
            $table->unsignedInteger('id_commande');
            $table->integer('quantite');
            $table->decimal('sousTotal', 8, 0);

            $table->foreign('id_commande')
                ->references('id_commande')->on('Commande')
                ->restrictOnDelete()->restrictOnUpdate();

            $table->foreign('id_produit')
                ->references('id_produit')->on('Produit')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('LigneCommande');
    }
};
