<?php

namespace App\Filament\Pages;

use App\Helpers\ImageOptimizer;
use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompanyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Profil Nirwana';

    protected static ?string $title = 'Profil Nirwana & Tentang Kami';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-company-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSettingValues());
    }

    protected function getSettingValues(): array
    {
        $keys = [
            'company_legal_name',
            'company_founded_year',
            'company_legal_license',
            'company_domicile',
            'about_story_title',
            'about_description',
            'owner_name',
            'owner_role',
            'owner_quote',
            'owner_photo',
            'about_team_photo',
            'stat_years_count',
            'stat_years_label',
            'stat_tourists_count',
            'stat_tourists_label',
            'stat_trips_count',
            'stat_trips_label',
            'stat_legal_count',
            'stat_legal_label',
            'company_vision',
            'company_mission_1',
            'company_mission_2',
            'company_mission_3',
            'company_mission_4',
            'value_1_title',
            'value_1_desc',
            'value_2_title',
            'value_2_desc',
            'value_3_title',
            'value_3_desc',
            'value_4_title',
            'value_4_desc',
        ];

        $settings = SiteSetting::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        $defaults = [
            'company_legal_name' => 'Nirwana Tour Travel',
            'company_founded_year' => '2016 (8+ Tahun Pengalaman)',
            'company_legal_license' => 'Resmi OSS BKPM & TDUP',
            'company_domicile' => 'Bandar Lampung, Lampung',
            'about_story_title' => 'Berawal dari Kecintaan Mendalam pada Pesona Bumi Ruwa Jurai',
            'about_description' => "Nirwana Tour Lampung didirikan atas sebuah visi sederhana namun kuat: mengenalkan keindahan alam dan kekayaan budaya Lampung kepada wisatawan Nusantara dan mancanegara dengan standar layanan yang ramah, profesional, serta transparan.\n\nNama \"Nirwana\" terinspirasi dari keindahan surga bahari Lampung—mulai dari pasir putih Pulau Pahawang, atraksi lumba-lumba liar Teluk Kiluan, hingga megahnya tebing purba Gigi Hiu. Kami meyakini bahwa setiap perjalanan bukan sekadar mengunjungi tempat baru, melainkan proses merajut cerita indah yang dikenang seumur hidup.\n\nSelama lebih dari 8 tahun perjalanan, Nirwana Tour berkembang dari operator lokal menjadi biro perjalanan wisata berizin resmi dengan jejaring kemitraan luas, mencakup perhotelan bintang, armada transportasi pariwisata berstandar Dishub, pemandu bersertifikasi HPI, serta pengelola destinasi di berbagai penjuru Indonesia.",
            'owner_name' => 'Kiki M Alfin',
            'owner_role' => 'Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2016',
            'owner_quote' => 'Bagi kami, keberhasilan sebuah perjalanan bukan hanya tentang sampai di tujuan, tetapi bagaimana setiap tamu kami tersenyum bahagia dan merasa aman di setiap langkahnya.',
            'stat_years_count' => '8+',
            'stat_years_label' => 'Tahun Pengalaman',
            'stat_tourists_count' => '15.000+',
            'stat_tourists_label' => 'Wisatawan Terlayani',
            'stat_trips_count' => '500+',
            'stat_trips_label' => 'Trip Sukses Dijalankan',
            'stat_legal_count' => '100%',
            'stat_legal_label' => 'Legalitas Resmi',
            'company_vision' => 'Menjadi biro perjalanan wisata terdepan, tepercaya, dan bereputasi prima di Lampung serta Indonesia, yang dikenal atas keunggulan layanan, integritas bisnis, standar keselamatan tinggi, dan kontribusi nyata dalam memajukan potensi pariwisata lokal yang berkelanjutan.',
            'company_mission_1' => 'Pelayanan Profesional & Berhati: Menyediakan layanan wisata dengan keramahan khas Indonesia serta pendampingan tour leader yang terlatih dan berlisensi.',
            'company_mission_2' => 'Keselamatan Nomor Satu: Mengedepankan standar operasional prosedur (SOP) keselamatan ketat pada seluruh armada darat, kapal laut, dan aktivitas outdoor.',
            'company_mission_3' => 'Transparansi & Nilai Maksimal: Menghadirkan paket wisata berkualitas tinggi dengan rincian harga jujur tanpa biaya siluman (no hidden fees).',
            'company_mission_4' => 'Pemberdayaan Lokal Berkelanjutan: Menggandeng masyarakat setempat, pemandu lokal, dan UMKM daerah untuk memajukan ekosistem ekonomi pariwisata.',
            'value_1_title' => 'Integritas & Kejujuran',
            'value_1_desc' => 'Kami menjunjung tinggi keterbukaan informasi. Fasilitas, jadwal, dan biaya yang kami sampaikan di awal adalah apa yang benar-benar Anda terima di lapangan.',
            'value_2_title' => 'Keselamatan Utama',
            'value_2_desc' => 'Kesiapan armada prima, kelengkapan life jacket standar, kotak P3K lengkap, serta asuransi perjalanan menjamin ketenangan keluarga dan rombongan Anda.',
            'value_3_title' => 'Hospitalitas Tulus',
            'value_3_desc' => 'Senyum, sapa, dan kepedulian dari tim guide kami bukan sekadar tuntutan kerja, melainkan komitmen hati untuk membuat Anda merasa seperti keluarga.',
            'value_4_title' => 'Fleksibilitas Solutif',
            'value_4_desc' => 'Kami memahami kebutuhan setiap rombongan unik. Kami siap merancang itinerary kustom yang tepat guna sesuai durasi, preferensi, dan anggaran Anda.',
        ];

        return array_merge($defaults, $settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Profil Perusahaan')
                    ->tabs([
                        Tabs\Tab::make('Identitas & Legalitas')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('company_legal_name')
                                        ->label('Nama Badan Usaha / Brand')
                                        ->required()
                                        ->helperText('Contoh: Nirwana Tour Travel / PT Nirwana Tour Lampung'),
                                    TextInput::make('company_founded_year')
                                        ->label('Tahun Berdiri & Pengalaman')
                                        ->required()
                                        ->helperText('Contoh: 2016 (8+ Tahun Pengalaman)'),
                                    TextInput::make('company_legal_license')
                                        ->label('Legalitas & Perizinan Usaha')
                                        ->required()
                                        ->helperText('Contoh: Resmi OSS BKPM & TDUP'),
                                    TextInput::make('company_domicile')
                                        ->label('Domisili Kantor Operasional')
                                        ->required()
                                        ->helperText('Contoh: Bandar Lampung, Lampung'),
                                ]),
                            ]),

                        Tabs\Tab::make('Cerita & Pimpinan')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextInput::make('about_story_title')
                                    ->label('Judul Cerita / Sejarah Perusahaan')
                                    ->required()
                                    ->columnSpanFull(),
                                Textarea::make('about_description')
                                    ->label('Narasi Lengkap Cerita & Sejarah')
                                    ->rows(6)
                                    ->required()
                                    ->helperText('Gunakan baris baru untuk memisahkan paragraf cerita.')
                                    ->columnSpanFull(),
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
                                    ->required()
                                    ->columnSpanFull(),
                                Grid::make(2)->schema([
                                    FileUpload::make('owner_photo')
                                        ->label('Foto Pimpinan / Founder')
                                        ->disk('public')
                                        ->directory('settings')
                                        ->image()
                                        ->imageEditor()
                                        ->maxSize(51200)
                                        ->helperText('Maksimal 50 MB, otomatis dikompresi prima.')
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
                                    FileUpload::make('about_team_photo')
                                        ->label('Foto Tim & Manajemen Operasional')
                                        ->disk('public')
                                        ->directory('settings')
                                        ->image()
                                        ->imageEditor()
                                        ->maxSize(51200)
                                        ->helperText('Foto dokumentasi showcase tim yang muncul di samping cerita sejarah. Maksimal 50 MB.')
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
                            ]),

                        Tabs\Tab::make('Statistik Kinerja')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('stat_years_count')
                                        ->label('Statistik 1: Angka (Tahun)')
                                        ->required(),
                                    TextInput::make('stat_years_label')
                                        ->label('Statistik 1: Label')
                                        ->required(),

                                    TextInput::make('stat_tourists_count')
                                        ->label('Statistik 2: Angka (Wisatawan)')
                                        ->required(),
                                    TextInput::make('stat_tourists_label')
                                        ->label('Statistik 2: Label')
                                        ->required(),

                                    TextInput::make('stat_trips_count')
                                        ->label('Statistik 3: Angka (Trip)')
                                        ->required(),
                                    TextInput::make('stat_trips_label')
                                        ->label('Statistik 3: Label')
                                        ->required(),

                                    TextInput::make('stat_legal_count')
                                        ->label('Statistik 4: Angka (Legalitas)')
                                        ->required(),
                                    TextInput::make('stat_legal_label')
                                        ->label('Statistik 4: Label')
                                        ->required(),
                                ]),
                            ]),

                        Tabs\Tab::make('Visi & Misi')
                            ->icon('heroicon-o-flag')
                            ->schema([
                                Textarea::make('company_vision')
                                    ->label('Pernyataan Visi Perusahaan')
                                    ->rows(4)
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('company_mission_1')
                                    ->label('Poin Misi 1')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('company_mission_2')
                                    ->label('Poin Misi 2')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('company_mission_3')
                                    ->label('Poin Misi 3')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('company_mission_4')
                                    ->label('Poin Misi 4')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Nilai-Nilai Utama')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('value_1_title')
                                        ->label('Nilai 1: Judul Nilai')
                                        ->required(),
                                    Textarea::make('value_1_desc')
                                        ->label('Nilai 1: Deskripsi & Penerapan')
                                        ->rows(2)
                                        ->required(),

                                    TextInput::make('value_2_title')
                                        ->label('Nilai 2: Judul Nilai')
                                        ->required(),
                                    Textarea::make('value_2_desc')
                                        ->label('Nilai 2: Deskripsi & Penerapan')
                                        ->rows(2)
                                        ->required(),

                                    TextInput::make('value_3_title')
                                        ->label('Nilai 3: Judul Nilai')
                                        ->required(),
                                    Textarea::make('value_3_desc')
                                        ->label('Nilai 3: Deskripsi & Penerapan')
                                        ->rows(2)
                                        ->required(),

                                    TextInput::make('value_4_title')
                                        ->label('Nilai 4: Judul Nilai')
                                        ->required(),
                                    Textarea::make('value_4_desc')
                                        ->label('Nilai 4: Deskripsi & Penerapan')
                                        ->rows(2)
                                        ->required(),
                                ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'group' => 'about',
                    'label' => ucwords(str_replace('_', ' ', $key)),
                ]
            );
        }

        Cache::forget('nirwana_site_settings');

        Notification::make()
            ->title('Profil Nirwana Berhasil Disimpan!')
            ->body('Seluruh perubahan profil telah tersimpan dan langsung tampil di halaman website.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_on_web')
                ->label('Lihat di Web')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(route('profile'))
                ->openUrlInNewTab(),
        ];
    }
}
