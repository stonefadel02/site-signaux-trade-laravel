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
        Schema::create('access_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("plan_id")->references("id")->on("plans")->onDelete("cascade");
            $table->string('Code')->unique();
            $table->integer('DureeEnJours');
            $table->integer('Compteur')->default(0);
            $table->integer('CompteurMax')->default(1);
            $table->date('ExpireLe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_codes');
    }
};
