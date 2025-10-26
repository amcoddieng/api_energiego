<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Promotion', function (Blueprint $table) {
            $table->increments('id_promotion');
            $table->string('codePromo', 254);
            $table->decimal('reduction', 8, 0);
            $table->dateTime('dateDebut');
            $table->dateTime('dateFin');
        });
    }
    public function down(): void {
        Schema::dropIfExists('Promotion');
    }
};
