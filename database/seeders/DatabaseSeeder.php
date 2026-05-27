<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        Admin::firstOrCreate(
            ['email' => 'admin@laras.com'],
            [
                'name' => 'Laras Admin',
                'password' => Hash::make('laras123'),
                'role' => 'superadmin',
                'status' => 'active',
            ]
        );

        $alam = \App\Models\DestinationCategory::firstOrCreate(['slug' => 'alam'], ['name' => 'Alam', 'status' => 'active']);
        $budaya = \App\Models\DestinationCategory::firstOrCreate(['slug' => 'budaya'], ['name' => 'Budaya', 'status' => 'active']);
        $pantai = \App\Models\DestinationCategory::firstOrCreate(['slug' => 'pantai'], ['name' => 'Pantai', 'status' => 'active']);
        $hutan = \App\Models\DestinationCategory::firstOrCreate(['slug' => 'hutan'], ['name' => 'Hutan', 'status' => 'active']);

        \App\Models\DestinationSubcategory::firstOrCreate(
            ['slug' => 'gunung'],
            ['destination_category_id' => $alam->id, 'name' => 'Gunung', 'status' => 'active']
        );
        \App\Models\DestinationSubcategory::firstOrCreate(
            ['slug' => 'air-terjun'],
            ['destination_category_id' => $alam->id, 'name' => 'Air Terjun', 'status' => 'active']
        );
        \App\Models\DestinationSubcategory::firstOrCreate(
            ['slug' => 'tari-tradisional'],
            ['destination_category_id' => $budaya->id, 'name' => 'Tari Tradisional', 'status' => 'active']
        );
        \App\Models\DestinationSubcategory::firstOrCreate(
            ['slug' => 'pantai-pasir-putih'],
            ['destination_category_id' => $pantai->id, 'name' => 'Pantai Pasir Putih', 'status' => 'active']
        );
        \App\Models\DestinationSubcategory::firstOrCreate(
            ['slug' => 'hutan-bakau'],
            ['destination_category_id' => $hutan->id, 'name' => 'Hutan Bakau', 'status' => 'active']
        );
    }
}
