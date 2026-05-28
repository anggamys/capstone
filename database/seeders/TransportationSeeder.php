<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportation::firstOrCreate(['slug' => 'sepeda-motor'], ['name' => 'Sepeda Motor', 'status' => 'active']);
        Transportation::firstOrCreate(['slug' => 'mobil'], ['name' => 'Mobil', 'status' => 'active']);
        Transportation::firstOrCreate(['slug' => 'bus-pariwisata'], ['name' => 'Bus Pariwisata', 'status' => 'active']);
        Transportation::firstOrCreate(['slug' => 'jalan-kaki'], ['name' => 'Jalan Kaki', 'status' => 'active']);
    }
}
