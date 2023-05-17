<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('business_transaction', function (Blueprint $table) {
            $table->foreignId('business_id')->constrained('businesses');
            $table->foreignId('transaction_id')->constrained('transactions');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('business_transaction');
        Schema::enableForeignKeyConstraints();
    }
};
