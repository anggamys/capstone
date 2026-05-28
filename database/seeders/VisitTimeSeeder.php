<?php

namespace Database\Seeders;

use App\Models\VisitTime;
use Illuminate\Database\Seeder;

class VisitTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisitTime::firstOrCreate(['slug' => 'pagi-hari'], ['name' => 'Pagi Hari', 'status' => 'active']);
        VisitTime::firstOrCreate(['slug' => 'siang-hari'], ['name' => 'Siang Hari', 'status' => 'active']);
        VisitTime::firstOrCreate(['slug' => 'sore-hari'], ['name' => 'Sore Hari', 'status' => 'active']);
        VisitTime::firstOrCreate(['slug' => 'malam-hari'], ['name' => 'Malam Hari', 'status' => 'active']);
    }
}
