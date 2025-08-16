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
        Schema::create('signal_timeframes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('SignalId')
                ->constrained('signals')
                ->onDelete('cascade');
            $table->string('Timeframe', 50); // Assuming 'Timeframe' is the field for timeframe name
            $table->foreign('Timeframe')
                ->references('Nom')
                ->on('timeframes')
                ->onDelete('cascade');
            $table->unique(['SignalId', 'Timeframe'], 'signal_timeframes_unique'); // Ensure unique combination of SignalId and TimeframeId
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signal_timeframes');
    }
};
