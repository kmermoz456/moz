<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents_physiques', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('categorie'); // ex : "Recueil d'anciens sujets", "Fiche de révision"
            $table->enum('niveau', ['L1', 'L2', 'Tous'])->default('Tous');
            $table->unsignedInteger('prix'); // en FCFA
            $table->string('image')->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_physiques');
    }
};
