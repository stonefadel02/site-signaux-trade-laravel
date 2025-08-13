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
        Schema::create('signal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("plan_id")->references("id")->on("plans")->onDelete("cascade");
            $table->foreignId("signal_id")->references("id")->on("signals")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signal_plans');
    }
};
