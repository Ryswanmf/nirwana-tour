<?php

namespace App\Filament\Pages;

use App\Helpers\ImageOptimizer;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ManageHomePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Beranda';

    protected static ?string $title = 'Pengaturan Konten Beranda (Homepage)';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-home-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSettingValues());
    }

    protected function getSettingValues(): array
    {
        $keys = [
            'hero_badge',
            'hero_title',
            'hero_subtitle',
            'hero_cta_wa_text',
            'hero_cta_dest_text',
            'hero_feature_1',
            'hero_feature_2',
            'hero_feature_3',
            'owner_name',
            'owner_role',
            'owner_quote',
            'owner_photo',
            'about_company',
            'about_description',
            'stat_years_count',
            'stat_years_label',
            'stat_trips_count',
            'stat_trips_label',
            'stat_satisfaction_count',
            'stat_satisfaction_label',
            'stat_legal_count',
            'stat_legal_label',
            'google_maps_rating',
            'google_maps_reviews_count',
            'google_maps_review_url',
            'social_proof_headline',
            'address',
            'operating_hours',
            'google_maps_embed_url',
        ];

        $defaults = [
            'hero_badge' => 'Biro Perjalanan Wisata Resmi Lampung',
            'hero_title' => 'Selamat Datang di Website Nirwana Tour and Travel Lampung',
            'hero_subtitle' => 'Wujudkan momen liburan terbaik Anda bersama Nirwana Tour Lampung. Kami menghadirkan paket wisata eksotis, study tour edukatif, gathering perusahaan, serta persewaan armada transportasi nyaman dan profesional.',
            'hero_cta_wa_text' => 'Konsultasi via WhatsApp',
            'hero_cta_dest_text' => 'Lihat Destinasi',
            'hero_feature_1' => 'Legalitas Berizin Resmi',
            'hero_feature_2' => 'Armada Bus Nyaman & Terawat',
            'hero_feature_3' => 'Tour Leader Berpengalaman',
            'owner_name' => 'Kiki M Alfin',
            'owner_role' => 'Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2016',
            'owner_quote' => 'Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta.',
            'about_company' => 'Nirwana Tour Lampung adalah biro perjalanan wisata berizin resmi (TDUP & NIB) yang telah berpengalaman mendampingi ribuan wisatawan mengeksplorasi keindahan alam dan budaya Indonesia dengan pelayanan standar V.I.P yang aman, nyaman, dan berkesan.',
            'about_description' => 'Dengan pengalaman lebih dari 8 tahun, kami telah melayani ribuan pelanggan mulai dari keluarga, sekolah, universitas, instansi pemerintahan, hingga BUMN & perusahaan swasta nasional. Setiap rencana perjalanan kami susun secara terstruktur dengan pemandu berlisensi dan armada transportasi pariwisata terawat.',
            'stat_years_count' => '8',
            'stat_years_label' => 'Tahun Pengalaman',
            'stat_trips_count' => '1500',
            'stat_trips_label' => 'Trip Terlaksana',
            'stat_satisfaction_count' => '99',
            'stat_satisfaction_label' => 'Kepuasan Pelanggan',
            'stat_legal_count' => '100',
            'stat_legal_label' => 'Legalitas Resmi',
            'google_maps_rating' => '4.9',
            'google_maps_reviews_count' => '250+',
            'google_maps_review_url' => 'https://maps.google.com/?q=Nirwana+Tour+Lampung',
            'social_proof_headline' => 'Kepuasan 99% dari 500+ Rombongan',
            'address' => 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122',
            'operating_hours' => 'Senin - Sabtu: 08:00 - 17:00 WIB',
        ];

        $values = [];
        foreach ($keys as $key) {
            $values[$key] = SiteSetting::get($key, $defaults[$key] ?? null);
        }

        return $values;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan Beranda')
                    ->tabs([
                        Tabs\Tab::make('Hero & Banner Utama')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Section::make('Headline & Teks Hero')
                                    ->description('Konten teks yang pertama kali dilihat pengunjung saat membuka halaman depan website.')
                                    ->schema([
                                        TextInput::make('hero_badge')
                                            ->label('Badge Teks Kecil')
                                            ->placeholder('Contoh: Biro Perjalanan Wisata Resmi Lampung')
                                            ->helperText('Tampil di atas judul utama dalam badge burgundy berlatar transparan.'),
                                        TextInput::make('hero_title')
                                            ->label('Judul Utama Hero (Headline)')
                                            ->required()
                                            ->placeholder('Contoh: Jelajahi Dunia, Ciptakan Cerita'),
                                        Textarea::make('hero_subtitle')
                                            ->label('Subjudul / Deskripsi Hero')
                                            ->rows(3)
                                            ->required()
                                            ->placeholder('Jelaskan komitmen dan layanan unggulan Nirwana Tour...'),
                                    ]),

                                Section::make('Tombol Call-to-Action (CTA)')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('hero_cta_wa_text')
                                                ->label('Teks Tombol WhatsApp Utama')
                                                ->placeholder('Konsultasi via WhatsApp'),
                                            TextInput::make('hero_cta_dest_text')
                                                ->label('Teks Tombol Destinasi')
                                                ->placeholder('Lihat Destinasi'),
                                        ]),
                                    ]),

                                Section::make('3 Mini Highlight Keunggulan di Bawah Tombol Hero')
                                    ->description('Pilar kredibilitas ringkas berikon di bawah tombol aksi hero.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('hero_feature_1')
                                                ->label('Highlight 1')
                                                ->placeholder('Legalitas Berizin Resmi'),
                                            TextInput::make('hero_feature_2')
                                                ->label('Highlight 2')
                                                ->placeholder('Armada Bus Nyaman & Terawat'),
                                            TextInput::make('hero_feature_3')
                                                ->label('Highlight 3')
                                                ->placeholder('Tour Leader Berpengalaman'),
                                        ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Sambutan & Profil Beranda')
                            ->icon('heroicon-o-user-circle')
                            ->schema([
                                Section::make('Sambutan Hangat Pimpinan')
                                    ->description('Kutipan dan identitas pimpinan perusahaan di bagian Profil Beranda.')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('owner_name')
                                                ->label('Nama Pimpinan / Founder')
                                                ->required(),
                                            TextInput::make('owner_role')
                                                ->label('Jabatan Pimpinan')
                                                ->required(),
                                        ]),
                                        Textarea::make('owner_quote')
                                            ->label('Kutipan Sambutan Pimpinan')
                                            ->rows(3)
                                            ->required(),
                                        FileUpload::make('owner_photo')
                                            ->label('Foto Pimpinan Nirwana Tour')
                                            ->disk('public')
                                            ->directory('settings')
                                            ->image()
                                            ->imageEditor()
                                            ->imageCropAspectRatio('1:1')
                                            ->maxSize(51200)
                                            ->helperText('Format rasio 1:1 (Persegi). Otomatis dikompresi tanpa mengurangi ketajaman.')
                                            ->saveUploadedFileUsing(function (BaseFileUpload $component, TemporaryUploadedFile $file) {
                                                $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';
                                                $path = $file->{$storeMethod}(
                                                    $component->getDirectory(),
                                                    $component->getUploadedFileNameForStorage($file),
                                                    $component->getDiskName()
                                                );

                                                $fullPath = $component->getDisk()->path($path);
                                                ImageOptimizer::compress($fullPath);

                                                return $path;
                                            }),
                                    ]),

                                Section::make('Deskripsi Profil Perusahaan di Beranda')
                                    ->schema([
                                        Textarea::make('about_company')
                                            ->label('Paragraf Pengantar Profil')
                                            ->rows(3),
                                        Textarea::make('about_description')
                                            ->label('Paragraf Pengalaman & Dedikasi')
                                            ->rows(3),
                                    ]),

                                Section::make('4 Counter Angka Statistik Beranda')
                                    ->description('Angka pencapaian kredibilitas yang dianimasikan saat pengunjung scroll ke bagian profil.')
                                    ->schema([
                                        Grid::make(4)->schema([
                                            TextInput::make('stat_years_count')
                                                ->label('Tahun')
                                                ->numeric(),
                                            TextInput::make('stat_trips_count')
                                                ->label('Total Trip')
                                                ->numeric(),
                                            TextInput::make('stat_satisfaction_count')
                                                ->label('Kepuasan (%)')
                                                ->numeric(),
                                            TextInput::make('stat_legal_count')
                                                ->label('Legalitas (%)')
                                                ->numeric(),
                                        ]),
                                        Grid::make(4)->schema([
                                            TextInput::make('stat_years_label')
                                                ->label('Label Tahun'),
                                            TextInput::make('stat_trips_label')
                                                ->label('Label Trip'),
                                            TextInput::make('stat_satisfaction_label')
                                                ->label('Label Kepuasan'),
                                            TextInput::make('stat_legal_label')
                                                ->label('Label Legalitas'),
                                        ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Social Proof & Review')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Section::make('Integrasi Ulasan Google Maps')
                                    ->description('Data kredibilitas ulasan Google yang ditampilkan pada kartu rating kepercayaan.')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('google_maps_rating')
                                                ->label('Rating Bintang Google Maps')
                                                ->placeholder('4.9'),
                                            TextInput::make('google_maps_reviews_count')
                                                ->label('Jumlah Ulasan Google')
                                                ->placeholder('250+'),
                                            TextInput::make('social_proof_headline')
                                                ->label('Headline Kartu Kepercayaan')
                                                ->placeholder('Kepuasan 99% dari 500+ Rombongan'),
                                        ]),
                                        TextInput::make('google_maps_review_url')
                                            ->label('Link Review Google Maps')
                                            ->placeholder('https://maps.google.com/?q=Nirwana+Tour+Lampung')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tabs\Tab::make('Peta & Panduan Sinkronisasi')
                            ->icon('heroicon-o-arrows-right-left')
                            ->schema([
                                Section::make('Peta Lokasi Kantor')
                                    ->schema([
                                        TextInput::make('address')
                                            ->label('Alamat Kantor Resmi (Sinkron ke Beranda, Kontak, & Footer)')
                                            ->columnSpanFull(),
                                        TextInput::make('operating_hours')
                                            ->label('Jam Operasional Kantor')
                                            ->columnSpanFull(),
                                        Textarea::make('google_maps_embed_url')
                                            ->label('URL Iframe Embed Google Maps')
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Panduan Sinkronisasi Data Antar Halaman')
                                    ->description('Bagaimana data Beranda terhubung dan tersinkronisasi otomatis dengan halaman lain di website:')
                                    ->schema([
                                        Placeholder::make('sync_info')
                                            ->label('')
                                            ->content(new HtmlString('
                                                <div style="font-size: 0.88rem; line-height: 1.6; color: #475569;" class="space-y-3">
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #800020; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">1. Layanan Unggulan:</strong> Dikelola di menu <em>Layanan & Paket -> Layanan Wisata</em>. 4 layanan teratas otomatis tampil di Beranda, seluruhnya di <code>/layanan</code>, dan tautan di Footer.
                                                    </div>
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #059669; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">2. Paket Destinasi:</strong> Dikelola di menu <em>Layanan & Paket -> Paket Wisata</em>. Paket dengan toggle <em>"Paket Unggulan Beranda"</em> tampil di Beranda (maks 6 paket), dan seluruhnya tampil di <code>/paket-wisata</code> & <code>/destinasi</code>.
                                                    </div>
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #D97706; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">3. Galeri Video & Reels:</strong> Dikelola di menu <em>Konten & Informasi -> Galeri Dokumentasi</em>. Video dengan toggle <em>"Unggulan Beranda"</em> tampil di Marquee Beranda, sedangkan video lainnya tampil di <code>/galeri</code>.
                                                    </div>
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #2563EB; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">4. Berita & Tips Wisata:</strong> Dikelola di menu <em>Konten & Informasi -> Berita & Artikel</em>. Artikel dengan toggle <em>"Unggulan"</em> tampil 4 teratas di Beranda, dan seluruhnya di <code>/artikel</code>.
                                                    </div>
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #7C3AED; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">5. Mitra Rekanan & Testimoni:</strong> Dikelola di menu <em>Mitra Rekanan</em> dan <em>Testimoni</em>. Keduanya tampil di Beranda dan otomatis sinkron ke halaman <code>/manajemen</code> dan <code>/sertifikasi</code>.
                                                    </div>
                                                    <div style="padding: 10px 14px; background: #F8FAFC; border-left: 4px solid #DB2777; border-radius: 6px;">
                                                        <strong style="color: #0F172A;">6. Pembersihan Cache Otomatis:</strong> Setiap ada perubahan data di Filament, cache Beranda (<code>nirwana_home_data</code>) langsung dibersihkan otomatis, sehingga perubahan seketika tampil di web tanpa perlu refresh server!
                                                    </div>
                                                </div>
                                            ')),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_home_on_web')
                ->label('Lihat Beranda di Web')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url('/')
                ->openUrlInNewTab(),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            $group = match ($key) {
                'hero_badge', 'hero_title', 'hero_subtitle', 'hero_cta_wa_text', 'hero_cta_dest_text',
                'hero_feature_1', 'hero_feature_2', 'hero_feature_3' => 'home',
                'owner_name', 'owner_role', 'owner_quote', 'owner_photo',
                'about_company', 'about_description', 'stat_years_count', 'stat_years_label',
                'stat_trips_count', 'stat_trips_label', 'stat_satisfaction_count', 'stat_satisfaction_label',
                'stat_legal_count', 'stat_legal_label' => 'about',
                'google_maps_rating', 'google_maps_reviews_count', 'google_maps_review_url',
                'social_proof_headline' => 'social_proof',
                default => 'general',
            };

            SiteSetting::set($key, $value, null, $group);
        }

        Cache::forget('nirwana_home_data');
        Cache::forget('nirwana_site_settings');

        Notification::make()
            ->title('Pengaturan Beranda Berhasil Disimpan')
            ->body('Seluruh perubahan konten beranda telah tersimpan dan cache halaman beranda telah diperbarui seketika.')
            ->success()
            ->send();
    }
}
