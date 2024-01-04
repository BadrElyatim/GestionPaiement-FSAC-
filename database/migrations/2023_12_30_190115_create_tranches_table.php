<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tranches', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('numero');
            $table->decimal('montant', 10);
            $table->string('piece_recu');
            $table->boolean('valide');
            $table->string('numero_de_recu');
            $table->foreignId('etudiant_cne')->constrained('etudiants', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranches');
    }
};
