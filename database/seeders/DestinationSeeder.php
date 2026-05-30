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
        $hutan = DestinationCategory::where('slug', 'hutan')->first();

        $kawahSub = DestinationSubcategory::where('slug', 'kawah')->first();
        $gunungSub = DestinationSubcategory::where('slug', 'gunung')->first();
        $airTerjunSub = DestinationSubcategory::where('slug', 'air-terjun')->first();
        $tamanNasionalSub = DestinationSubcategory::where('slug', 'taman-nasional')->first();
        $mangroveSub = DestinationSubcategory::where('slug', 'mangrove')->first();
        $tamanBungaSub = DestinationSubcategory::where('slug', 'taman-bunga')->first();
        $satwaSub = DestinationSubcategory::where('slug', 'satwa')->first();
        $pemandanganSub = DestinationSubcategory::where('slug', 'pemandangan')->first();
        $pasirPutihSub = DestinationSubcategory::where('slug', 'pantai-pasir-putih')->first();

        // 1. Kawah Ijen
        $ijen = Destination::firstOrCreate(
            ['slug' => 'kawah-ijen'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $kawahSub ? $kawahSub->id : null,
                'name' => 'Kawah Ijen',
                'description' => 'Kawah Ijen adalah sebuah danau kawah yang bersifat asam dan berada di puncak Gunung Ijen pada ketinggian sekitar 2.368 meter di atas permukaan laut. Lokasi ini menjadi salah satu ikon wisata alam Banyuwangi karena menawarkan panorama kawah yang dramatis, udara pegunungan yang sejuk, serta fenomena api biru (blue fire) yang sangat langka dan hanya dapat ditemukan di beberapa tempat di dunia. Perjalanan menuju kawasan ini juga memberikan pengalaman pendakian yang menarik bagi wisatawan.',
                'address' => 'Paltuding, Licin, Kabupaten Banyuwangi, Jawa Timur',
                'district' => 'Licin',
                'google_maps_url' => 'https://maps.app.goo.gl/EHib4qdMK5KRZhK17',
                'main_image' => 'images/kawah-ijen.png',
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
                'description' => 'Pantai Pulau Merah atau Pulo Merah adalah salah satu destinasi unggulan di Kecamatan Pesanggaran, Banyuwangi, yang terkenal dengan garis pantainya yang panjang, pasir yang lembut, dan sebuah bukit kecil bertanah merah yang menjadi ciri khas utamanya. Saat air laut surut, wisatawan dapat berjalan lebih leluasa di tepi pantai sambil menikmati suasana pesisir yang tenang. Tempat ini juga populer untuk menikmati matahari terbenam dan aktivitas wisata bahari lainnya.',
                'address' => 'Sumberagung, Pesanggaran, Kabupaten Banyuwangi, Jawa Timur',
                'district' => 'Pesanggaran',
                'google_maps_url' => 'https://maps.app.goo.gl/https://maps.app.goo.gl/GvKfFuuq6Po4MBfr7',
                'main_image' => 'images/pulau-merah.png',
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

        // 3. Teluk Hijau
        $telukHijau = Destination::firstOrCreate(
            ['slug' => 'teluk-hijau'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Teluk Hijau',
                'description' => 'Teluk Hijau adalah pantai tersembunyi yang dikenal karena hamparan pasir putihnya yang bersih, air laut yang jernih, dan gradasi warna hijau tosca yang menakjubkan. Suasana di kawasan ini masih sangat alami sehingga cocok bagi wisatawan yang ingin menikmati ketenangan, keindahan alam, dan udara pantai yang segar. Pemandangan bukit, ombak yang relatif tenang, serta panorama laut yang eksotis menjadikan Teluk Hijau sebagai salah satu lokasi favorit untuk berfoto dan bersantai.',
                'address' => 'Wongsorejo, Banyuwangi, Jawa Timur',
                'district' => 'Wongsorejo',
                'google_maps_url' => 'https://maps.app.goo.gl/TMngrBCsHShxR24k9',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 12000,
                'operational_hours' => '07:00 - 17:00 WIB',
                'visit_duration_hours' => '3',
                'rating' => 4.7,
                'access_level' => 'Mudah',
                'generated_tags' => ['Pantai', 'PasirPutih', 'LautJernih'],
                'status' => 'active',
            ]
        );

        $telukHijau->activities()->sync($activities);
        $telukHijau->facilities()->sync($facilities);
        $telukHijau->travelTypes()->sync($travelTypes);
        $telukHijau->visitTimes()->sync($visitTimes);
        $telukHijau->transportations()->sync($transportations);

        // 4. Pantai G-Land
        $gland = Destination::firstOrCreate(
            ['slug' => 'pantai-gland'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Pantai G-Land',
                'description' => 'Pantai G-Land adalah surga bagi para peselancar karena memiliki ombak yang besar, konsisten, dan menantang sepanjang tahun. Pantai ini sudah lama dikenal sebagai salah satu spot surfing terbaik di Indonesia bahkan dunia, sehingga sering menjadi tujuan peselancar profesional. Selain olahraga selancar, pengunjung juga dapat menikmati suasana pantai yang masih alami, udara laut yang segar, dan pemandangan alam sekitar yang memukau.',
                'address' => 'Plengkung, Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/tARmJjVeTVSMTWru8',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 25000,
                'operational_hours' => '06:00 - 18:00 WIB',
                'visit_duration_hours' => '4',
                'rating' => 4.9,
                'access_level' => 'Sulit',
                'generated_tags' => ['Pantai', 'Surfing', 'Ombak'],
                'status' => 'active',
            ]
        );

        $gland->activities()->sync($activities);
        $gland->facilities()->sync($facilities);
        $gland->travelTypes()->sync($travelTypes);
        $gland->visitTimes()->sync($visitTimes);
        $gland->transportations()->sync($transportations);

        // 5. Air Terjun Jagir
        $jagir = Destination::firstOrCreate(
            ['slug' => 'air-terjun-jagir'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $airTerjunSub ? $airTerjunSub->id : null,
                'name' => 'Air Terjun Jagir',
                'description' => 'Air Terjun Jagir adalah air terjun indah dengan ketinggian sekitar 15 meter yang dikelilingi vegetasi hijau dan suasana alam yang menyejukkan. Aliran airnya yang bertingkat memberikan panorama yang menarik untuk dinikmati langsung maupun diabadikan dalam foto. Lokasi ini cocok untuk wisata keluarga maupun pecinta alam yang ingin merasakan kesegaran air pegunungan dan ketenangan suasana pedesaan.',
                'address' => 'Jagir, Songgon, Banyuwangi, Jawa Timur',
                'district' => 'Songgon',
                'google_maps_url' => 'https://maps.app.goo.gl/kuMrDGFeRzcHv7tE8',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 5000,
                'operational_hours' => '08:00 - 16:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.5,
                'access_level' => 'Mudah',
                'generated_tags' => ['AirTerjun', 'Alam', 'Hiking'],
                'status' => 'active',
            ]
        );

        $jagir->activities()->sync($activities);
        $jagir->facilities()->sync($facilities);
        $jagir->travelTypes()->sync($travelTypes);
        $jagir->visitTimes()->sync($visitTimes);
        $jagir->transportations()->sync($transportations);

        // 6. Taman Nasional Meru Betiri
        $meruBetiri = Destination::firstOrCreate(
            ['slug' => 'taman-nasional-meru-betiri'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $tamanNasionalSub ? $tamanNasionalSub->id : null,
                'name' => 'Taman Nasional Meru Betiri',
                'description' => 'Taman Nasional Meru Betiri adalah kawasan konservasi alam yang memiliki peran penting dalam menjaga kelestarian flora dan fauna langka di Banyuwangi. Wilayah ini menawarkan bentang alam yang lengkap, mulai dari hutan tropis, pantai, hingga habitat satwa liar yang dilindungi. Selain sebagai pusat konservasi, tempat ini juga menarik untuk kegiatan ekowisata, penelitian, dan edukasi lingkungan bagi para pengunjung.',
                'address' => 'Pesanggaran, Banyuwangi, Jawa Timur',
                'district' => 'Pesanggaran',
                'google_maps_url' => 'https://maps.app.goo.gl/meru-betiri',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 20000,
                'operational_hours' => '08:00 - 17:00 WIB',
                'visit_duration_hours' => '5',
                'rating' => 4.6,
                'access_level' => 'Sedang',
                'generated_tags' => ['TamanNasional', 'Alam', 'Konservasi'],
                'status' => 'active',
            ]
        );

        $meruBetiri->activities()->sync($activities);
        $meruBetiri->facilities()->sync($facilities);
        $meruBetiri->travelTypes()->sync($travelTypes);
        $meruBetiri->visitTimes()->sync($visitTimes);
        $meruBetiri->transportations()->sync($transportations);

        // 7. Pantai Boom
        $boom = Destination::firstOrCreate(
            ['slug' => 'pantai-boom'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Pantai Boom',
                'description' => 'Pantai Boom adalah pantai yang memiliki nilai sejarah dan daya tarik wisata yang cukup kuat, termasuk cerita masa Perang Dunia II yang masih menarik untuk dipelajari. Saat ini kawasan ini berkembang menjadi ruang publik yang nyaman dengan pemandangan laut yang indah dan suasana sunset yang mempesona. Pantai Boom juga sering menjadi tempat rekreasi sore hari bagi warga lokal maupun wisatawan.',
                'address' => 'Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/boom',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 0,
                'operational_hours' => '06:00 - 18:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.4,
                'access_level' => 'Mudah',
                'generated_tags' => ['Pantai', 'Sejarah', 'Sunset'],
                'status' => 'active',
            ]
        );

        $boom->activities()->sync($activities);
        $boom->facilities()->sync($facilities);
        $boom->travelTypes()->sync($travelTypes);
        $boom->visitTimes()->sync($visitTimes);
        $boom->transportations()->sync($transportations);

        // 8. Gunung Raung
        $raung = Destination::firstOrCreate(
            ['slug' => 'gunung-raung'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $gunungSub ? $gunungSub->id : null,
                'name' => 'Gunung Raung',
                'description' => 'Gunung Raung adalah gunung berapi aktif dengan ketinggian sekitar 3.332 meter yang menawarkan tantangan pendakian sekaligus pemandangan alam yang spektakuler. Kawasan ini terkenal dengan medan yang berat, jalur pendakian yang menantang, dan panorama pegunungan yang luar biasa indah dari berbagai titik ketinggian. Bagi pecinta petualangan, Gunung Raung menjadi salah satu destinasi yang penuh pengalaman dan kesan mendalam.',
                'address' => 'Sumbersari, Jember, Jawa Timur',
                'district' => 'Sumbersari',
                'google_maps_url' => 'https://maps.app.goo.gl/raung',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 0,
                'operational_hours' => '06:00 - 14:00 WIB',
                'visit_duration_hours' => '6',
                'rating' => 4.7,
                'access_level' => 'Sulit',
                'generated_tags' => ['Gunung', 'Hiking', 'Pemandangan'],
                'status' => 'active',
            ]
        );

        $raung->activities()->sync($activities);
        $raung->facilities()->sync($facilities);
        $raung->travelTypes()->sync($travelTypes);
        $raung->visitTimes()->sync($visitTimes);
        $raung->transportations()->sync($transportations);

        // 9. Hutan Mangrove Ojek
        $ojek = Destination::firstOrCreate(
            ['slug' => 'hutan-mangrove-ojek'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $mangroveSub ? $mangroveSub->id : null,
                'name' => 'Hutan Mangrove Ojek',
                'description' => 'Hutan Mangrove Ojek adalah kawasan ekosistem mangrove yang menarik untuk dijelajahi dengan perahu maupun berjalan kaki di jalur yang telah disediakan. Area ini menyajikan suasana teduh dengan rimbunan mangrove yang berfungsi penting sebagai penahan abrasi dan habitat berbagai biota pesisir. Selain memberi pengalaman wisata alam, lokasi ini juga cocok sebagai sarana edukasi mengenai pentingnya menjaga kelestarian ekosistem pantai.',
                'address' => 'Ojek, Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/ojek',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 15000,
                'operational_hours' => '07:00 - 16:00 WIB',
                'visit_duration_hours' => '3',
                'rating' => 4.5,
                'access_level' => 'Mudah',
                'generated_tags' => ['Mangrove', 'Ekosistem', 'Alam'],
                'status' => 'active',
            ]
        );

        $ojek->activities()->sync($activities);
        $ojek->facilities()->sync($facilities);
        $ojek->travelTypes()->sync($travelTypes);
        $ojek->visitTimes()->sync($visitTimes);
        $ojek->transportations()->sync($transportations);

        // 10. Pantai Watu Dodol
        $watuDodol = Destination::firstOrCreate(
            ['slug' => 'pantai-watu-dodol'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Pantai Watu Dodol',
                'description' => 'Pantai Watu Dodol adalah pantai yang memiliki batu-batu besar sebagai ciri khas dan landmark alami yang sangat menarik untuk fotografi. Keunikan formasi batunya membuat kawasan ini mudah dikenali dan memberi karakter tersendiri dibanding pantai lain di Banyuwangi. Pengunjung dapat menikmati pemandangan laut, suasana pesisir yang santai, serta spot foto yang estetis di sekitar bebatuan besar tersebut.',
                'address' => 'Watu Dodol, Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/watu-dodol',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 10000,
                'operational_hours' => '06:00 - 18:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.5,
                'access_level' => 'Mudah',
                'generated_tags' => ['Pantai', 'Batu', 'Fotografi'],
                'status' => 'active',
            ]
        );

        $watuDodol->activities()->sync($activities);
        $watuDodol->facilities()->sync($facilities);
        $watuDodol->travelTypes()->sync($travelTypes);
        $watuDodol->visitTimes()->sync($visitTimes);
        $watuDodol->transportations()->sync($transportations);

        // 11. Curug Kembar
        $curugKembar = Destination::firstOrCreate(
            ['slug' => 'curug-kembar'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $airTerjunSub ? $airTerjunSub->id : null,
                'name' => 'Curug Kembar',
                'description' => 'Curug Kembar adalah dua air terjun yang berdampingan dan menghadirkan pemandangan alam yang asri serta menenangkan. Keunikan utama tempat ini terletak pada bentuk air terjunnya yang seolah berpasangan, sehingga memberi daya tarik visual yang berbeda dari air terjun lainnya. Lingkungan sekitar yang hijau dan segar menjadikannya destinasi yang cocok untuk wisata alam, relaksasi, dan fotografi.',
                'address' => 'Curug Kembar, Songgon, Banyuwangi, Jawa Timur',
                'district' => 'Songgon',
                'google_maps_url' => 'https://maps.app.goo.gl/curug-kembar',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 7000,
                'operational_hours' => '08:00 - 16:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.6,
                'access_level' => 'Sedang',
                'generated_tags' => ['AirTerjun', 'Alam', 'Foto'],
                'status' => 'active',
            ]
        );

        $curugKembar->activities()->sync($activities);
        $curugKembar->facilities()->sync($facilities);
        $curugKembar->travelTypes()->sync($travelTypes);
        $curugKembar->visitTimes()->sync($visitTimes);
        $curugKembar->transportations()->sync($transportations);

        // 12. Taman Bunga Celosia
        $celosia = Destination::firstOrCreate(
            ['slug' => 'taman-bunga-celosia'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $tamanBungaSub ? $tamanBungaSub->id : null,
                'name' => 'Taman Bunga Celosia',
                'description' => 'Taman Bunga Celosia adalah taman bunga indah yang dipenuhi berbagai varietas celosia berwarna-warni sehingga menciptakan suasana cerah dan menyenangkan. Area ini sangat cocok untuk wisata keluarga, bersantai, dan berburu foto karena tampilan taman yang tertata rapi dan menarik. Selain keindahan visualnya, tempat ini juga menghadirkan suasana sejuk dan nyaman untuk dinikmati oleh para pengunjung.',
                'address' => 'Karangdoro, Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/celosia',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 20000,
                'operational_hours' => '09:00 - 17:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.7,
                'access_level' => 'Mudah',
                'generated_tags' => ['Bunga', 'Taman', 'Fotografi'],
                'status' => 'active',
            ]
        );

        $celosia->activities()->sync($activities);
        $celosia->facilities()->sync($facilities);
        $celosia->travelTypes()->sync($travelTypes);
        $celosia->visitTimes()->sync($visitTimes);
        $celosia->transportations()->sync($transportations);

        // 13. Pantai Pesanggaran
        $pesanggaran = Destination::firstOrCreate(
            ['slug' => 'pantai-pesanggaran'],
            [
                'destination_category_id' => $pantai->id,
                'destination_subcategory_id' => $pasirPutihSub ? $pasirPutihSub->id : null,
                'name' => 'Pantai Pesanggaran',
                'description' => 'Pantai Pesanggaran adalah pantai yang masih asri dengan hamparan pasir putih serta laut yang relatif tenang. Suasana di kawasan ini cenderung damai dan belum terlalu ramai, sehingga cocok bagi wisatawan yang mencari ketenangan dan pengalaman menikmati pesisir yang alami. Keindahan sederhana pantai ini menjadikannya tempat yang pas untuk berjalan santai, beristirahat, dan menikmati panorama laut.',
                'address' => 'Pesanggaran, Banyuwangi, Jawa Timur',
                'district' => 'Pesanggaran',
                'google_maps_url' => 'https://maps.app.goo.gl/pesanggaran',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 0,
                'operational_hours' => '06:00 - 18:00 WIB',
                'visit_duration_hours' => '3',
                'rating' => 4.4,
                'access_level' => 'Mudah',
                'generated_tags' => ['Pantai', 'Asri', 'Tenang'],
                'status' => 'active',
            ]
        );

        $pesanggaran->activities()->sync($activities);
        $pesanggaran->facilities()->sync($facilities);
        $pesanggaran->travelTypes()->sync($travelTypes);
        $pesanggaran->visitTimes()->sync($visitTimes);
        $pesanggaran->transportations()->sync($transportations);

        // 14. Negeri Atas Awan
        $negeriBawah = Destination::firstOrCreate(
            ['slug' => 'negeri-atas-awan'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $pemandanganSub ? $pemandanganSub->id : null,
                'name' => 'Negeri Atas Awan',
                'description' => 'Negeri Atas Awan adalah tempat wisata di dataran tinggi yang menawarkan pemandangan awan indah, udara sejuk, dan suasana pegunungan yang menenangkan. Dari area ini, pengunjung dapat menikmati panorama alam yang luas dengan nuansa seperti berada di atas lautan awan, terutama saat kondisi cuaca mendukung. Destinasi ini sangat cocok bagi wisatawan yang ingin merasakan pengalaman alam yang unik dan menenangkan.',
                'address' => 'Jampit, Banyuwangi, Jawa Timur',
                'district' => 'Jampit',
                'google_maps_url' => 'https://maps.app.goo.gl/negeri-awan',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 15000,
                'operational_hours' => '07:00 - 17:00 WIB',
                'visit_duration_hours' => '3',
                'rating' => 4.8,
                'access_level' => 'Sedang',
                'generated_tags' => ['Awan', 'Pemandangan', 'Sejuk'],
                'status' => 'active',
            ]
        );

        $negeriBawah->activities()->sync($activities);
        $negeriBawah->facilities()->sync($facilities);
        $negeriBawah->travelTypes()->sync($travelTypes);
        $negeriBawah->visitTimes()->sync($visitTimes);
        $negeriBawah->transportations()->sync($transportations);

        // 15. Taman Reptil
        $reptil = Destination::firstOrCreate(
            ['slug' => 'taman-reptil'],
            [
                'destination_category_id' => $alam->id,
                'destination_subcategory_id' => $satwaSub ? $satwaSub->id : null,
                'name' => 'Taman Reptil',
                'description' => 'Taman Reptil adalah tempat wisata edukatif yang menampilkan berbagai jenis reptil dan satwa eksotis dalam suasana yang informatif serta ramah untuk keluarga. Di sini pengunjung dapat mengenal lebih dekat karakteristik hewan-hewan unik sambil belajar mengenai habitat, perilaku, dan pentingnya pelestarian satwa. Destinasi ini cocok sebagai wisata edukasi yang menggabungkan pengetahuan, hiburan, dan pengalaman melihat koleksi satwa secara langsung.',
                'address' => 'Banyuwangi, Jawa Timur',
                'district' => 'Banyuwangi',
                'google_maps_url' => 'https://maps.app.goo.gl/reptil',
                'main_image' => asset('images/bg-login.jpg'),
                'ticket_price' => 30000,
                'operational_hours' => '08:00 - 17:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.6,
                'access_level' => 'Mudah',
                'generated_tags' => ['Satwa', 'Edukatif', 'Keluarga'],
                'status' => 'active',
            ]
        );

        $reptil->activities()->sync($activities);
        $reptil->facilities()->sync($facilities);
        $reptil->travelTypes()->sync($travelTypes);
        $reptil->visitTimes()->sync($visitTimes);
        $reptil->transportations()->sync($transportations);

        // 16. De Djawatan
        $djawatan = Destination::firstOrCreate(
            ['slug' => 'de-djawatan'],
            [
                'destination_category_id' => $hutan->id,
                'destination_subcategory_id' => null,
                'name' => 'De Djawatan',
                'description' => 'De Djawatan adalah kawasan hutan wisata yang dikelola oleh Perhutani dengan pemandangan pohon trembesi raksasa yang tertutup lumut, menciptakan nuansa magis seperti hutan fiksi Fangorn Forest dalam film Lord of the Rings. Tempat ini memiliki luas sekitar 3,8 hektar dan menjadi destinasi favorit wisatawan untuk berfoto, bersantai di bawah keteduhan pohon, menikmati kesejukan udara, serta menikmati keindahan alam hutan yang asri.',
                'address' => 'Benculuk, Cluring, Kabupaten Banyuwangi, Jawa Timur',
                'district' => 'Benculuk',
                'google_maps_url' => 'https://maps.app.goo.gl/dejawatan',
                'main_image' => 'images/de-djawatan.png',
                'ticket_price' => 7500,
                'operational_hours' => '08:00 - 17:00 WIB',
                'visit_duration_hours' => '2',
                'rating' => 4.7,
                'access_level' => 'Mudah',
                'generated_tags' => ['Hutan', 'Trembesi', 'Foto', 'Magis'],
                'status' => 'active',
            ]
        );

        $djawatan->activities()->sync($activities);
        $djawatan->facilities()->sync($facilities);
        $djawatan->travelTypes()->sync($travelTypes);
        $djawatan->visitTimes()->sync($visitTimes);
        $djawatan->transportations()->sync($transportations);
    }
}
