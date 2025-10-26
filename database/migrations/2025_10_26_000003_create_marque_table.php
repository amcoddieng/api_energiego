<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Marque', function (Blueprint $table) {
            $table->increments('id_marque');
            $table->string('nom', 254);
            $table->string('paysOrigine', 254);
        });
    }
    public function down(): void {
        Schema::dropIfExists('Marque');
    }
};
