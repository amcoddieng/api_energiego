<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Produit', function (Blueprint $table) {
            $table->increments('id_produit');
            $table->unsignedInteger('id_categorie');
            $table->unsignedInteger('id_promotion')->nullable();
            $table->unsignedInteger('id_marque');
            $table->string('nom', 254);
            $table->string('description', 254);
            $table->decimal('prix', 8, 0);
            $table->integer('stock');
            $table->string('image', 254);

            $table->foreign('id_categorie')
                ->references('id_categorie')->on('Categorie')
                ->restrictOnDelete()->restrictOnUpdate();

            $table->foreign('id_marque')
                ->references('id_marque')->on('Marque')
                ->restrictOnDelete()->restrictOnUpdate();

            $table->foreign('id_promotion')
                ->references('id_promotion')->on('Promotion')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('Produit');
    }
};
