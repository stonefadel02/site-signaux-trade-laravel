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
        Schema::create('type_marches', function (Blueprint $table) {
            $table->string('Nom', 100)->primary(); // Assuming 'name' is the field for type of market
            $table->string('Description', 255)->nullable(); // Optional description field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_marches');
    }
};
