<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::firstOrCreate(['slug' => 'toilet-umum'], ['name' => 'Toilet Umum', 'status' => 'active']);
        Facility::firstOrCreate(['slug' => 'area-parkir'], ['name' => 'Area Parkir', 'status' => 'active']);
        Facility::firstOrCreate(['slug' => 'mushola'], ['name' => 'Mushola', 'status' => 'active']);
        Facility::firstOrCreate(['slug' => 'gazebo'], ['name' => 'Gazebo', 'status' => 'active']);
        Facility::firstOrCreate(['slug' => 'warung-makan'], ['name' => 'Warung Makan', 'status' => 'active']);
        Facility::firstOrCreate(['slug' => 'pusat-informasi'], ['name' => 'Pusat Informasi', 'status' => 'active']);
    }
}
