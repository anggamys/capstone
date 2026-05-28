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
        Schema::create('destination_travel_type', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('destination_id')
                ->constrained('destinations')
                ->cascadeOnDelete();
                
            $table->foreignId('travel_type_id')
                ->constrained('travel_types')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_travel_type');
    }
};
