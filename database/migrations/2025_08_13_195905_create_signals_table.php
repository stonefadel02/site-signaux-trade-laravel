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
            $table->dateTime('DateHeureEmission');
            $table->dateTime('DateHeureExpire');
            $table->time('DureeTrade');
            $table->string('Actifs');
            $table->string('Timeframe')->nullable();
            $table->double('PrixEntree');
            $table->double('PrixSortieReelle')->nullable();
            $table->double('TakeProfit')->nullable();
            $table->double('StopLoss')->nullable();
            $table->enum('Direction', ['BUY', 'SELL'])->default('BUY');
            $table->enum('Resultat', ['WIN', 'LOSE', 'PENDING', "BREAK-EVEN"])->default('PENDING');
            $table->integer('Pips')->nullable();
            $table->integer('Confiance')->nullable();
            $table->text('Commentaire')->nullable();
            $table->enum('Status', ['EN COURS', "EN ATTENTE", 'TERMINE', 'ANNULE'])->default('EN COURS');

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
