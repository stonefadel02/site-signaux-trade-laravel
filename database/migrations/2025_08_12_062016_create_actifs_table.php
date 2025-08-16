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
        Schema::create('actifs', function (Blueprint $table) {
            $table->id();
            $table->string('TypeMarche', 100); // ex: Forex, Crypto, Stocks
            $table->foreign('TypeMarche')
                ->references('Nom')
                ->on('type_marches')
                ->onDelete('cascade');
            $table->string('Symbole', 50); // ex: EUR/USD, BTC/USD, XAU/USD
            $table->string('Nom', 100); // ex: Euro Dollar, Bitcoin Dollar, Gold Dollar
            $table->unique(['TypeMarche', 'Symbole']); // Ensure unique combination of TypeMarche and Symbole
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actifs');
    }
};
