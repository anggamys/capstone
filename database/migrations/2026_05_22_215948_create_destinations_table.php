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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('destination_category_id')
                ->constrained('destination_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('destination_subcategory_id')
                ->nullable()
                ->constrained('destination_subcategories')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->longText('description')->nullable();

            $table->text('address')->nullable();
            $table->string('district')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('google_maps_url')->nullable();

            $table->string('main_image')->nullable();

            $table->unsignedInteger('ticket_price')->default(0);

            $table->string('operational_hours')->nullable();

            $table->decimal('rating', 2, 1)->default(0);

            $table->enum('crowd_level', ['low', 'medium', 'high'])->default('medium');
            $table->enum('access_level', ['easy', 'medium', 'hard'])->default('medium');
            $table->enum('activity_level', ['relaxing', 'moderate', 'active'])->default('moderate');

            $table->json('generated_tags')->nullable();

            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
