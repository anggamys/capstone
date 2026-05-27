<?php

namespace Database\Seeders;

use App\Models\DestinationCategory;
use Illuminate\Database\Seeder;

class DestinationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DestinationCategory::firstOrCreate(['slug' => 'alam'], ['name' => 'Alam', 'status' => 'active']);
        DestinationCategory::firstOrCreate(['slug' => 'budaya'], ['name' => 'Budaya', 'status' => 'active']);
        DestinationCategory::firstOrCreate(['slug' => 'pantai'], ['name' => 'Pantai', 'status' => 'active']);
        DestinationCategory::firstOrCreate(['slug' => 'hutan'], ['name' => 'Hutan', 'status' => 'active']);
    }
}
