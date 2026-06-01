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

        $this->call([
            DestinationCategorySeeder::class,
            DestinationSubcategorySeeder::class,
            ActivitySeeder::class,
            FacilitySeeder::class,
            TravelTypeSeeder::class,
            VisitTimeSeeder::class,
            TransportationSeeder::class,
            DestinationSeeder::class,
            CategoryBlogSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
