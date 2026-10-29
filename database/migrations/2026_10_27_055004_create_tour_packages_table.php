<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('badge')->nullable();
            $table->string('destination_location')->nullable();
            $table->unsignedBigInteger('price_from')->default(0);
            $table->integer('duration_days')->default(1);
            $table->integer('duration_nights')->default(0);
            $table->integer('min_pax')->default(1);
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('includes')->nullable();
            $table->json('excludes')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
