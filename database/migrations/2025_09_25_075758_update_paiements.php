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
        Schema::table('paiements', function (Blueprint $table) {
            if (!Schema::hasColumn('paiements', 'gateway_payment_id')) {
                $table->string('gateway_payment_id')->nullable();
            }
            if (!Schema::hasColumn('paiements', 'switch_mode')) {
                $table->string('switch_mode')->nullable();
            }
            if (!Schema::hasColumn('paiements', 'plan_id')) {
                $table->foreignId('plan_id')->nullable()->references('id')->on('plans')->nullOnDelete()->cascadeOnUpdate();
            }


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            //
        });
    }
};
