<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fleet;
use App\Models\GalleryItem;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@nirwanatour.com'],
            [
                'name' => 'Admin Nirwana Tour',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Site Settings
        $settings = [
            'site_name' => 'Nirwana Tour Lampung',
            'tagline' => 'Jelajahi Dunia, Ciptakan Cerita',
            'whatsapp_number' => '6282269616188',
            'phone' => '0822-6961-6188',
            'email' => 'info@nirwanatour.com',
            'address' => 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122',
            'instagram' => 'https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet',
            'tiktok' => 'https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc',
            'youtube' => 'https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr',
            'operating_hours' => 'Senin - Sabtu: 08:00 - 17:00 WIB',
            'hero_title' => 'Jelajahi Dunia, Ciptakan Cerita',
            'hero_subtitle' => 'Biro perjalanan wisata resmi berizin di Bandar Lampung. Kami melayani paket tour Lampung, Jawa, Bali, study tour sekolah, family gathering kantor, dan sewa bus pariwisata eksekutif.',
            'about_company' => 'Nirwana Tour Lampung adalah biro perjalanan wisata berizin resmi (TDUP & NIB) yang telah berpengalaman lebih dari 8 tahun mendampingi ribuan wisatawan lokal maupun nusantara mengeksplorasi keindahan alam dan budaya Indonesia dengan pelayanan standar V.I.P yang aman, nyaman, dan berkesan.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'label' => ucwords(str_replace('_', ' ', $key))]);
        }

        // 3. Categories
        $catLampung = Category::firstOrCreate(['slug' => 'wisata-lampung'], ['name' => 'Wisata Lampung', 'type' => 'tour', 'description' => 'Paket destinasi pantai, pulau, dan eksotika alam Lampung.']);
        $catNusantara = Category::firstOrCreate(['slug' => 'wisata-nusantara'], ['name' => 'Wisata Nusantara', 'type' => 'tour', 'description' => 'Paket tour luar provinsi: Jawa Barat, Jogja, Bromo, Malang, dan Bali.']);
        $catEdukasi = Category::firstOrCreate(['slug' => 'study-tour-edukasi'], ['name' => 'Study Tour & Edukasi', 'type' => 'tour', 'description' => 'Paket edukasi, sekolah, universitas, dan kunjungan industri.']);
        $catTips = Category::firstOrCreate(['slug' => 'tips-wisata'], ['name' => 'Tips & Panduan', 'type' => 'article', 'description' => 'Panduan dan tips liburan aman dan menyenangkan.']);
        $catDestinasi = Category::firstOrCreate(['slug' => 'destinasi-wisata'], ['name' => 'Destinasi Wisata', 'type' => 'article', 'description' => 'Informasi pesona destinasi unggulan.']);
        $catStudyTour = Category::firstOrCreate(['slug' => 'study-tour'], ['name' => 'Study Tour & Edukasi', 'type' => 'article', 'description' => 'Wawasan kegiatan karya wisata pelajar.']);
        $catGathering = Category::firstOrCreate(['slug' => 'gathering-outbound'], ['name' => 'Gathering & Outbound', 'type' => 'article', 'description' => 'Inspirasi gathering dan team building perusahaan.']);
        $catKuliner = Category::firstOrCreate(['slug' => 'kuliner-oleh-oleh'], ['name' => 'Kuliner & Oleh-oleh', 'type' => 'article', 'description' => 'Rekomendasi kuliner khas dan oleh-oleh wajib.']);
        $catAkomodasi = Category::firstOrCreate(['slug' => 'akomodasi-transportasi'], ['name' => 'Akomodasi & Transportasi', 'type' => 'article', 'description' => 'Info seputar penginapan dan transportasi perjalanan.']);
        $catGaleri = Category::firstOrCreate(['slug' => 'dokumentasi-trip'], ['name' => 'Dokumentasi Perjalanan', 'type' => 'gallery', 'description' => 'Foto dan video keseruan rombongan.']);

        // 4. Tour Packages
        $packages = [
            [
                'title' => 'Pulau Pahawang Snorkeling Paradise',
                'slug' => 'pulau-pahawang-snorkeling-paradise',
                'category_id' => $catLampung->id,
                'badge' => 'Terfavorit',
                'destination_location' => 'Pesawaran, Lampung',
                'price_from' => 150000,
                'duration_days' => 1,
                'duration_nights' => 0,
                'min_pax' => 5,
                'summary' => 'Jelajahi surga bawah laut Pahawang, Cukuh Bedil, Kelagian Kecil, dan spot Nemo dengan terumbu karang warna-warni.',
                'description' => 'Paket wisata Pulau Pahawang adalah destinasi primadona Lampung. Nikmati pengalaman berenang bersama ikan Nemo, mengabadikan momen foto underwater, dan bersantai di pantai pasir putih Pulau Kelagian.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Eksplorasi Pahawang & Spot Underwater', 'activities' => '07.30 Meeting point Dermaga Ketapang -> 08.30 Menyeberang ke Pulau Kelagian Kecil -> 10.00 Snorkeling di Cukuh Bedil & Taman Nemo -> 12.00 Makan siang prasmanan seafood -> 13.30 Snorkeling Gosong Bekri & Pasir Timbul -> 16.00 Kembali ke dermaga Ketapang dan trip selesai.'],
                ],
                'includes' => ['Kapal tradisional snorkeling', 'Alat snorkeling lengkap (Fin, Masker, Snorkel)', 'Pelampung (Life Jacket)', 'Makan siang prasmanan', 'Air mineral & snack', 'Tiket masuk pulau', 'Dokumentasi underwater GoPro', 'Tour leader berlisensi'],
                'excludes' => ['Transportasi dari kota asal ke Dermaga Ketapang', 'Pengeluaran pribadi & oleh-oleh', 'Tipping kru kapal / guide (sukarela)'],
                'thumbnail' => 'assets/images/destinasi/pahawang.jpg',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Teluk Kiluan Dolphin Tour',
                'slug' => 'teluk-kiluan-dolphin-tour',
                'category_id' => $catLampung->id,
                'badge' => 'Petualangan',
                'destination_location' => 'Tanggamus, Lampung',
                'price_from' => 250000,
                'duration_days' => 2,
                'duration_nights' => 1,
                'min_pax' => 6,
                'summary' => 'Melihat kawanan lumba-lumba hidung botol berenang bebas di habitat aslinya dan berendam di kolam Laguna Gayau.',
                'description' => 'Teluk Kiluan menyajikan atraksi spektakuler lumba-lumba di laut lepas Samudera Hindia. Ditambah keindahan Laguna Gayau dan Pulau Kelapa yang memesona.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Perjalanan ke Kiluan & Sunset Laguna Gayau', 'activities' => '08.00 Berangkat dari Bandar Lampung -> 12.00 Tiba di Kiluan & makan siang -> 14.30 Trekking ke Laguna Gayau dan Pulau Kelapa -> 18.00 Istirahat dan santap malam.'],
                    ['day' => 2, 'title' => 'Hunting Lumba-lumba & Kembali', 'activities' => '06.00 Naik jukung tradisional ke laut lepas menyapa kawanan lumba-lumba -> 08.30 Sarapan di homestay -> 10.00 Checkout dan perjalanan kembali ke Bandar Lampung.'],
                ],
                'includes' => ['Transportasi mobil AC PP', 'Homestay 1 malam', 'Perahu Jukung hunting lumba-lumba', 'Makan 3 kali', 'Tiket masuk wisata & Laguna', 'Guide lokal & Tour Leader'],
                'excludes' => ['Keperluan pribadi', 'Asuransi di luar paket'],
                'thumbnail' => 'assets/images/destinasi/kiluan.jpg',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Pantai Gigi Hiu & Eksotisme Karang',
                'slug' => 'pantai-gigi-hiu-eksotisme-karang',
                'category_id' => $catLampung->id,
                'badge' => 'Fotografi',
                'destination_location' => 'Kelumbayan, Tanggamus',
                'price_from' => 350000,
                'duration_days' => 1,
                'duration_nights' => 0,
                'min_pax' => 4,
                'summary' => 'Gugusan tebing karang runcing nan magis menghadap deburan ombak Samudera Hindia, surga bagi pecinta lanskap fotografi.',
                'description' => 'Pantai Gigi Hiu (Pantai Pegadungan) menawarkan pemandangan tebing karang tajam menjulang yang tidak akan Anda temukan di tempat lain di Indonesia.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Ekspedisi Karang Gigi Hiu', 'activities' => '05.00 Berangkat pagi dari Bandar Lampung -> 09.30 Tiba dan ganti transportasi ojek offroad -> 10.30 Eksplorasi spot foto karang Gigi Hiu -> 13.00 Makan siang khas lokal -> 15.00 Perjalanan kembali ke kota.'],
                ],
                'includes' => ['Mobil 4x4 / Elf pariwisata', 'Ojek offroad lokal', 'Tiket masuk spot Gigi Hiu', 'Makan siang & kelapa muda', 'Guide lokal & dokumentasi'],
                'excludes' => ['Pengeluaran pribadi'],
                'thumbnail' => 'assets/images/destinasi/gigi-hiu.jpg',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Konservasi Way Kambas & Gajah Sumatra',
                'slug' => 'konservasi-way-kambas-gajah-sumatra',
                'category_id' => $catEdukasi->id,
                'badge' => 'Edukasi',
                'destination_location' => 'Lampung Timur',
                'price_from' => 220000,
                'duration_days' => 1,
                'duration_nights' => 0,
                'min_pax' => 10,
                'summary' => 'Belajar langsung tentang konservasi satwa langka Gajah Sumatra di Pusat Konservasi Gajah (PKG) terbesar di Asia Tenggara.',
                'description' => 'Paket edukatif yang sangat cocok untuk rombongan sekolah dan keluarga. Mengenal lebih dekat perilaku gajah, proses perlindungan habitat, dan memandikan gajah di sungai.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Eksplorasi Taman Nasional Way Kambas', 'activities' => '07.00 Berangkat dari Bandar Lampung -> 09.30 Tiba di PKG Way Kambas -> 10.00 Edukasi gajah & interaksi satwa -> 12.00 Makan siang -> 13.30 Naik safari boat susur sungai Way Kanan -> 15.30 Kembali ke Bandar Lampung.'],
                ],
                'includes' => ['Bus Pariwisata AC', 'Tiket masuk TN Way Kambas & Simaksi', 'Guide edukasi satwa', 'Makan siang box & air mineral', 'Dokumentasi rombongan'],
                'excludes' => ['Wahana mandikan gajah mandiri', 'Oleh-oleh'],
                'thumbnail' => 'assets/images/destinasi/way-kambas.jpg',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => 'Ekspedisi Vulkanik Krakatau',
                'slug' => 'ekspedisi-vulkanik-krakatau',
                'category_id' => $catLampung->id,
                'badge' => 'Petualangan',
                'destination_location' => 'Selat Sunda, Lampung Selatan',
                'price_from' => 450000,
                'duration_days' => 1,
                'duration_nights' => 0,
                'min_pax' => 8,
                'summary' => 'Jelajahi sejarah geologi dunia dan trekking ke lereng Gunung Anak Krakatau serta snorkeling di Pulau Sebesi.',
                'description' => 'Merasakan sensasi mendekati salah satu gunung berapi paling legendaris di bumi. Lengkap dengan snorkeling di spot terumbu karang Lagoon Cabe.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Trekking Krakatau & Lagoon Cabe', 'activities' => '06.30 Berkumpul di Dermaga Canti Kalianda -> 07.30 Berlayar speed boat ke Anak Krakatau -> 09.30 Pendaratan dan trekking lereng -> 11.30 Snorkeling di Lagoon Cabe -> 13.00 Makan siang di Pulau Sebesi -> 16.00 Kembali ke Kalianda.'],
                ],
                'includes' => ['Kapal charter Kalianda - Krakatau PP', 'Simaksi BKSDA Krakatau', 'Alat snorkeling & life jacket', 'Makan siang & snack laut', 'Ranger / Pemandu resmi'],
                'excludes' => ['Transport ke Dermaga Canti'],
                'thumbnail' => 'assets/images/destinasi/krakatau.jpg',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'Pesona Pantai & Surfing Pesisir Krui',
                'slug' => 'pesona-pantai-surfing-pesisir-krui',
                'category_id' => $catLampung->id,
                'badge' => 'Eksotik',
                'destination_location' => 'Pesisir Barat, Lampung',
                'price_from' => 550000,
                'duration_days' => 3,
                'duration_nights' => 2,
                'min_pax' => 6,
                'summary' => 'Eksplorasi pantai kelas dunia Krui, Pulau Pisang berpasir halus, dan spot surfing kelas internasional.',
                'description' => 'Pesisir Barat Lampung menyimpan keindahan pesisir menawan dengan ombak surfing kelas dunia, lumba-lumba liar di Pulau Pisang, dan kuliner khas gulai taboh.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Perjalanan Krui via Liwa', 'activities' => '07.00 Berangkat melintasi keindahan pegunungan Liwa -> 13.00 Makan siang dan tiba di Krui -> 15.30 Sunset di Pantai Labuhan Jukung.'],
                    ['day' => 2, 'title' => 'Menyeberang ke Pulau Pisang', 'activities' => '08.00 Kapal ke Pulau Pisang -> 09.30 Keliling pulau dengan cator lokal -> 14.00 Pantai Mandiri & Pantai Tanjung Setia.'],
                    ['day' => 3, 'title' => 'Belanja Oleh-oleh & Kembali', 'activities' => '09.00 Belanja kain tapis Krui & damar mata kucing -> 11.00 Perjalanan kembali ke Bandar Lampung.'],
                ],
                'includes' => ['Armada HiAce Premio AC', 'Resort pinggir pantai 2 malam', 'Kapal ke Pulau Pisang', 'Makan lengkap 7x', 'Tour Leader berpengalaman'],
                'excludes' => ['Sewa papan surfing & instruktur'],
                'thumbnail' => 'assets/images/destinasi/krui.jpg',
                'is_featured' => false,
                'order' => 6,
            ],
            [
                'title' => 'Jakarta - Bandung Juara & Kawah Putih',
                'slug' => 'jakarta-bandung-juara-kawah-putih',
                'category_id' => $catNusantara->id,
                'badge' => 'Populer',
                'destination_location' => 'DKI Jakarta & Jawa Barat',
                'price_from' => 1450000,
                'duration_days' => 3,
                'duration_nights' => 2,
                'min_pax' => 25,
                'summary' => 'Trip kombinasi Monas, Kota Tua Jakarta, Tangkuban Perahu, Floating Market Lembang, dan belanja Factory Outlet Bandung.',
                'description' => 'Paket favorit untuk rombongan instansi, dinas, dan sekolah dari Lampung menuju Jakarta dan Bandung. Perjalanan nyaman via tol Trans Jawa & penyeberangan kapal Eksekutif.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Lampung -> Jakarta City Tour -> Bandung', 'activities' => '05.00 Berangkat dari Lampung via Tol Bakauheni-Merak eksekutif -> 10.30 Tour Monas & Kota Tua Jakarta -> 14.00 Menuju Bandung via Cipularang -> 18.00 Check-in hotel & dinner kuliner Bandung.'],
                    ['day' => 2, 'title' => 'Eksplorasi Bandung Utara & Lembang', 'activities' => '08.00 Wisata The Great Asia Africa / Tangkuban Perahu -> 12.00 Makan siang -> 13.30 Floating Market Lembang -> 16.30 Wisata belanja Cihampelas & Dago.'],
                    ['day' => 3, 'title' => 'Belanja Oleh-oleh Kartika Sari -> Kembali', 'activities' => '08.30 Belanja oleh-oleh khas Bandung -> 11.00 Perjalanan kembali ke Lampung via Tol Trans Jawa.'],
                ],
                'includes' => ['Big Bus Pariwisata HDD Seat 2-2', 'Hotel Bintang 3 (2 malam)', 'Tiket Penyeberangan Kapal Eksekutif Merak-Bakauheni PP', 'Tiket semua destinasi wisata', 'Makan prasmanan sesuai program', 'Spanduk trip rombongan & dokumentasi foto/video'],
                'excludes' => ['Pengeluaran pribadi'],
                'thumbnail' => 'assets/images/destinasi/jakarta-bandung.jpg',
                'is_featured' => true,
                'order' => 7,
            ],
            [
                'title' => 'Pesona Yogyakarta Istimewa',
                'slug' => 'pesona-yogyakarta-istimewa',
                'category_id' => $catNusantara->id,
                'badge' => 'Best Seller',
                'destination_location' => 'DI Yogyakarta',
                'price_from' => 1650000,
                'duration_days' => 4,
                'duration_nights' => 3,
                'min_pax' => 30,
                'summary' => 'Menikmati kehangatan Malioboro, Candi Prambanan, Lava Tour Merapi Jeep, Tebing Breksi, dan HeHa Sky View.',
                'description' => 'Paket study tour dan gathering paling laris ke Yogyakarta. Menginap di hotel strategis dekat Malioboro, dilengkapi petualangan offroad Jeep Merapi.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Perjalanan Lampung ke Yogyakarta via Tol Trans Jawa', 'activities' => '06.00 Berangkat dari Lampung -> Penyeberangan Merak -> Full tol Trans Jawa -> 20.00 Tiba di Jogja & check-in hotel.'],
                    ['day' => 2, 'title' => 'Lava Tour Merapi, Candi Prambanan & Tebing Breksi', 'activities' => '08.00 Petualangan Jeep Lava Tour Merapi -> 12.00 Makan siang -> 13.30 Candi Prambanan -> 16.00 Sunset Tebing Breksi -> 19.00 Malioboro night walk.'],
                    ['day' => 3, 'title' => 'HeHa Sky View, Keraton & Sentra Bakpia', 'activities' => '08.30 Keraton Ngayogyakarta Hadiningrat -> 11.00 HeHa Sky View Patuk Gunungkidul -> 15.00 Sentra oleh-oleh Bakpia Kukus Tugu.'],
                    ['day' => 4, 'title' => 'Perjalanan Pulang ke Lampung', 'activities' => '07.30 Check-out dan perjalanan pulang menuju Lampung.'],
                ],
                'includes' => ['Big Bus Pariwisata SHD Mercedes-Benz', 'Hotel Bintang 3 Dekat Malioboro (3 Malam)', 'Tiket Masuk Semua Objek Wisata', 'Sewa Jeep Merapi (1 Jeep 4 orang)', 'Makan Prasmanan 10 Kali', 'Snack & Air Mineral setiap hari', 'Tour Leader & Kru Ramah'],
                'excludes' => ['Tips driver & crew (sukarela)'],
                'thumbnail' => 'assets/images/destinasi/jogja.jpg',
                'is_featured' => true,
                'order' => 8,
            ],
            [
                'title' => 'Eksotisme Malang & Bromo Sunrise',
                'slug' => 'eksotisme-malang-bromo-sunrise',
                'category_id' => $catNusantara->id,
                'badge' => 'Eksklusif',
                'destination_location' => 'Jawa Timur',
                'price_from' => 1850000,
                'duration_days' => 4,
                'duration_nights' => 3,
                'min_pax' => 25,
                'summary' => 'Menyaksikan golden sunrise Bromo dari Penanjakan 1, Pasir Berbisik, Kawah Bromo, Jatim Park, dan petik apel Batu Malang.',
                'description' => 'Petualangan spektakuler di tanah Jawa Timur. Rasakan dinginnya udara kawah Bromo dan serunya wisata edukasi dan petik apel di Kota Batu Malang.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Perjalanan Lampung ke Jawa Timur', 'activities' => '05.30 Berangkat dari Lampung -> Penyeberangan Eksekutif -> Tol Trans Jawa langsung menuju Malang.'],
                    ['day' => 2, 'title' => 'Jatim Park 3 & Museum Angkut Batu', 'activities' => '09.00 Wisata Dino Park Jatim Park 3 -> 13.00 Makan siang khas Malang -> 14.30 Museum Angkut Movie Star Studio -> 19.00 Istirahat persiapan Bromo.'],
                    ['day' => 3, 'title' => 'Midnight Bromo Golden Sunrise', 'activities' => '00.30 Naik Jeep Hardtop 4x4 menuju Penanjakan 1 Bromo -> 05.00 Golden Sunrise Bromo -> 07.00 Lautan Pasir Berbisik, Kawah Bromo & Bukit Teletubbies -> 12.00 Kembali ke hotel istirahat -> 15.00 Petik apel langsung di kebun petani Batu.'],
                    ['day' => 4, 'title' => 'Perjalanan Pulang ke Lampung', 'activities' => '08.00 Check-out dan perjalanan kembali ke Lampung via Tol Trans Jawa.'],
                ],
                'includes' => ['Armada Bus Pariwisata Kelas Eksekutif', 'Jeep Bromo 4x4 Resmi', 'Tiket Masuk TN Bromo Tengger Semeru & Jatim Park', 'Hotel Bintang 3 di Kota Batu (3 Malam)', 'Makan 10 Kali', 'Jaket / Perlengkapan hangat sewa (opsional)'],
                'excludes' => ['Sewa kuda di kawah Bromo', 'Keperluan pribadi'],
                'thumbnail' => 'assets/images/destinasi/bromo.jpg',
                'is_featured' => true,
                'order' => 9,
            ],
        ];

        foreach ($packages as $pkg) {
            TourPackage::updateOrCreate(['slug' => $pkg['slug']], $pkg);
        }

        // 5. Services
        $services = [
            [
                'title' => 'Paket Wisata Domestik & Lampung',
                'slug' => 'paket-wisata-domestik-lampung',
                'icon' => 'fa-solid fa-umbrella-beach',
                'short_description' => 'Eksplorasi destinasi unggulan Lampung, Jawa, Bali, dan Lombok dengan pilihan trip private maupun open trip bersama keluarga dan sahabat.',
                'full_description' => 'Kami mengorganisir paket tour komprehensif mulai dari tiket destinasi, reservasi hotel, kapal penyeberangan, konsumsi kuliner khas, hingga pemandu wisata lokal berlisensi.',
                'features' => ['Pilihan One Day Trip & Menginap', 'Jadwal Fleksibel (Custom Itinerary)', 'Harga All-In Tanpa Biaya Tersembunyi', 'Dokumentasi Foto & Video Trip'],
                'order' => 1,
            ],
            [
                'title' => 'Study Tour & Field Trip Sekolah',
                'slug' => 'study-tour-field-trip-sekolah',
                'icon' => 'fa-solid fa-graduation-cap',
                'short_description' => 'Perjalanan edukatif interaktif untuk siswa TK, SD, SMP, SMA, dan mahasiswa dengan kurikulum pembelajaran luar kelas yang terarah dan aman.',
                'full_description' => 'Dirancang khusus untuk institusi pendidikan dengan prioritas keselamatan siswa, asuransi perjalanan, pendampingan tour leader berpengalaman, dan koordinasi instansi.',
                'features' => ['Kunjungan Museum & Pusat Sains', 'Konservasi Way Kambas & Edukasi Lingkungan', 'Worksheet & Panduan Edukatif', 'Gratis untuk Guru Pendamping (S&K Berlaku)'],
                'order' => 2,
            ],
            [
                'title' => 'Family Gathering & Corporate Event',
                'slug' => 'family-gathering-corporate-event',
                'icon' => 'fa-solid fa-users-gear',
                'short_description' => 'Program penguatan tim (outbound teambuilding), family gathering perusahaan, gala dinner, dan kunjungan kerja kedinasan yang berkesan.',
                'full_description' => 'Solusi lengkap bagi perusahaan, BUMN, perbankan, dan instansi pemerintah yang membutuhkan manajemen acara outbound, fun games, sound system, MC profesional, dan hadiah.',
                'features' => ['Fasilitator Outbound Berpengalaman', 'Spanduk & Kaos Seragam Trip', 'Gala Dinner & Hiburan Musik', 'Laporan Pertanggungjawaban & Faktur Pajak Resmi'],
                'order' => 3,
            ],
            [
                'title' => 'Sewa Bus & Transportasi Pariwisata',
                'slug' => 'sewa-bus-transportasi-pariwisata',
                'icon' => 'fa-solid fa-bus',
                'short_description' => 'Layanan carter armada pariwisata modern: Toyota HiAce, Elf Long, Medium Bus, hingga Big Bus Jetbus SHD dengan driver profesional dan ramah.',
                'full_description' => 'Pilihan armada transportasi terawat dengan uji kelayakan berkala (KIR), fasilitas pendingin AC super sejuk, audio karaoke, USB charger tiap bangku, dan reclining seat empuk.',
                'features' => ['Armada Keluaran Terbaru', 'Driver Berpengalaman & Paham Rute', 'Asuransi Jasa Raharja', 'Harga Sewa Kompetitif Termasuk BBM'],
                'order' => 4,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 6. Fleets
        $fleets = [
            [
                'name' => 'Toyota HiAce Commuter / Premio',
                'type' => 'HiAce Microbus',
                'capacity' => '14 - 15 Kursi',
                'facilities' => ['AC Dingin Double Blower', 'Reclining Seat Nyaman', 'Audio Bluetooth & Mic Karaoke', 'USB Fast Charging', 'Kabin Bersih & Senyap'],
                'order' => 1,
            ],
            [
                'name' => 'Isuzu Elf Long Coaster',
                'type' => 'Elf Long',
                'capacity' => '17 - 19 Kursi',
                'facilities' => ['AC Ducting Tiap Baris', 'Reclining Seats', 'Bagasi Luas', 'Audio Multimedia TV LED', 'Suspensi Nyaman'],
                'order' => 2,
            ],
            [
                'name' => 'Medium Bus Executive Class',
                'type' => 'Medium Bus',
                'capacity' => '31 - 35 Kursi',
                'facilities' => ['Konfigurasi Seat 2-2', 'Layar TV LED & Subwoofer', 'Port USB Charger Tiap Kursi', 'Dispenser Air Panas', 'Bagasi Luas Bawah'],
                'order' => 3,
            ],
            [
                'name' => 'Big Bus HD / HDD Jetbus',
                'type' => 'Big Bus',
                'capacity' => '45 - 50 Kursi',
                'facilities' => ['Konfigurasi Seat 2-2 / 2-3', 'Air Conditioner Denso Dingin', 'Full Audio Karaoke & Mic', 'Bantal & Selimut Trip Jauh', 'Toilet Kabin (Opsional)'],
                'order' => 4,
            ],
            [
                'name' => 'Big Bus SHD Premium Mercedes-Benz',
                'type' => 'Big Bus SHD',
                'capacity' => '48 - 50 Kursi',
                'facilities' => ['Chassis Mercedes-Benz Air Suspension', 'Kaca Ganda Double Glass', 'Smoking Room & Toilet', 'Legrest / Sandaran Kaki', 'Wi-Fi Onboard'],
                'order' => 5,
            ],
        ];

        foreach ($fleets as $flt) {
            Fleet::updateOrCreate(['name' => $flt['name']], $flt);
        }

        // 7. Partners
        $partners = [
            ['name' => 'Bank Mandiri', 'category' => 'BUMN', 'order' => 1],
            ['name' => 'Telkom Indonesia', 'category' => 'BUMN', 'order' => 2],
            ['name' => 'PT Bukit Asam Tbk', 'category' => 'BUMN', 'order' => 3],
            ['name' => 'Universitas Lampung (Unila)', 'category' => 'Universitas', 'order' => 4],
            ['name' => 'Institut Teknologi Sumatera (ITERA)', 'category' => 'Universitas', 'order' => 5],
            ['name' => 'SMA Negeri 2 Bandar Lampung', 'category' => 'Sekolah', 'order' => 6],
            ['name' => 'SMP Al Kautsar Bandar Lampung', 'category' => 'Sekolah', 'order' => 7],
            ['name' => 'Pemerintah Provinsi Lampung', 'category' => 'Pemerintah', 'order' => 8],
            ['name' => 'Dinas Pariwisata & Ekonomi Kreatif Lampung', 'category' => 'Pemerintah', 'order' => 9],
            ['name' => 'ASITA Lampung', 'category' => 'Asosiasi', 'order' => 10],
        ];

        foreach ($partners as $ptr) {
            Partner::updateOrCreate(['name' => $ptr['name']], $ptr);
        }

        // 8. Testimonials
        $testimonials = [
            [
                'client_name' => 'Drs. Hendra Setiawan, M.Pd.',
                'organization' => 'SMA Negeri 2 Bandar Lampung',
                'role' => 'Wakil Kepala Sekolah Bidang Kesiswaan',
                'rating' => 5,
                'comment' => 'Study tour 180 siswa kami ke Yogyakarta dan Bandung berjalan sangat rapi, tepat waktu, dan aman. Driver bus sangat sabar dan tour leader Nirwana Tour sigap melayani kebutuhan siswa dari awal penyeberangan hingga pulang.',
                'trip_name' => 'Study Tour Jogja-Bandung 2025',
                'order' => 1,
            ],
            [
                'client_name' => 'Ratna Dewi Kusuma',
                'organization' => 'Divisi HRD Bank Mandiri Area Lampung',
                'role' => 'Ketua Panitia Gathering',
                'rating' => 5,
                'comment' => 'Family gathering tahunan karyawan di Pulau Pahawang sangat sukses! Games outbound-nya seru, makanan seafood-nya melimpah dan segar, serta dokumentasi drone dan foto underwater-nya keren banget. Recommended!',
                'trip_name' => 'Company Gathering Pahawang',
                'order' => 2,
            ],
            [
                'client_name' => 'Budi Prasetyo, S.T.',
                'organization' => 'Ikatan Alumni Universitas Lampung',
                'role' => 'Ketua Rombongan',
                'rating' => 5,
                'comment' => 'Pelayanan sewa bus pariwisatanya istimewa. Kondisi armada Big Bus Jetbus sangat bersih, AC dingin, dan suspensi empuk untuk perjalanan jauh ke Bromo-Malang. Tidak ada kendala teknis sama sekali.',
                'trip_name' => 'Reuni & Trip Bromo Malang',
                'order' => 3,
            ],
            [
                'client_name' => 'Siti Nurhaliza & Keluarga',
                'organization' => 'Wisatawan Asal Palembang',
                'role' => 'Family Trip',
                'rating' => 5,
                'comment' => 'Pertama kali bawa anak-anak ke Teluk Kiluan melihat lumba-lumba liar. Pelayanannya sangat ramah, homestay bersih dan pemandunya sangat teliti menjaga keselamatan kami di laut.',
                'trip_name' => 'Private Trip Teluk Kiluan',
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $tst) {
            Testimonial::updateOrCreate(['client_name' => $tst['client_name']], $tst);
        }

        // 9. Posts / Articles
        $posts = [
            [
                'title' => '5 Tips Snorkeling Aman dan Menyenangkan di Pulau Pahawang',
                'slug' => '5-tips-snorkeling-aman-di-pulau-pahawang',
                'category_id' => $catTips->id,
                'excerpt' => 'Panduan lengkap bagi pemula agar pengalaman snorkeling melihat terumbu karang dan nemo di Pahawang tetap aman, nyaman, dan ramah lingkungan.',
                'content' => 'Pulau Pahawang terkenal dengan keindahan terumbu karang dan taman ikannya. Sebelum menceburkan diri ke laut, berikut 5 tips penting yang perlu Anda perhatikan: 1. Selalu gunakan pelampung (life jacket) yang terkancing pas di badan. 2. Periksa masker snorkeling agar tidak bocor dan gunakan teknik defogging sederhana. 3. Jangan pernah menginjak atau memegang karang hidup. 4. Gunakan tabir surya (sunscreen) yang ramah terumbu karang (reef-safe). 5. Selalu ikuti arahan tour guide dan jangan berenang sendirian menjauhi kelompok kapal.',
                'cover_image' => 'assets/images/destinasi/pahawang.jpg',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Waktu Terbaik Menyaksikan Atraksi Lumba-lumba di Teluk Kiluan',
                'slug' => 'waktu-terbaik-menyaksikan-lumba-lumba-teluk-kiluan',
                'category_id' => $catDestinasi->id,
                'excerpt' => 'Ketahui jam dan musim paling pas untuk melihat ratusan lumba-lumba melompat bebas di perairan Samudera Hindia Teluk Kiluan.',
                'content' => 'Teluk Kiluan adalah salah satu titik pertemuan kawanan lumba-lumba terbesar di Indonesia. Waktu terbaik untuk memulai perjalanan jukung ke laut lepas adalah pukul 06.00 hingga 08.00 pagi saat laut masih tenang dan ikan-ikan kecil naik ke permukaan. Musim kemarau (April hingga Oktober) merupakan momen ideal dengan cuaca cerah dan ombak yang ramah.',
                'cover_image' => 'assets/images/destinasi/kiluan.jpg',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Panduan Lengkap Memilih Armada Bus Pariwisata untuk Rombongan Sekolah',
                'slug' => 'panduan-memilih-bus-pariwisata-rombongan-sekolah',
                'category_id' => $catStudyTour->id,
                'excerpt' => 'Faktor keselamatan, legalitas izin trayek, dan fasilitas yang wajib diperiksa pihak sekolah sebelum menyewa bus study tour.',
                'content' => 'Keselamatan siswa adalah prioritas utama setiap kegiatan study tour. Pastikan perusahaan otobus memiliki izin resmi SPIONAM Kemenhub, uji berkala KIR aktif, driver berpengalaman memiliki SIM resmi, serta fasilitas kenyamanan memadai seperti rem darurat, APAR, dan palu pemecah kaca.',
                'cover_image' => 'assets/images/destinasi/jakarta-bandung.jpg',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Eksotisme Karang Purba Pantai Gigi Hiu: Panduan dan Spot Foto Terbaik',
                'slug' => 'eksotisme-karang-purba-pantai-gigi-hiu-panduan-spot-foto',
                'category_id' => $catDestinasi->id,
                'excerpt' => 'Panduan lengkap berwisata ke tebing karang runcing nan magis Pantai Gigi Hiu Kelumbayan, mulai dari rute akses hingga waktu pasang surut terbaik.',
                'content' => 'Pantai Gigi Hiu di Kecamatan Kelumbayan, Tanggamus, dikenal sebagai salah satu lanskap alam paling dramatis di Indonesia. Gugusan tebing karang yang menjulang runcing bagaikan deretan gigi hiu purba menjadi daya tarik utama bagi fotografer dan pecinta petualangan. Untuk mencapai lokasi ini dengan aman, gunakan kendaraan berpenggerak 4x4 atau sewa pemandu lokal yang memahami jalur pesisir pantai. Momen terbaik berkunjung adalah saat matahari terbit (sunrise) atau senja menjelang terbenam, saat deburan ombak Samudera Hindia membentur batuan karang menghasilkan kabut air yang dramatis. Jangan lupa membawa alas kaki anti-selip dan kamera terlindung dari cipratan air asin.',
                'cover_image' => 'assets/images/destinasi/gigi-hiu.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Paket Study Tour Edukasi ke Jogja & Bandung: Persiapan Matang untuk Sekolah',
                'slug' => 'paket-study-tour-edukasi-jogja-bandung-persiapan-sekolah',
                'category_id' => $catStudyTour->id,
                'excerpt' => 'Kiat menyusun agenda karya wisata edukatif untuk siswa sekolah ke Yogyakarta dan Bandung yang aman, berwawasan, dan sarat nilai sejarah.',
                'content' => 'Study tour sekolah adalah momen pembelajaran berharga di luar ruang kelas. Saat merencanakan perjalanan siswa ke destinasi edukatif seperti Candi Prambanan di Jogja atau Museum Geologi dan Saung Angklung Udjo di Bandung, ada beberapa hal krusial yang perlu dipersiapkan secara matang: 1. Penyusunan Lembar Kerja Siswa (LKPD) agar kunjungan memiliki target capaian edukatif yang jelas. 2. Pemilihan biro perjalanan wisata berizin resmi yang menyediakan asuransi perjalanan, tenaga medis pendamping, dan armada bus berstandar kelaikan jalan Kemenhub. 3. Manajemen jadwal istirahat yang seimbang agar kesehatan fisik siswa tetap terjaga selama perjalanan lintas pulau.',
                'cover_image' => 'assets/images/destinasi/jogja.jpg',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Tips Memilih Paket Outbound & Family Gathering Perusahaan di Lampung',
                'slug' => 'tips-memilih-paket-outbound-family-gathering-perusahaan-lampung',
                'category_id' => $catGathering->id,
                'excerpt' => 'Cara merancang acara gathering kantor dan team building di resort pesisir Lampung yang menyenangkan, kompak, dan berkesan untuk seluruh karyawan.',
                'content' => 'Gathering kantor merupakan investasi penting untuk menyegarkan pikiran karyawan sekaligus mempererat sinergi antardivisi. Kawasan pesisir Lampung menawarkan banyak pilihan resort tepi pantai yang sangat ideal untuk kegiatan outdoor team building, gala dinner malam keakraban, hingga fun games di atas pasir putih. Pastikan Anda memilih event organizer perjalanan yang menyediakan fasilitator fun games profesional, sound system memadai, perlengkapan medis darurat, serta dokumentasi foto dan video drone untuk mengabadikan momen kebersamaan perusahaan Anda.',
                'cover_image' => 'assets/images/destinasi/krui.jpg',
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }

        // 10. Gallery Items
        for ($i = 1; $i <= 6; $i++) {
            GalleryItem::updateOrCreate(
                ['file_path' => "assets/images/galeri/galeri-{$i}.jpg"],
                [
                    'title' => "Dokumentasi Trip Nirwana {$i}",
                    'category_id' => $catGaleri->id,
                    'media_type' => 'image',
                    'thumbnail' => "assets/images/galeri/galeri-{$i}.jpg",
                    'caption' => "Keseruan rombongan peserta menjelajahi keindahan wisata bersama tim Nirwana Tour Lampung.",
                    'order' => $i,
                ]
            );
        }

        $videos = [
            [
                'file_path' => 'assets/images/galeri/video1.mp4',
                'title' => 'Wisata Bahari & Snorkeling Pulau Pahawang',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video1-poster.jpg',
                'caption' => 'Eksotisme terumbu karang alami dan berenang bersama ikan badut (Nemo) di perairan jernih Pulau Pahawang.',
                'order' => 1,
            ],
            [
                'file_path' => 'assets/images/galeri/video2.mp4',
                'title' => 'Study Tour & Karya Wisata Edukatif Sekolah',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video2-poster.jpg',
                'caption' => 'Momen ceria dan kebersamaan para siswa saat menjelajahi destinasi sejarah, sains, dan kebudayaan nusantara.',
                'order' => 2,
            ],
            [
                'file_path' => 'assets/images/galeri/video3.mp4',
                'title' => 'Momen Liburan & Relaksasi Tropis Rombongan',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video3-poster.jpg',
                'caption' => 'Keseruan rombongan berlayar menikmati panorama bahari, deburan ombak tropis, dan matahari terbenam.',
                'order' => 3,
            ],
            [
                'file_path' => 'assets/images/galeri/video4.mp4',
                'title' => 'Family Gathering & Outbound Perusahaan',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video4-poster.jpg',
                'caption' => 'Keseruan aktivitas team building, fun games pantai, dan kehangatan kebersamaan keluarga besar perusahaan.',
                'order' => 4,
            ],
            [
                'file_path' => 'assets/images/galeri/video5.mp4',
                'title' => 'Safari Lumba-Lumba Liar Teluk Kiluan',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video5-poster.jpg',
                'caption' => 'Menyaksikan langsung kawanan lumba-lumba liar melompat ceria menyambut perahu katir di perairan Teluk Kiluan.',
                'order' => 5,
            ],
            [
                'file_path' => 'assets/images/galeri/video6.mp4',
                'title' => 'Ekowisata Konservasi Gajah TN Way Kambas',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video6-poster.jpg',
                'caption' => 'Interaksi edukatif dan safari alam mengenal gajah sumatera di Pusat Latihan Gajah Taman Nasional Way Kambas.',
                'order' => 6,
            ],
            [
                'file_path' => 'assets/images/galeri/video7.mp4',
                'title' => 'Eksotisme Karang Purba Pantai Gigi Hiu',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video7-poster.jpg',
                'caption' => 'Mahakarya alam gugusan tebing karang runcing nan dramatis dihantam deburan ombak Samudera Hindia di Pegadungan.',
                'order' => 7,
            ],
            [
                'file_path' => 'assets/images/galeri/video8.mp4',
                'title' => 'Pesona Sunrise Bromo & Malang Tour',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video8-poster.jpg',
                'caption' => 'Petualangan jeep 4x4 menembus lautan pasir dan menyaksikan keagungan matahari terbit dari puncak Penanjakan Bromo.',
                'order' => 8,
            ],
            [
                'file_path' => 'assets/images/galeri/video9.mp4',
                'title' => 'Wisata Budaya & Candi Heritage Yogyakarta',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video9-poster.jpg',
                'caption' => 'Eksplorasi kemegahan warisan peradaban nusantara di Candi Prambanan, Malioboro, dan pesona keraton Jogja.',
                'order' => 9,
            ],
            [
                'file_path' => 'assets/images/galeri/video10.mp4',
                'title' => 'Ekspedisi Bahari Gunung Anak Krakatau',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video10-poster.jpg',
                'caption' => 'Jelajah perairan Selat Sunda, snorkeling pulau Sebesi, dan menyaksikan keajaiban geologi Gunung Anak Krakatau.',
                'order' => 10,
            ],
            [
                'file_path' => 'assets/images/galeri/video11.mp4',
                'title' => 'Surfing & Pesona Pesisir Barat Krui',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video11-poster.jpg',
                'caption' => 'Menikmati surga ombak kelas dunia dan keindahan pantai pasir putih eksotis di Krui Pesisir Barat Lampung.',
                'order' => 11,
            ],
            [
                'file_path' => 'assets/images/galeri/video12.mp4',
                'title' => 'Edukasi & City Tour Jakarta - Bandung',
                'category_id' => $catGaleri->id,
                'media_type' => 'video',
                'thumbnail' => 'assets/images/galeri/video12-poster.jpg',
                'caption' => 'Karya wisata rombongan pelajar mengunjungi museum sains nasional, Monas, Floating Market, dan sejuknya Lembang.',
                'order' => 12,
            ],
        ];

        foreach ($videos as $video) {
            GalleryItem::updateOrCreate(['file_path' => $video['file_path']], $video);
        }
    }
}
