<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::firstOrCreate(['slug' => 'trekking'], ['name' => 'Trekking', 'status' => 'active']);
        Activity::firstOrCreate(['slug' => 'snorkeling'], ['name' => 'Snorkeling', 'status' => 'active']);
        Activity::firstOrCreate(['slug' => 'camping'], ['name' => 'Camping', 'status' => 'active']);
        Activity::firstOrCreate(['slug' => 'menikmati-sunrise'], ['name' => 'Menikmati Sunrise', 'status' => 'active']);
        Activity::firstOrCreate(['slug' => 'fotografi'], ['name' => 'Fotografi', 'status' => 'active']);
        Activity::firstOrCreate(['slug' => 'kuliner'], ['name' => 'Kuliner', 'status' => 'active']);
    }
}
