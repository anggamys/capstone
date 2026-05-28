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
        Schema::create('destination_visit_time', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('destination_id')
                ->constrained('destinations')
                ->cascadeOnDelete();
                
            $table->foreignId('visit_time_id')
                ->constrained('visit_times')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_visit_time');
    }
};
