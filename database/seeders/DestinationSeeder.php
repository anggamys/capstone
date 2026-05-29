<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\DestinationSubcategory;
use App\Models\Activity;
use App\Models\Facility;
use App\Models\TravelType;
use App\Models\VisitTime;
use App\Models\Transportation;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alam = DestinationCategory::where('slug', 'alam')->first();
        $pantai = DestinationCategory::where('slug', 'pantai')->first();

        $kawahSub = DestinationSubcategory::where('slug', 'kawah')->first();
        $pasirPutihSub = DestinationSubcategory::where('slug', 'pantai-pasir-putih')->first();

        // 1. Kawah Ijen
        $ijen = Destination::firstOrCreate(
            ['slug' => 'kawah-ijen'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $kawahSub ? $kawahSub->id : null,
                'name' => 'Kawah Ijen',
                'description' => 'Kawah Ijen adalah sebuah danau kawah yang bersifat asam yang berada di puncak Gunung Ijen dengan tinggi kawah 2.368 meter di atas permukaan laut. Terkenal dengan fenomena api biru (blue fire) yang hanya ada dua di dunia.',
                'address' => 'Paltuding, Licin, Kabupaten Banyuwangi, Jawa Timur',
                'district' => 'Licin',
                'latitude' => -8.0581,
                'longitude' => 114.2418,
                'google_maps_url' => 'https://maps.app.goo.gl/kawah-ijen',
                'main_image' => null,
                'ticket_price' => 15000,
                'operational_hours' => '02:00 - 12:00 WIB',
                'visit_duration_hours' => '4',
                'rating' => 4.8,
                'access_level' => 'Sedang',
                'generated_tags' => ['Alam', 'Gunung', 'Kawah', 'BlueFire'],
                'status' => 'active',
            ]
        );

        // Sync pivot tables for Ijen
        $activities = Activity::limit(2)->pluck('id');
        $facilities = Facility::limit(3)->pluck('id');
        $travelTypes = TravelType::limit(3)->pluck('id');
        $visitTimes = VisitTime::limit(2)->pluck('id');
        $transportations = Transportation::limit(2)->pluck('id');

        $ijen->activities()->sync($activities);
        $ijen->facilities()->sync($facilities);
        $ijen->travelTypes()->sync($travelTypes);
        $ijen->visitTimes()->sync($visitTimes);
        $ijen->transportations()->sync($transportations);

        // 2. Pantai Pulau Merah
        $pulauMerah = Destination::firstOrCreate(
            ['slug' => 'pantai-pulau-merah'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Pantai Pulau Merah',
                'description' => 'Pantai Pulau Merah atau Pulo Merah adalah sebuah pantai dan objek wisata di Kecamatan Pesanggaran, Banyuwangi. Pantai ini dikenal karena sebuah bukit kecil bertanah merah yang terletak di dekat pantai.',
                'address' => 'Sumberagung, Pesanggaran, Kabupaten Banyuwangi, Jawa Timur',
                'district' => 'Pesanggaran',
                'latitude' => -8.6012,
                'longitude' => 114.0245,
                'google_maps_url' => 'https://maps.app.goo.gl/pulau-merah',
                'main_image' => null,
                'ticket_price' => 10000,
                'operational_hours' => '07:00 - 18:00 WIB',
                'visit_duration_hours' => '3',
                'rating' => 4.6,
                'access_level' => 'Mudah',
                'generated_tags' => ['Pantai', 'PasirPutih', 'Sunset', 'Surfing'],
                'status' => 'active',
            ]
        );

        $pulauMerah->activities()->sync($activities);
        $pulauMerah->facilities()->sync($facilities);
        $pulauMerah->travelTypes()->sync($travelTypes);
        $pulauMerah->visitTimes()->sync($visitTimes);
        $pulauMerah->transportations()->sync($transportations);
    }
}
