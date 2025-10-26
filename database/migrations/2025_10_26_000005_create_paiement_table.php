<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Paiement', function (Blueprint $table) {
            $table->increments('id_paiement');
            $table->decimal('montant', 8, 0);
            $table->string('modePaiement', 254);
            $table->dateTime('datePaiement');
        });
    }
    public function down(): void {
        Schema::dropIfExists('Paiement');
    }
};
