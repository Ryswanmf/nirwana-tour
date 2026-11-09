<?php

namespace App\Services;

use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleGeneratorService
{
    /**
     * Fallback gambar lokal destinasi jika tidak ada foto upload atau galeri
     */
    protected array $defaultAssets = [
        'assets/images/destinasi/pahawang.jpg',
        'assets/images/destinasi/kiluan.jpg',
        'assets/images/destinasi/krakatau.jpg',
        'assets/images/destinasi/gigi-hiu.jpg',
        'assets/images/destinasi/way-kambas.jpg',
        'assets/images/destinasi/pantai-klara.jpg',
        'assets/images/destinasi/pantai-mutun.jpg',
    ];

    /**
     * Generate banyak artikel sekaligus dengan penjadwalan & pengacakan gambar
     *
     * @param array<int, string> $titles
     * @param array<int, UploadedFile> $uploadedFiles
     * @param array $options
     * @param string|null $authorName
     * @return array{count: int, posts: array, first_date: string, last_date: string}
     */
    public function generateBatch(
        array $titles,
        array $uploadedFiles = [],
        array $options = [],
        ?string $authorName = 'Admin Nirwana'
    ): array {
        $cleanTitles = array_values(array_filter(array_map('trim', $titles), fn ($t) => !empty($t)));
        if (empty($cleanTitles)) {
            return ['count' => 0, 'posts' => [], 'first_date' => '', 'last_date' => ''];
        }

        // 1. Simpan & kumpulkan gambar pool
        $imagePool = $this->prepareImagePool($uploadedFiles);

        // 2. Acak urutan gambar pool
        shuffle($imagePool);

        // 3. Konfigurasi penjadwalan
        $startDate = !empty($options['start_date']) 
            ? Carbon::parse($options['start_date']) 
            : Carbon::today();
        
        $intervalDays = isset($options['interval_days']) ? (int) $options['interval_days'] : 1;
        $isPublished = ($options['status'] ?? 'published') === 'published';
        $categoryId = !empty($options['category_id']) ? (int) $options['category_id'] : null;
        $defaultCategoryName = $options['category_name'] ?? 'Tips Wisata';

        $createdPosts = [];
        $totalImages = count($imagePool);

        foreach ($cleanTitles as $index => $title) {
            // Tentukan gambar acak dari pool
            $chosenImage = $totalImages > 0 ? $imagePool[$index % $totalImages] : 'assets/images/destinasi/pahawang.jpg';

            // Hitung jadwal rilis (drip feeding)
            $publishDate = $this->calculatePublishDate($startDate, $index, $intervalDays);

            // Tentukan kategori relevan jika belum dipilih secara spesifik
            $categoryName = $this->detectCategoryName($title, $defaultCategoryName);

            // Buat konten berstruktur SEO
            $content = $this->synthesizeSeoArticleContent($title, $categoryName);
            $excerpt = $this->generateExcerpt($title, $categoryName);

            // Buat slug unik
            $slug = $this->generateUniqueSlug($title);

            $post = Post::create([
                'title' => $title,
                'slug' => $slug,
                'category_id' => $categoryId,
                'category_name' => $categoryName,
                'excerpt' => $excerpt,
                'content' => $content,
                'cover_image' => $chosenImage,
                'author_name' => $authorName ?: 'Admin Nirwana',
                'is_published' => $isPublished,
                'is_featured' => $index === 0 && ($options['feature_first'] ?? false),
                'published_at' => $publishDate,
                'views_count' => rand(15, 65),
            ]);

            $createdPosts[] = [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'published_at' => $publishDate->format('d M Y, H:i'),
                'is_published' => $post->is_published,
                'cover_image' => $post->cover_image,
            ];
        }

        // Bersihkan cache beranda agar data tersinkron
        Cache::forget('nirwana_home_data');

        $firstDate = $createdPosts[0]['published_at'] ?? '';
        $lastDate = end($createdPosts)['published_at'] ?? '';

        return [
            'count' => count($createdPosts),
            'posts' => $createdPosts,
            'first_date' => $firstDate,
            'last_date' => $lastDate,
        ];
    }

    /**
     * Siapkan pool gambar: menyimpan foto yang diunggah dan memadukan dengan galeri yang ada
     */
    protected function prepareImagePool(array $uploadedFiles): array
    {
        $pool = [];

        // Simpan foto yang diunggah
        foreach ($uploadedFiles as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $path = $file->store('posts', 'public');
                $pool[] = $path;
            }
        }

        // Ambil gambar dari galeri yang sudah ada di database sebagai suplemen/fallback
        $existingGallery = GalleryItem::where('media_type', 'image')
            ->whereNotNull('file_path')
            ->pluck('file_path')
            ->filter()
            ->all();

        foreach ($existingGallery as $gal) {
            if (!in_array($gal, $pool)) {
                $pool[] = $gal;
            }
        }

        // Jika pool masih kosong, gunakan aset destinasi default
        if (empty($pool)) {
            $pool = $this->defaultAssets;
        }

        return $pool;
    }

    /**
     * Hitung tanggal rilis bertahap dengan jam tayang optimal (antara 08:30 - 10:45 pagi)
     */
    protected function calculatePublishDate(Carbon $startDate, int $index, int $intervalDays): Carbon
    {
        $date = $startDate->copy();

        if ($intervalDays > 0) {
            $date->addDays($index * $intervalDays);
        }

        // Berikan jam tayang natural di pagi hari
        $hour = 8 + ($index % 3);
        $minute = (15 * ($index % 4)) % 60;
        $date->setTime($hour, $minute, 0);

        return $date;
    }

    /**
     * Deteksi nama kategori dari kata kunci judul jika kategori bawaan masih umum
     */
    protected function detectCategoryName(string $title, string $default): string
    {
        $lower = strtolower($title);

        if (Str::contains($lower, ['tips', 'panduan', 'cara', 'persiapan', 'rekomendasi'])) {
            return 'Tips Wisata';
        }

        if (Str::contains($lower, ['kuliner', 'makanan', 'makan', 'khas', 'oleh-oleh', 'kemplang', 'pempek', 'kopi'])) {
            return 'Kuliner & Oleh-Oleh';
        }

        if (Str::contains($lower, ['paket', 'open trip', 'private trip', 'sewa', 'rental', 'armada', 'bus'])) {
            return 'Paket & Transportasi';
        }

        if (Str::contains($lower, ['pantai', 'pulau', 'snorkeling', 'pahawang', 'kiluan', 'krakatau', 'pesawaran', 'air terjun'])) {
            return 'Destinasi Wisata';
        }

        return $default ?: 'Info Wisata';
    }

    /**
     * Hasilkan slug unik yang aman dari benturan di database
     */
    protected function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'artikel-' . time();
        $slug = $base;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Buat ringkasan / excerpt artikel untuk meta description SEO
     */
    protected function generateExcerpt(string $title, string $category): string
    {
        return "Rangkuman informasi lengkap seputar {$title}. Temukan rute terbaik, tips praktis, perkiraan biaya, dan panduan liburan seru bersama Nirwana Tour Lampung.";
    }

    /**
     * Sintesis isi konten artikel SEO-friendly lengkap dengan tag HTML editorial
     */
    protected function synthesizeSeoArticleContent(string $title, string $category): string
    {
        $safeTitle = e($title);
        $safeCategory = e($category);

        return <<<HTML
<p>Provinsi Lampung senantiasa menjadi magnet wisata unggulan di Pulau Sumatera berkat gugusan pulau eksotis, keindahan terumbu karang bawah laut, serta kekayaan budaya dan kuliner yang begitu memikat. Dalam ulasan kali ini, kita akan mengupas secara mendalam tentang <strong>{$safeTitle}</strong> sebagai referensi utama Anda merencanakan liburan istimewa.</p>

<h2>Pesona & Daya Tarik Utama</h2>
<p>Eksplorasi pariwisata Lampung menghadirkan perpaduan panorama laut biru toska, udara pantai yang menyegarkan, serta keramahan warga lokal yang selalu menyambut hangat setiap pelancong. Daya tarik kawasan ini sangat cocok dinikmati baik bersama keluarga tercinta, sahabat petualang, komunitas, hingga kegiatan <em>gathering</em> instansi atau perusahaan.</p>
<p>Keunikan lanskap alam serta keanekaragaman biota lautnya menjadi alasan utama mengapa destinasi ini selalu ramai diminati oleh wisatawan nusantara maupun mancanegara pada akhir pekan dan musim liburan panjang.</p>

<h2>Rekomendasi Aktivitas Seru yang Wajib Dicoba</h2>
<ul>
    <li><strong>Snorkeling & Menikmati Pesona Bawah Laut:</strong> Saksikan terumbu karang yang terjaga kelestariannya dan bercengkerama dengan kawanan ikan nemo yang ramah di spot-spot underwater terbaik.</li>
    <li><strong>Berburu Foto Estetik & Instagramable:</strong> Abadikan momen terbaik Anda dengan latar pasir pantai putih bersih, gradasi air laut berkilau, dan perbukitan hijau asri.</li>
    <li><strong>Jelajah Kuliner & Oleh-Oleh Khas:</strong> Lengkapi pengalaman perjalanan dengan mencicipi sajian laut segar, olahan seruit khas Lampung, dan keripik pisang aneka rasa yang melegenda.</li>
    <li><strong>Watersport & Island Hopping:</strong> Nikmati sensasi berkeliling pulau menggunakan perahu tradisional berstandar keselamatan lengkap.</li>
</ul>

<h2>Rute, Akses & Waktu Terbaik untuk Berkunjung</h2>
<p>Akses menuju spot wisata ini terbilang cukup mudah dan strategis. Dari pusat Kota Bandar Lampung, perjalanan darat dapat ditempuh dengan kendaraan roda empat maupun bus pariwisata dalam waktu sekitar 1 hingga 2 jam. Tersedia jalan beraspal yang mulus dengan pemandangan perbukitan dan pesisir teluk yang memanjakan mata di sepanjang perjalanan.</p>
<p>Waktu paling ideal untuk berkunjung adalah pada pagi hari sekitar pukul 07.30 hingga 11.00 WIB atau menjelang sore hari saat matahari mulai teduh. Kondisi cuaca cerah di musim kemarau (April hingga Oktober) menjadi saat paling sempurna untuk aktivitas bahari dan dokumentasi visual.</p>

<h2>Tips Praktis Liburan Nyaman & Aman</h2>
<ol>
    <li>Gunakan pakaian santai yang mudah menyerap keringat serta alas kaki pantai yang tidak licin.</li>
    <li>Siapkan tabir surya (sunscreen), kacamata hitam, dan dry bag untuk melindungi barang elektronik Anda dari percikan air.</li>
    <li>Bawa uang tunai secukupnya untuk transaksi di warung lokal atau penyewaan fasilitas pendukung di area wisata.</li>
    <li>Selalu patuhi arahan pemandu wisata lokal dan jaga kebersihan lingkungan dengan tidak membuang sampah sembarangan.</li>
</ol>

<div class="my-8 p-6 bg-pink-50 border border-pink-200 rounded-2xl shadow-xs">
    <h3 class="text-lg font-extrabold text-[#DE0171] mb-2">Liburan Bebas Ribet Bersama Nirwana Tour Lampung</h3>
    <p class="text-sm text-slate-700 leading-relaxed mb-4">Ingin merasakan pengalaman liburan seru ke destinasi terbaik Lampung dengan fasilitas lengkap, armada transportasi ber-AC yang nyaman, pemandu berpengalaman, serta bonus dokumentasi foto dan video drone underwater berkualitas? Nirwana Tour Lampung siap mewujudkan perjalanan tak terlupakan untuk Anda dan rombongan!</p>
    <a href="https://wa.me/6282179881004?text=Halo%20Nirwana%20Tour,%20saya%20tertarik%20dengan%20paket%20wisata%20terkait:%20{$safeTitle}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white font-bold text-xs shadow-md hover:opacity-95 transition">
        Konsultasi Paket & Reservasi via WhatsApp
    </a>
</div>

<h2>Pertanyaan yang Sering Diajukan (FAQ)</h2>
<p><strong>Apakah rute ini aman untuk anak-anak dan lansia?</strong><br>Ya, jalur penyeberangan dan fasilitas dermaga kini sangat terawat dan didampingi pemandu berlisensi yang mengutamakan keselamatan peserta.</p>
<p><strong>Apakah tersedia fasilitas ruang ganti dan toilet bersih di lokasi?</strong><br>Tentu saja, di sebagian besar pulau dan pos pemberhentian wisata telah tersedia fasilitas bilas, toilet, mushola, serta warung santap yang memadai.</p>
HTML;
    }
}
