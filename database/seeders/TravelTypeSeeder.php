<?php

namespace Database\Seeders;

use App\Models\TravelType;
use Illuminate\Database\Seeder;

class TravelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TravelType::firstOrCreate(['slug' => 'keluarga'], ['name' => 'Keluarga', 'status' => 'active']);
        TravelType::firstOrCreate(['slug' => 'solo-traveler'], ['name' => 'Solo Traveler', 'status' => 'active']);
        TravelType::firstOrCreate(['slug' => 'petualang'], ['name' => 'Petualang', 'status' => 'active']);
        TravelType::firstOrCreate(['slug' => 'rombongan'], ['name' => 'Rombongan', 'status' => 'active']);
        TravelType::firstOrCreate(['slug' => 'pasangan'], ['name' => 'Pasangan', 'status' => 'active']);
    }
}
