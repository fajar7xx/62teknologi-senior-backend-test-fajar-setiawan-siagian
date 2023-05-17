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
            $table->string('name');
            $table->string('image_url');
            $table->boolean('is_closed')->default(false);
            $table->string('url')->nullable();
            $table->integer('review_count')->default(0);
            $table->float('rating', 2, 2)->default(0);
            $table->double('lattitude', 3, 15);
            $table->double('longtitude', 3, 15);
            $table->string('price');
            $table->string('phone', 20)->unique();
            $table->string('display_phone', 20)->unique();
            $table->double('distance', 10, 15);
            $table->timestamps();
            $table->softDeletes();


            // indexing
            $table->index('alias');
            $table->index('name');
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
