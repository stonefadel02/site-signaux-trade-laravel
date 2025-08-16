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
        Schema::create('timeframes', function (Blueprint $table) {
            $table->string('Nom', 50)->primary(); // Assuming 'Nom' is the field for timeframe name
            $table->string('Description', 255)->nullable(); // Optional description field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeframes');
    }
};
