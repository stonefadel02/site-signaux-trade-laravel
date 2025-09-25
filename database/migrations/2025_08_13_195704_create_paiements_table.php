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
            $table->foreignId('souscription_id')->nullable()->references('id')->on('souscriptions')->onDelete('cascade');
            $table->foreignId('plan_id')->nullable()->references('id')->on('plans')->nullOnDelete()->cascadeOnUpdate();
            $table->decimal('Montant', 10, 4);
            $table->string('Devise');
            $table->string('ModeDePaiement');
            $table->dateTime('DateHeurePaiement');
            $table->enum('Status', ['PENDING', 'COMPLETED', 'FAILED'])->default('PENDING');
            $table->string('TransactionId')->nullable();
            $table->text('Details')->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->string('switch_mode')->nullable();

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
