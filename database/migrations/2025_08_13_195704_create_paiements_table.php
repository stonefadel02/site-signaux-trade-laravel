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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('souscription_id')->references('id')->on('souscriptions')->onDelete('cascade');
            $table->decimal('Montant', 10, 4);
            $table->string('Devise');
            $table->string('ModeDePaiement');
            $table->dateTime('DateHeurePaiement');
            $table->enum('Status', ['PENDING', 'COMPLETED', 'FAILED'])->default('PENDING');
            $table->string('TransactionId')->nullable();
            $table->text('Details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
