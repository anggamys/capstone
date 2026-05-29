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

        // tambahan subkategori untuk kategori Alam (destinasi Banyuwangi)
        if ($alam) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'kawah'],
                ['destination_category_id' => $alam->id, 'name' => 'Kawah', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'savana'],
                ['destination_category_id' => $alam->id, 'name' => 'Savana', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'danau'],
                ['destination_category_id' => $alam->id, 'name' => 'Danau', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'taman-nasional'],
                ['destination_category_id' => $alam->id, 'name' => 'Taman Nasional', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'mangrove'],
                ['destination_category_id' => $alam->id, 'name' => 'Mangrove', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'taman-bunga'],
                ['destination_category_id' => $alam->id, 'name' => 'Taman Bunga', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'satwa'],
                ['destination_category_id' => $alam->id, 'name' => 'Satwa', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pemandangan'],
                ['destination_category_id' => $alam->id, 'name' => 'Pemandangan', 'status' => 'active']
            );
        }

        if ($budaya) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'tari-tradisional'],
                ['destination_category_id' => $budaya->id, 'name' => 'Tari Tradisional', 'status' => 'active']
            );
        }

        // tambahan subkategori untuk kategori Budaya
        if ($budaya) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'upacara-adat'],
                ['destination_category_id' => $budaya->id, 'name' => 'Upacara Adat', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'kerajinan'],
                ['destination_category_id' => $budaya->id, 'name' => 'Kerajinan', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'kuliner-tradisional'],
                ['destination_category_id' => $budaya->id, 'name' => 'Kuliner Tradisional', 'status' => 'active']
            );
        }

        if ($pantai) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pantai-pasir-putih'],
                ['destination_category_id' => $pantai->id, 'name' => 'Pantai Pasir Putih', 'status' => 'active']
            );
        }

        // tambahan subkategori untuk kategori Pantai
        if ($pantai) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pantai-berpasir-hitam'],
                ['destination_category_id' => $pantai->id, 'name' => 'Pantai Berpasir Hitam', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'pantai-terumbu-karang'],
                ['destination_category_id' => $pantai->id, 'name' => 'Pantai Terumbu Karang', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'teluk'],
                ['destination_category_id' => $pantai->id, 'name' => 'Teluk', 'status' => 'active']
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

        // tambahan subkategori untuk kategori Hutan
        if ($hutan) {
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'hutan-hujan'],
                ['destination_category_id' => $hutan->id, 'name' => 'Hutan Hujan', 'status' => 'active']
            );
            DestinationSubcategory::firstOrCreate(
                ['slug' => 'cagar-alam'],
                ['destination_category_id' => $hutan->id, 'name' => 'Cagar Alam', 'status' => 'active']
            );
        }

    }
}
