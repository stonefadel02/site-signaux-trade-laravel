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
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('session_id')->references('id')->on('session_signals')->onDelete('cascade');
            $table->dateTime('DateHeureEmission'); // savoir quand le signal a été émis.
            $table->dateTime('DateHeureExpire'); // la validité du signal
            $table->time('DureeTrade');
            $table->foreignId('Actif')->constrained('actifs')->onDelete('cascade');
            $table->enum('Direction', ['BUY', 'SELL'])->default('BUY');
            // $table->string('Timeframe')->nullable(); desormais table pivot
            $table->decimal('PrixEntree', 15, 6); // Prix d'entrée du signal
            $table->decimal('TakeProfit', 15, 6)->nullable();
            $table->decimal('StopLoss', 15, 6)->nullable();
            $table->integer('Confiance')->nullable();
            $table->text('Commentaire')->nullable();
            // Additional fields for signal results
            $table->decimal('Pips', 10, 2)->nullable();
            $table->enum('Resultat', ['WIN', 'LOSE', 'PENDING', "BREAK-EVEN"])->default('PENDING');
            $table->decimal('PrixSortieReelle', 15, 6)->nullable();
            // $table->enum('Status', ['EN COURS', "EN ATTENTE", 'TERMINE', 'ANNULE'])->default('EN COURS');
            $table->softDeletes(); // For soft delete functionality
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
