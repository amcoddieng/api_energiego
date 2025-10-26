<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('Categorie', function (Blueprint $table) {
            $table->increments('id_categorie');
            $table->string('nom', 254);
            $table->string('description', 254);
        });
    }
    public function down(): void {
        Schema::dropIfExists('Categorie');
    }
};
