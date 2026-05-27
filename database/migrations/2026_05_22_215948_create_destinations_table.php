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
            $table->string('visit_duration_hours')->nullable();

            $table->decimal('rating', 2, 1)->default(0);

            $table->enum('access_level', ['Mudah', 'Sedang', 'Sulit'])->default('Sedang');

            $table->text('generated_tags')->nullable();

            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

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
