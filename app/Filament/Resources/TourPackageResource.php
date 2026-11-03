<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourPackageResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\TourPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TourPackageResource extends Resource
{
    protected static ?string $model = TourPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Manajemen Wisata & Reservasi';

    protected static ?string $navigationLabel = 'Paket & Destinasi';

    protected static ?string $modelLabel = 'Paket Wisata';

    protected static ?string $pluralModelLabel = 'Paket Wisata';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->description('Detail nama, kategori, dan lokasi destinasi paket wisata')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Nama Paket Wisata')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),
                        Grid::make(3)->schema([
                            Select::make('category_id')
                                ->label('Kategori')
                                ->relationship('category', 'name', fn (Builder $query) => $query->where('type', 'tour'))
                                ->searchable()
                                ->preload()
                                ->required(),
                            TextInput::make('badge')
                                ->label('Badge Label')
                                ->placeholder('Contoh: Terfavorit, Best Seller, Edukasi'),
                            TextInput::make('destination_location')
                                ->label('Lokasi Destinasi')
                                ->placeholder('Contoh: Pesawaran, Lampung / DI Yogyakarta'),
                        ]),
                    ]),

                Section::make('Harga & Kapasitas')
                    ->schema([
                        Grid::make(4)->schema([
                            TextInput::make('price_from')
                                ->label('Harga Mulai Dari (Rp)')
                                ->numeric()
                                ->prefix('Rp')
                                ->required(),
                            TextInput::make('duration_days')
                                ->label('Jumlah Hari')
                                ->numeric()
                                ->default(1)
                                ->required(),
                            TextInput::make('duration_nights')
                                ->label('Jumlah Malam')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('min_pax')
                                ->label('Minimal Peserta (Pax)')
                                ->numeric()
                                ->default(1)
                                ->required(),
                        ]),
                    ]),

                Section::make('Deskripsi & Ringkasan')
                    ->schema([
                        Textarea::make('summary')
                            ->label('Ringkasan Singkat')
                            ->rows(3)
                            ->placeholder('Muncul di kartu paket dan preview search')
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ]),

                Section::make('Rundown / Itinerary Harian')
                    ->description('Susun jadwal kegiatan perjalanan hari demi hari')
                    ->schema([
                        Repeater::make('itinerary')
                            ->label('Daftar Agenda Harian')
                            ->schema([
                                Grid::make(4)->schema([
                                    TextInput::make('day')
                                        ->label('Hari ke-')
                                        ->numeric()
                                        ->default(1)
                                        ->columnSpan(1),
                                    TextInput::make('title')
                                        ->label('Judul Agenda Hari Ini')
                                        ->placeholder('Contoh: Penjemputan & Snorkeling')
                                        ->columnSpan(3),
                                ]),
                                Textarea::make('activities')
                                    ->label('Rincian Kegiatan / Jam')
                                    ->placeholder('08.00 Snorkeling Cukuh Bedil -> 12.00 Makan siang ...')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => isset($state['day']) ? "Hari ke-{$state['day']}: " . ($state['title'] ?? '') : null)
                            ->defaultItems(1)
                            ->columnSpanFull(),
                    ]),

                Section::make('Fasilitas Paket')
                    ->schema([
                        Grid::make(2)->schema([
                            TagsInput::make('includes')
                                ->label('Fasilitas Termasuk (Include)')
                                ->placeholder('Ketik dan tekan Enter (contoh: Bus AC, Makan 3x, Tiket Masuk)')
                                ->columnSpan(1),
                            TagsInput::make('excludes')
                                ->label('Tidak Termasuk (Exclude)')
                                ->placeholder('Ketik dan tekan Enter (contoh: Pengeluaran pribadi, Tipping driver)')
                                ->columnSpan(1),
                        ]),
                    ]),

                Section::make('Pertanyaan yang Sering Diajukan (FAQ)')
                    ->description('Tambahkan pertanyaan dan jawaban umum seputar paket wisata ini')
                    ->schema([
                        Repeater::make('faqs')
                            ->label('Daftar FAQ Paket')
                            ->schema([
                                TextInput::make('question')
                                    ->label('Pertanyaan')
                                    ->placeholder('Contoh: Apakah paket ini cocok untuk anak-anak?')
                                    ->required()
                                    ->columnSpanFull(),
                                Textarea::make('answer')
                                    ->label('Jawaban')
                                    ->placeholder('Tuliskan penjelasan jawaban secara jelas dan ramah...')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),

                Section::make('Foto & Visibilitas')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('thumbnail')
                                ->label('Foto Thumbnail / Sampul Utama')
                                ->image()
                                ->directory('packages')
                                ->maxSize(51200)
                                ->helperText('Maksimal ukuran berkas hingga 50 MB. Gambar otomatis dikompresi prima.')
                                ->imageEditor()
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
                            Grid::make(1)->schema([
                                Toggle::make('is_featured')
                                    ->label('Tampilkan sebagai Paket Unggulan di Beranda')
                                    ->helperText('Jika aktif maka paket diprioritaskan di grid destinasi Beranda.')
                                    ->default(false),
                                Toggle::make('is_active')
                                    ->label('Status Aktif / Dapat Dipesan')
                                    ->helperText('Jika nonaktif maka paket disembunyikan dari katalog publik.')
                                    ->default(true),
                                TextInput::make('order')
                                    ->label('Urutan Prioritas Tampil')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Angka lebih kecil tampil lebih awal.'),
                            ]),
                            FileUpload::make('gallery')
                                ->label('Galeri Foto Dokumentasi Destinasi (Opsional)')
                                ->multiple()
                                ->reorderable()
                                ->image()
                                ->directory('packages/gallery')
                                ->maxSize(51200)
                                ->maxFiles(8)
                                ->columnSpanFull()
                                ->helperText('Unggah beberapa foto dokumentasi tambahan (spot wisata, villa/hotel, kuliner, aktivitas trip) untuk tampil di halaman detail paket.')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Nama Paket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (TourPackage $record): ?string => $record->destination_location),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('price_from')
                    ->label('Harga Mulai')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('duration_label')
                    ->label('Durasi'),
                TextColumn::make('inquiries_count')
                    ->counts('inquiries')
                    ->label('Pesanan')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name', fn (Builder $query) => $query->where('type', 'tour'))
                    ->label('Kategori'),
                TernaryFilter::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->trueLabel('Hanya Paket Unggulan')
                    ->falseLabel('Bukan Unggulan'),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->trueLabel('Hanya Paket Aktif')
                    ->falseLabel('Hanya Paket Nonaktif'),
            ])
            ->actions([
                Action::make('view_on_web')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (TourPackage $record): string => route('packages.show', $record->slug))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Aktifkan yang Dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('deactivate')
                        ->label('Nonaktifkan yang Dipilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('feature')
                        ->label('Jadikan Unggulan Beranda')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => true]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTourPackages::route('/'),
            'create' => Pages\CreateTourPackage::route('/create'),
            'edit' => Pages\EditTourPackage::route('/{record}/edit'),
        ];
    }
}
