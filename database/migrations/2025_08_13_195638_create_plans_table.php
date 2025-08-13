<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            // $table->string('Code');
            $table->string('Titre');
            $table->decimal('Prix', 10, 4);
            $table->string('Devise');
            $table->integer('DureeEnJours');
            $table->integer('NombreDeSignaux');
            $table->text('AutresAvantages')->default('[]')->nullable();
            $table->enum('Visibilite', ['PUBLIQUE', 'PRIVEE'])->default('PUBLIQUE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
