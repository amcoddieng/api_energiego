<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Commande', function (Blueprint $table) {
            $table->increments('id_commande');
            $table->unsignedInteger('id_paiement');
            $table->unsignedInteger('id_utilisateur');
            $table->dateTime('dateCommande');
            $table->string('statut', 254);
            $table->decimal('total', 8, 0);

            $table->foreign('id_utilisateur')
                ->references('id_utilisateur')->on('Client')
                ->restrictOnDelete()->restrictOnUpdate();

            $table->foreign('id_paiement')
                ->references('id_paiement')->on('Paiement')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('Commande');
    }
};
