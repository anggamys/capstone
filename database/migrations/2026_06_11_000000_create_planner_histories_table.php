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
        Schema::create('planner_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('guest_token')->nullable()->index();
            $table->json('categories')->nullable();
            $table->json('activities')->nullable();
            $table->foreignId('travel_type_id')->nullable()->constrained('travel_types')->onDelete('set null');
            $table->foreignId('transportation_id')->nullable()->constrained('transportations')->onDelete('set null');
            $table->json('visit_times')->nullable();
            $table->string('budget')->nullable();
            $table->string('access_level')->nullable();
            $table->string('crowd_level')->nullable();
            $table->json('recommendations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planner_histories');
    }
};
