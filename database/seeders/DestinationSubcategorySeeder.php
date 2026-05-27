<?php

namespace Database\Seeders;

use App\Models\DestinationCategory;
use App\Models\DestinationSubcategory;
use Illuminate\Database\Seeder;

class DestinationSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alam = DestinationCategory::where('slug', 'alam')->first();
        $budaya = DestinationCategory::where('slug', 'budaya')->first();
        $pantai = DestinationCategory::where('slug', 'pantai')->first();
        $hutan = DestinationCategory::where('slug', 'hutan')->first();

        if ($alam) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'gunung'],
                ['destination_category_id' => $alam->id, 'name' => 'Gunung', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'air-terjun'],
                ['destination_category_id' => $alam->id, 'name' => 'Air Terjun', 'status' => 'active']
            );
        }

        if ($budaya) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'tari-tradisional'],
                ['destination_category_id' => $budaya->id, 'name' => 'Tari Tradisional', 'status' => 'active']
            );
        }

        if ($pantai) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pantai-pasir-putih'],
                ['destination_category_id' => $pantai->id, 'name' => 'Pantai Pasir Putih', 'status' => 'active']
            );
        }

        if ($hutan) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'hutan-bakau'],
                ['destination_category_id' => $hutan->id, 'name' => 'Hutan Bakau', 'status' => 'active']
            );
        }

        if ($hutan) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'hutan-adat'],
                ['destination_category_id' => $hutan->id, 'name' => 'Hutan Adat', 'status' => 'active']
            );
        }

        if ($alam) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'kawah'],
                ['destination_category_id' => $alam->id, 'name' => 'Kawah', 'status' => 'active']
            );
        }

        if ($pantai) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pantai-berpasir-hitam'],
                ['destination_category_id' => $pantai->id, 'name' => 'Pantai Berpasir Hitam', 'status' => 'active']
            );
        }
    }
}
