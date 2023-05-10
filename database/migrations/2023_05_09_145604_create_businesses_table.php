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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->unique();
            $table->string('display_phone', 20)->unique();
            $table->float('distance', 10, 12);
            $table->string('image_url');
            $table->boolean('is_closed')->default(false);
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->float('price', 10, 2)->default(0);
            $table->float('rating', 2, 2)->default(0);
            $table->integer('review_count')->default(0);
            $table->json('transactions')->nullable();
            $table->string('url')->nullable();
            $table->integer('total');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('businesses');
        Schema::enableForeignKeyConstraints();
    }
};
