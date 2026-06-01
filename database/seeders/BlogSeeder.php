<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::where('email', 'admin@laras.com')->first();
        if (!$admin) {
            $admin = Admin::first();
        }

        $tipsTrik = CategoryBlog::where('slug', 'tips-trik')->first();
        $wisataAlam = CategoryBlog::where('slug', 'wisata-alam')->first();
        $kuliner = CategoryBlog::where('slug', 'kuliner')->first();
        $eventFestival = CategoryBlog::where('slug', 'event-festival')->first();
        $akomodasi = CategoryBlog::where('slug', 'akomodasi')->first();

        // 1. Tips mendaki ijen
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'tips-mendaki-gunung-ijen-bagi-pemula'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Tips Mendaki Gunung Ijen Bagi Pemula',
                    'content' => '<p>Mendaki Gunung Ijen untuk menyaksikan fenomena <i>Blue Fire</i> (Api Biru) yang legendaris adalah impian banyak orang. Namun, bagi pemula, ada beberapa persiapan penting yang tidak boleh dilewatkan agar pendakian berjalan aman dan menyenangkan.</p><h3>1. Persiapkan Fisik</h3><p>Meskipun jalur pendakian Gunung Ijen terbilang ramah dengan kemiringan yang landai di beberapa bagian, Anda tetap membutuhkan stamina yang prima. Lakukan olahraga ringan seperti jogging atau jalan kaki seminggu sebelum keberangkatan.</p><h3>2. Gunakan Pakaian Tebal</h3><p>Suhu di Paltuding (pos awal pendakian) dan puncak Ijen bisa mencapai 10-15 derajat Celcius, bahkan lebih dingin di musim kemarau. Siapkan jaket tebal, sarung tangan, syal, dan kupluk.</p><h3>3. Masker Gas / Respirator</h3><p>Ini adalah perlengkapan paling vital. Gas belerang di kawah Ijen sangat menyengat dan berbahaya bagi pernapasan. Anda wajib memakai masker respirator, terutama jika turun mendekati kawah.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        // 2. Kuliner Banyuwangi
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'kuliner-khas-banyuwangi-yang-wajib-dicoba'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Kuliner Khas Banyuwangi yang Wajib Dicoba',
                    'content' => '<p>Banyuwangi tidak hanya kaya akan keindahan alamnya, tetapi juga menyimpan ragam kuliner khas yang memanjakan lidah. Berikut adalah beberapa kuliner ikonik Banyuwangi yang wajib Anda coba saat berkunjung:</p><h3>1. Nasi Tempong</h3><p>Nama "tempong" berasal dari bahasa Using yang berarti ditampar. Ini karena rasa sambalnya yang sangat pedas seperti menampar wajah Anda. Nasi tempong disajikan hangat dengan aneka sayuran rebus, tahu, tempe, bakwan jagung, ikan asin, dan lauk utama seperti ayam goreng atau ikan laut.</p><h3>2. Rujak Soto</h3><p>Perpaduan unik antara rujak sayur bumbu kacang khas Jawa Timur dengan soto babat berkuah hangat yang gurih. Kombinasi rasa kacang, petis, dan kuah soto berlemak menciptakan sensasi rasa yang tiada duanya.</p><h3>3. Pecel Rawon</h3><p>Satu lagi hidangan kombinasi unik: nasi pecel kering yang disiram kuah rawon daging sapi yang hitam manis dan gurih. Biasanya disajikan dengan rempeyek atau kerupuk udang.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        // 3. De Djawatan
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'pesona-magis-hutan-de-djawatan-benculuk'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Pesona Magis Hutan De Djawatan Benculuk',
                    'content' => '<p>Pernahkah Anda membayangkan berjalan di dalam hutan dongeng? Di Banyuwangi, Anda bisa merasakannya langsung dengan mengunjungi <b>De Djawatan Benculuk</b>. Tempat wisata ini terkenal karena barisan pohon trembesi raksasa yang diselimuti lumut hijau lebat.</p><p>Hutan ini sering disamakan dengan <i>Fangorn Forest</i> yang ada di dalam film trilogi "Lord of the Rings". Keindahannya yang eksotis dan magis menjadikannya salah satu tempat terpopuler untuk berburu foto di Banyuwangi.</p><p>Waktu terbaik untuk berkunjung adalah di sore hari ketika sinar matahari menyelinap di antara celah-celah dedaunan raksasa, menciptakan berkas cahaya (ray of light) yang sangat memukau.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );
        }

        // 4. Budaya - Gandrung
        $budaya = CategoryBlog::where('slug', 'budaya')->first();
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'mengenal-tari-gandrung-seni-tari-kebanggaan-banyuwangi'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Mengenal Tari Gandrung, Seni Tari Kebanggaan Banyuwangi',
                    'content' => '<p>Tari Gandrung adalah salah satu seni tari tradisional yang menjadi maskot Kabupaten Banyuwangi. Tari ini dipentaskan sebagai perwujudan rasa syukur masyarakat setelah panen raya.</p><h3>Asal Usul Tari Gandrung</h3><p>Kesenian Gandrung awalnya dibawakan oleh laki-laki yang berdandan seperti perempuan. Namun seiring perkembangan waktu, tarian ini ditarikan oleh perempuan dan menjadi tarian penyambutan tamu kehormatan.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(1),
                ]
            );
        }

        // 5. Tips - Waktu Terbaik Kawah Ijen
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'waktu-terbaik-mengunjungi-kawah-ijen'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Waktu Terbaik Mengunjungi Kawah Ijen',
                    'content' => '<p>Kawah Ijen terkenal dengan keindahan kawah asamnya dan api biru. Namun, untuk mendapatkan pemandangan terbaik, Anda harus memilih waktu berkunjung yang tepat.</p><h3>1. Musim Kemarau (Juli - September)</h3><p>Musim kemarau adalah waktu terbaik karena jalur pendakian kering dan tidak licin, serta langit cenderung cerah tanpa kabut tebal.</p><h3>2. Berangkat Dini Hari</h3><p>Pendakian sebaiknya dimulai sekitar jam 01.00 - 02.00 dini hari agar Anda tiba di puncak sebelum matahari terbit dan bisa menyaksikan Blue Fire.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(2),
                ]
            );
        }

        // 6. Kuliner - Oleh-oleh
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'oleh-oleh-khas-banyuwangi-yang-populer'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Oleh-Oleh Khas Banyuwangi yang Populer',
                    'content' => '<p>Berkunjung ke Banyuwangi tidak lengkap tanpa membawa pulang buah tangan khas daerah ini. Berikut adalah beberapa rekomendasi oleh-oleh khas Banyuwangi:</p><h3>1. Bagiak</h3><p>Kue kering tradisional yang terbuat dari tepung sagu dengan tekstur renyah dan memiliki berbagai varian rasa seperti jahe, susu, dan kacang.</p><h3>2. Kopi Kemiren</h3><p>Bagi pecinta kopi, kopi khas suku Osing dari desa adat Kemiren adalah pilihan wajib karena diolah secara tradisional.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(3),
                ]
            );
        }

        // 7. Wisata Alam - Pulau Merah
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'keindahan-pantai-pulau-merah-dan-aktivitas-serunya'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Keindahan Pantai Pulau Merah dan Aktivitas Serunya',
                    'content' => '<p>Pantai Pulau Merah terkenal dengan bukit kecil setinggi 200 meter yang berada di dekat bibir pantai. Bukit ini memiliki tanah berwarna merah yang diselimuti tumbuhan hijau.</p><h3>Aktivitas Seru di Pulau Merah</h3><p>Selain menikmati pemandangan matahari terbenam yang memukau, Anda juga bisa mencoba berselancar karena ombaknya yang cukup bersahabat bagi peselancar pemula hingga menengah.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(4),
                ]
            );
        }

        // 8. Budaya - Desa Kemiren
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'menjelajahi-keunikan-desa-adat-kemiren-suku-osing'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Menjelajahi Keunikan Desa Adat Kemiren Suku Osing',
                    'content' => '<p>Desa Kemiren di Kecamatan Glagah merupakan tempat tinggal suku asli Banyuwangi, yaitu Suku Osing. Desa ini ditetapkan sebagai cagar budaya untuk melestarikan tradisi adat mereka.</p><h3>Tradisi Mepe Kasur</h3><p>Salah satu tradisi unik yang masih dijaga adalah menjemur kasur berwarna merah dan hitam secara bersamaan oleh seluruh warga desa untuk menolak bala.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(5),
                ]
            );
        }

        // 9. Kuliner - Rujak Soto
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'sensasi-unik-rujak-soto-khas-banyuwangi'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Sensasi Unik Rujak Soto Khas Banyuwangi',
                    'content' => '<p>Banyuwangi terkenal dengan kuliner ekstrem hasil kombinasi dua menu yang bertolak belakang: rujak sayur bumbu petis dan soto kuah kuning gurih hangat. Kuliner legendaris ini dinamai Rujak Soto.</p><h3>Perpaduan Rasa yang Kaya</h3><p>Rasa manis, gurih, pedas, dan sedikit rasa asam dari petis bercampur sempurna dengan lemak kuah soto babat. Biasanya kuliner ini dinikmati saat makan siang dengan kerupuk emping.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(6),
                ]
            );
        }

        // 10. Budaya - Seblang
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'ritual-seblang-tarian-mistis-suku-osing'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Ritual Seblang, Tarian Mistis Suku Osing',
                    'content' => '<p>Kesenian Seblang adalah ritual adat Suku Osing yang diadakan setiap tahun di Desa Olehsari dan Bakungan. Tarian ini bernuansa mistis karena penari menari dalam kondisi tidak sadar (trance).</p><h3>Tujuan Ritual Seblang</h3><p>Masyarakat mempercayai bahwa ritual ini berfungsi sebagai bersih desa dan tolak bala agar desa terhindar dari mara bahaya serta mendapatkan hasil pertanian melimpah.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(7),
                ]
            );
        }

        // 11. Wisata Alam - Baluran
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'taman-nasional-baluran-little-africa-di-ujung-jawa'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Taman Nasional Baluran, Little Africa di Ujung Jawa',
                    'content' => '<p>Meskipun secara administratif berada di perbatasan Situbondo dan Banyuwangi, Taman Nasional Baluran sering menjadi satu paket kunjungan wisata Banyuwangi karena pemandangan savananya yang luas.</p><h3>Savana Bekol</h3><p>Di Savana Bekol, Anda bisa melihat kawanan rusa liar, kerbau, merak, dan monyet ekor panjang berkeliaran bebas dengan latar belakang Gunung Baluran yang megah.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(8),
                ]
            );
        }

        // 12. Tips - Perlengkapan Ijen
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'daftar-perlengkapan-wajib-untuk-mendaki-kawah-ijen'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Daftar Perlengkapan Wajib untuk Mendaki Kawah Ijen',
                    'content' => '<p>Mendaki Gunung Ijen membutuhkan persiapan matang, terutama karena suhu ekstrem dan paparan gas belerang. Berikut daftar barang yang wajib Anda bawa:</p><h3>1. Jaket Windproof & Sepatu Gunung</h3><p>Gunakan jaket penahan angin karena suhu di puncak sangat dingin. Sepatu bersol kasar juga penting agar tidak tergelincir di jalur berpasir.</p><h3>2. Senter Kepala (Headlamp)</h3><p>Karena pendakian dilakukan tengah malam dalam kegelapan total, headlamp sangat direkomendasikan agar tangan Anda bebas bergerak.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(9),
                ]
            );
        }

        // 13. Wisata Alam - Sukamade
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'petualangan-malam-melihat-penyu-bertelur-di-pantai-sukamade'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Petualangan Malam Melihat Penyu Bertelur di Pantai Sukamade',
                    'content' => '<p>Pantai Sukamade yang terletak di dalam kawasan Taman Nasional Meru Betiri adalah habitat peneluran penyu hijau raksasa. Menonton penyu bertelur di malam hari adalah salah satu petualangan alam paling magis.</p><h3>Konservasi dan Pelepasan Tukik</h3><p>Selain mengamati penyu bertelur di bawah pengawasan ranger, pada pagi harinya pengunjung dapat berpartisipasi melepaskan anak penyu (tukik) ke samudera lepas.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(10),
                ]
            );
        }

        // 14. Kuliner - Nasi Tempong
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'rekomendasi-nasi-tempong-pedas-mantap-di-banyuwangi'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Rekomendasi Nasi Tempong Pedas Mantap di Banyuwangi',
                    'content' => '<p>Nasi Tempong adalah kuliner paling populer di Banyuwangi bagi pecinta masakan pedas. Makanan ini disajikan dengan sambal mentah yang diulek dadakan dengan tomat ranti.</p><h3>Ciri Khas Nasi Tempong</h3><p>Hidangan ini disajikan lengkap dengan nasi hangat, lauk pauk (ayam, ikan, atau gimbal jagung), serta lalapan rebus seperti bayam, kubis, dan daun kemangi yang segar.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(11),
                ]
            );
        }

        // 15. Wisata Alam - Bangsring Underwater
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'pesona-terumbu-karang-bangsring-underwater'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Pesona Terumbu Karang Bangsring Underwater',
                    'content' => '<p>Bangsring Underwater (Bunder) adalah salah satu destinasi wisata konservasi terumbu karang berbasis masyarakat di Banyuwangi. Tempat ini sangat populer bagi pecinta selam permukaan (snorkeling) dan menyelam (diving).</p><h3>Konservasi Terumbu Karang</h3><p>Wisatawan dapat ikut serta dalam kegiatan konservasi seperti menanam terumbu karang (transplantasi). Selain itu, terdapat rumah apung di tengah laut tempat penangkaran ikan hiu jinak, di mana Anda bisa menguji nyali berenang bersama mereka.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(12),
                ]
            );
        }

        // 16. Budaya - Kebo-Keboan Aliyan
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'tradisi-unik-kebo-keboan-desa-aliyan'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Tradisi Unik Kebo-Keboan Desa Aliyan',
                    'content' => '<p>Kebo-keboan adalah salah satu upacara adat besar yang diselenggarakan oleh masyarakat agraris di Desa Aliyan dan Alasmalang, Banyuwangi. Ritual ini dilaksanakan sebagai bentuk syukur atas hasil panen dan doa keselamatan desa.</p><h3>Manusia Kerbau</h3><p>Dalam ritual ini, sejumlah warga desa didandani menyerupai kerbau lengkap dengan tanduk bualan, tubuh dilumuri jelaga hitam, dan menarik bajak di sawah yang penuh lumpur sebagai simbol kesuburan pertanian.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(13),
                ]
            );
        }

        // 17. Kuliner - Sego Tempong Khas Banyuwangi
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'sensasi-pedas-sego-tempong-khas-banyuwangi'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Sensasi Pedas Sego Tempong Khas Banyuwangi',
                    'content' => '<p>Sego Tempong (Nasi Tempong) adalah makanan legendaris dari Banyuwangi yang terkenal dengan cita rasa sambal mentahnya yang segar dan luar biasa pedas. Dinamai "tempong" yang berarti ditampar karena pedasnya serasa menampar mulut.</p><h3>Lauk Pauk Pelengkap</h3><p>Sajian ini biasanya dilengkapi dengan nasi hangat, lalapan rebus seperti kubis dan daun singkong, gorengan tahu, tempe, bakwan jagung, ikan asin, serta pilihan lauk utama seperti lele goreng atau ayam goreng.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(14),
                ]
            );
        }

        // 18. Tips & Trik - Tips Fotografi di De Djawatan
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'tips-fotografi-menghasilkan-foto-magis-di-de-djawatan'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Tips Fotografi Menghasilkan Foto Magis di De Djawatan',
                    'content' => '<p>Hutan De Djawatan Benculuk menawarkan pemandangan pohon trembesi raksasa berlumut yang menyerupai hutan di film Lord of the Rings. Berikut adalah tips agar hasil foto Anda terlihat luar biasa dan magis:</p><h3>1. Datang di Sore Hari</h3><p>Sinar matahari sore (sekitar pukul 15.30 - 17.00) akan menembus celah-celah dedaunan besar dan menciptakan efek ray of light yang indah.</p><h3>2. Gunakan Sudut Lebar (Wide Angle)</h3><p>Pohon trembesi di De Djawatan berukuran sangat besar. Gunakan lensa wide angle untuk menangkap kemegahan pohon dari bawah hingga ke tajuknya.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(15),
                ]
            );
        }

        // 19. Wisata Alam - Pantai Wedi Ireng
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'eksplorasi-keindahan-pantai-wedi-ireng'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Eksplorasi Keindahan Pantai Wedi Ireng',
                    'content' => '<p>Pantai Wedi Ireng adalah surga tersembunyi yang terletak di Dusun Pancer, Desa Sumberagung. Pantai ini memiliki keunikan berupa perpaduan pasir putih halus dan pasir hitam yang berada di bawahnya.</p><h3>Akses Menuju Wedi Ireng</h3><p>Untuk mencapai pantai ini, wisatawan harus menyeberang dengan perahu nelayan dari Pantai Pancer atau melakukan trekking melewati perbukitan selama sekitar 30 menit.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(16),
                ]
            );
        }

        // 20. Budaya - Barong Ider Bumi
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'ritual-adat-barong-ider-bumi-desa-kemiren'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Ritual Adat Barong Ider Bumi Desa Kemiren',
                    'content' => '<p>Barong Ider Bumi adalah ritual tolak bala tahunan yang diselenggarakan oleh suku Using di Desa Adat Kemiren pada hari kedua hari raya Idul Fitri. Tradisi ini sudah berlangsung sejak ratusan tahun lalu.</p><h3>Arak-arakan Barong</h3><p>Ritual dimulai dengan arak-arakan Barong Using mengelilingi batas desa, diikuti oleh tetua adat dan masyarakat yang memainkan alat musik tradisional serta menyemburkan air suci.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(17),
                ]
            );
        }

        // 21. Event & Festival - Banyuwangi Ethno Carnival
        if ($eventFestival && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'kemegahan-banyuwangi-ethno-carnival-bec-parade-busana-kolosal'],
                [
                    'blog_category_id' => $eventFestival->id,
                    'admin_id' => $admin->id,
                    'title' => 'Kemegahan Banyuwangi Ethno Carnival (BEC): Parade Busana Kolosal',
                    'content' => '<p>Banyuwangi Ethno Carnival (BEC) adalah salah satu festival fesyen tahunan terbesar di Indonesia yang memadukan keindahan budaya tradisional dengan kreasi busana modern berskala internasional.</p><h3>Tema Budaya Lokal</h3><p>Setiap tahunnya, ratusan peraga busana berlenggok di sepanjang jalan utama Banyuwangi membawakan tema kebudayaan lokal seperti ritual seblang, barong kemiren, hingga belerang ijen yang dikemas secara teatrikal dan megah.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(18),
                ]
            );
        }

        // 22. Akomodasi - Rekomendasi Glamping Mewah di Licin
        if ($akomodasi && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'rekomendasi-glamping-mewah-di-kaki-gunung-ijen'],
                [
                    'blog_category_id' => $akomodasi->id,
                    'admin_id' => $admin->id,
                    'title' => 'Rekomendasi Glamping Mewah di Kaki Gunung Ijen',
                    'content' => '<p>Bagi Anda yang ingin menikmati suasana alam pegunungan yang asri tanpa kehilangan kenyamanan hotel berbintang, mencoba glamping (glamorous camping) di kawasan Licin adalah pilihan sempurna.</p><h3>Menyatu dengan Alam</h3><p>Beberapa glamping populer menawarkan pemandangan langsung ke sawah terasering dan hutan tropis, lengkap dengan fasilitas kolam renang air hangat, balkon pribadi, dan api unggun di malam hari.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(19),
                ]
            );
        }

        // 23. Wisata Alam - Pantai Pulau Tabuhan
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'surga-snorkeling-di-pulau-tabuhan-banyuwangi'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Surga Snorkeling di Pulau Tabuhan Banyuwangi',
                    'content' => '<p>Pulau Tabuhan adalah sebuah pulau kecil tak berpenghuni yang terletak di Selat Bali, tepatnya di sebelah utara Banyuwangi. Pulau ini terkenal dengan pasir putih bersih dan air lautnya yang sangat jernih bergradasi biru muda.</p><h3>Surga Kitesurfing dan Snorkeling</h3><p>Kecepatan angin yang stabil membuat Pulau Tabuhan menjadi salah satu spot kitesurfing terbaik di Asia Tenggara. Wisatawan juga bisa menikmati keindahan bawah laut dengan bersnorkeling di sekitar terumbu karang pulau.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(20),
                ]
            );
        }

        // 24. Tips & Trik - Panduan Mengunjungi Jawatan Benculuk
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'panduan-lengkap-liburan-ke-de-djawatan-benculuk'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Panduan Lengkap Liburan ke De Djawatan Benculuk',
                    'content' => '<p>Ingin mengunjungi De Djawatan Benculuk tapi bingung persiapannya? Hutan trembesi raksasa ini sangat mudah diakses, namun ada beberapa panduan penting agar liburan Anda semakin maksimal.</p><h3>Transportasi dan Tiket</h3><p>De Djawatan berlokasi sekitar 30 km dari pusat kota Banyuwangi. Tiket masuk sangat terjangkau, dan dianjurkan menggunakan pakaian berwarna kontras seperti merah atau kuning agar terlihat indah saat berfoto di bawah naungan pohon trembesi.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(21),
                ]
            );
        }

        // 25. Budaya - Tradisi Puter Kayun Suku Using
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'mengenal-tradisi-puter-kayun-suku-using-boyolangu'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Mengenal Tradisi Puter Kayun Suku Using Boyolangu',
                    'content' => '<p>Puter Kayun adalah tradisi tahunan masyarakat Kelurahan Boyolangu yang digelar pada hari kesepuluh bulan Syawal. Tradisi ini berupa parade menggunakan dokar hias dari Boyolangu menuju Pantai Watu Dodol.</p><h3>Nostalgia dan Rasa Syukur</h3><p>Tradisi ini diselenggarakan sebagai bentuk rasa syukur dan napak tilas sejarah leluhur mereka, Buyut Jakso, yang dipercaya membuka jalan bersejarah di Pantai Watu Dodol.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(22),
                ]
            );
        }

        // 26. Kuliner - Pecel Pitik Makanan Adat Kemiren
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'pecel-pitik-kuliner-ritual-adat-suku-osing'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Pecel Pitik: Kuliner Ritual Adat Suku Osing',
                    'content' => '<p>Pecel Pitik adalah hidangan khas suku Using yang sangat istimewa karena awalnya hanya disajikan saat ritual adat atau bersih desa. Hidangan ini berupa ayam kampung panggang yang disuwir halus.</p><h3>Bumbu Parutan Kelapa</h3><p>Keunikan pecel pitik terletak pada bumbu urap parutan kelapa muda yang dicampur dengan kacang tanah, cabai rawit, terasi, dan daun jeruk purut, memberikan cita rasa gurih yang khas.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(23),
                ]
            );
        }

        // 27. Event & Festival - Gandrung Sewu
        if ($eventFestival && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'pesona-kolosal-festival-gandrung-sewu-pantai-boom'],
                [
                    'blog_category_id' => $eventFestival->id,
                    'admin_id' => $admin->id,
                    'title' => 'Pesona Kolosal Festival Gandrung Sewu di Pantai Boom',
                    'content' => '<p>Festival Gandrung Sewu adalah salah satu agenda wisata andalan Banyuwangi yang menampilkan tarian kolosal seribu penari Gandrung di bibir Pantai Boom dengan latar belakang Selat Bali.</p><h3>Pagelaran Seni yang Epik</h3><p>Kombinasi ribuan penari berpakaian merah membara bergerak serempak di atas pasir pantai menghasilkan pemandangan visual yang luar biasa megah dan penuh dengan nilai estetika budaya tinggi.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(24),
                ]
            );
        }

        // 28. Akomodasi - Homestay Murah Ramah Lingkungan di Tamansari
        if ($akomodasi && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'homestay-unik-dan-terjangkau-di-desa-wisata-tamansari'],
                [
                    'blog_category_id' => $akomodasi->id,
                    'admin_id' => $admin->id,
                    'title' => 'Homestay Unik dan Terjangkau di Desa Wisata Tamansari',
                    'content' => '<p>Desa Wisata Tamansari yang berada di kawasan lereng Gunung Ijen menyediakan banyak pilihan homestay berkonsep ramah lingkungan yang dikelola secara langsung oleh penduduk setempat.</p><h3>Pengalaman Budaya Lokal</h3><p>Menginap di homestay desa ini memberikan kesempatan bagi wisatawan untuk berinteraksi langsung dengan warga lokal, mencoba membuat kopi osing sendiri, dan menikmati udara sejuk pegunungan.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(25),
                ]
            );
        }

        // 29. Wisata Alam - Pantai Teluk Hijau (Green Bay)
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'keindahan-tersembunyi-pantai-teluk-hijau-green-bay'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Keindahan Tersembunyi Pantai Teluk Hijau (Green Bay)',
                    'content' => '<p>Teluk Hijau adalah salah satu surga bahari tercantik di Banyuwangi yang terletak di dalam kawasan Taman Nasional Meru Betiri. Pantai ini dinamai Teluk Hijau karena air lautnya berwarna kehijauan yang jernih di tepian pantai.</p><h3>Pesona Hutan Hijau</h3><p>Dikelilingi tebing karang tinggi dan pepohonan hijau lebat, pantai berpasir putih ini menawarkan suasana sunyi, asri, dan sangat alami layaknya pantai pribadi.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(26),
                ]
            );
        }

        // 30. Tips & Trik - Tips Menghemat Anggaran Liburan ke Banyuwangi
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'tips-liburan-hemat-dan-backpacker-ke-banyuwangi'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Tips Liburan Hemat dan Backpacker ke Banyuwangi',
                    'content' => '<p>Banyuwangi adalah destinasi yang ramah untuk para backpacker. Anda bisa menjelajahi keindahan alamnya tanpa harus merogoh kocek dalam-dalam dengan beberapa tips cerdas.</p><h3>Gunakan Transportasi Umum</h3><p>Gunakan kereta api kelas ekonomi untuk menuju Banyuwangi, menyewa sepeda motor untuk mobilitas di lokasi wisata, dan pilihlah homestay lokal dibanding hotel berbintang.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(27),
                ]
            );
        }

        // 31. Budaya - Sejarah dan Makna Suku Using
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'sejarah-singkat-dan-asal-usul-suku-using-banyuwangi'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Sejarah Singkat dan Asal-Usul Suku Using Banyuwangi',
                    'content' => '<p>Suku Using (atau Osing) adalah penduduk asli Kabupaten Banyuwangi. Mereka memiliki bahasa, dialek, adat istiadat, dan kesenian unik yang berbeda dari suku Jawa dan Madura di sekitarnya.</p><h3>Keturunan Kerajaan Blambangan</h3><p>Masyarakat Using dipercayai merupakan keturunan langsung dari rakyat Kerajaan Blambangan Hindu yang bertahan dari gempuran kerajaan-kerajaan besar lainnya di masa lampau.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(28),
                ]
            );
        }

        // 32. Kuliner - Bagiak Camilan Renyah Manis
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'mengenal-bagiak-kue-kering-tradisional-banyuwangi'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Mengenal Bagiak, Kue Kering Tradisional Banyuwangi',
                    'content' => '<p>Bagiak adalah kue kering khas Banyuwangi yang berbahan dasar tepung sagu. Kue ini sangat disukai wisatawan karena rasanya yang manis gurih dan teksturnya yang sangat renyah.</p><h3>Varian Rasa Kekinian</h3><p>Awalnya hanya memiliki rasa jahe dan susu, kini bagiak memiliki banyak varian rasa modern seperti kacang, keju, wijen, cokelat, hingga kayu manis yang pas dinikmati bersama kopi.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(29),
                ]
            );
        }

        // 33. Event & Festival - Festival Barong Ider Bumi
        if ($eventFestival && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'semarak-festival-barong-ider-bumi-di-desa-kemiren'],
                [
                    'blog_category_id' => $eventFestival->id,
                    'admin_id' => $admin->id,
                    'title' => 'Semarak Festival Barong Ider Bumi di Desa Kemiren',
                    'content' => '<p>Festival Barong Ider Bumi menampilkan keindahan kesenian Barong Using yang diarak keliling desa untuk menolak bala dan mendatangkan keberuntungan di awal tahun baru syawal.</p><h3>Pesta Rakyat dan Kuliner Pecel Pitik</h3><p>Setelah arak-arakan barong selesai, warga desa dan pengunjung berkumpul untuk menikmati hidangan pecel pitik secara bersama-sama di sepanjang jalan desa.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(30),
                ]
            );
        }

        // 34. Wisata Alam - Kawah Wurung
        if ($wisataAlam && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'pesona-kawah-wurung-bukit-teletubbies-hijau-bondowoso-banyuwangi'],
                [
                    'blog_category_id' => $wisataAlam->id,
                    'admin_id' => $admin->id,
                    'title' => 'Pesona Kawah Wurung, Bukit Teletubbies Hijau',
                    'content' => '<p>Kawah Wurung adalah destinasi wisata perbukitan savana hijau yang indah yang terletak tidak jauh dari Kawah Ijen. Sering disebut sebagai Bukit Teletubbies-nya Banyuwangi karena hamparan bukitnya yang bergelombang hijau mempesona.</p><h3>Pesona Savana Hijau</h3><p>Berbeda dengan Kawah Ijen yang kawahnya berair asam, Kawah Wurung adalah kawah mati yang telah diselimuti rumput subur. Tempat ini sangat populer untuk bersantai, berfoto, hingga berkemah.</p>',
                    'image' => 'images/kawah-ijen.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(31),
                ]
            );
        }

        // 35. Tips & Trik - Tips Memilih Homestay di Banyuwangi
        if ($tipsTrik && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'tips-memilih-homestay-nyaman-dan-aman-di-banyuwangi'],
                [
                    'blog_category_id' => $tipsTrik->id,
                    'admin_id' => $admin->id,
                    'title' => 'Tips Memilih Homestay Nyaman dan Aman di Banyuwangi',
                    'content' => '<p>Memilih akomodasi yang tepat sangat menentukan kenyamanan liburan Anda di Banyuwangi. Homestay lokal bisa menjadi alternatif akomodasi yang seru dan ekonomis. Berikut tips memilihnya:</p><h3>1. Dekat dengan Akses Wisata</h3><p>Pilihlah homestay yang dekat dengan rute wisata utama Anda, misalnya di kaki Gunung Ijen (Tamansari) atau di dekat Pantai Pulau Merah agar menghemat waktu perjalanan.</p><h3>2. Cek Ulasan Pengunjung</h3><p>Gunakan platform online untuk melihat ulasan asli mengenai kebersihan fasilitas dan keramahan pemilik homestay sebelum memesan.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(32),
                ]
            );
        }

        // 36. Kuliner - Rujak Bakso Khas Banyuwangi
        if ($kuliner && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'rujak-bakso-kuliner-kombinasi-unik-khas-banyuwangi'],
                [
                    'blog_category_id' => $kuliner->id,
                    'admin_id' => $admin->id,
                    'title' => 'Rujak Bakso, Kuliner Kombinasi Unik Khas Banyuwangi',
                    'content' => '<p>Selain Rujak Soto, Banyuwangi juga memiliki kuliner kombinasi unik lainnya yang wajib Anda coba, yaitu Rujak Bakso. Seperti namanya, hidangan ini memadukan rujak bumbu kacang dengan bakso kuah hangat.</p><h3>Cita Rasa Gurih Pedas</h3><p>Bumbu petis dan kacang yang gurih berpadu dengan kuah kaldu bakso yang hangat menghasilkan sensasi kuah yang kental dan sangat nikmat, terutama jika ditambahkan sambal pedas.</p>',
                    'image' => 'images/de-djawatan.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(33),
                ]
            );
        }

        // 37. Budaya - Kesenian Janger Banyuwangi
        if ($budaya && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'mengenal-kesenian-janger-akulturasi-budaya-jawa-dan-bali'],
                [
                    'blog_category_id' => $budaya->id,
                    'admin_id' => $admin->id,
                    'title' => 'Mengenal Kesenian Janger, Akulturasi Budaya Jawa dan Bali',
                    'content' => '<p>Janger Banyuwangi (atau juga dikenal sebagai Damarwulan) adalah sebuah seni pertunjukan teater rakyat yang sangat unik karena memadukan unsur budaya Jawa (Using) dengan budaya Bali.</p><h3>Ciri Khas Pertunjukan</h3><p>Dialog dalam pertunjukan menggunakan bahasa Using, sedangkan kostum, tata rias, dan musik gamelan pengiringnya sangat kental dengan nuansa tradisional Bali.</p>',
                    'image' => 'images/bg-login.jpg',
                    'status' => 'published',
                    'published_at' => now()->subDays(34),
                ]
            );
        }

        // 38. Akomodasi - Hotel Unik dengan Pemandangan Selat Bali
        if ($akomodasi && $admin) {
            Blog::firstOrCreate(
                ['slug' => 'rekomendasi-hotel-dengan-pemandangan-indah-selat-bali'],
                [
                    'blog_category_id' => $akomodasi->id,
                    'admin_id' => $admin->id,
                    'title' => 'Rekomendasi Hotel dengan Pemandangan Indah Selat Bali',
                    'content' => '<p>Menikmati matahari terbit (sunrise) langsung dari kamar hotel adalah pengalaman yang luar biasa. Di kawasan Ketapang dan Kalipuro, terdapat banyak hotel pinggir pantai yang menyajikan pemandangan langsung ke Selat Bali.</p><h3>Menatap Pulau Dewata</h3><p>Selain pemandangan laut yang biru dan siluet Pulau Bali di seberang, hotel-hotel ini juga strategis bagi Anda yang ingin menyeberang ke Bali via Pelabuhan Ketapang.</p>',
                    'image' => 'images/pulau-merah.png',
                    'status' => 'published',
                    'published_at' => now()->subDays(35),
                ]
            );
        }
    }
}
