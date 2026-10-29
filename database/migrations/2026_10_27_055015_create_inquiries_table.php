<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->foreignId('tour_package_id')->nullable()->constrained('tour_packages')->nullOnDelete();
            $table->string('package_name')->nullable();
            $table->integer('participants')->default(1);
            $table->string('fleet_type')->nullable();
            $table->unsignedBigInteger('estimated_price')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->string('source')->default('website');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
