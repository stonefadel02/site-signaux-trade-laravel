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
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("plan_id")->references("id")->on("plans")->onDelete("cascade");
            $table->decimal('Montant', 10, 4);
            $table->string('Devise');
            $table->dateTime('DateHeureDebut');
            $table->dateTime('DateHeureFin');
            $table->enum("Status", ['ACTIVE', 'INACTIVE', 'EXPIRE'])->default('ACTIVE');
            $table->string('AccessCode')->nullable();
            $table->boolean('isPopular')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('souscriptions');
    }
};
