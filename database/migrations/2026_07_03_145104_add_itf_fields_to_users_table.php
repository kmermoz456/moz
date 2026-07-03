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
    Schema::table('users', function (Blueprint $table) {
        $table->string('prenoms')->after('name');
        $table->string('telephone')->after('email'); // WhatsApp
        $table->enum('niveau', ['L1', 'L2'])->after('telephone');
        $table->enum('role', ['etudiant', 'admin'])->default('etudiant');
        $table->date('essai_fin')->nullable(); // fin du mois gratuit
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
