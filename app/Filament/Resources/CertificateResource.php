<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\Certificate;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Legalitas & Sertifikasi';

    protected static ?string $modelLabel = 'Dokumen Sertifikasi';

    protected static ?string $pluralModelLabel = 'Legalitas & Sertifikasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dokumen & Perizinan')
                    ->description('Kelola data legalitas resmi, izin usaha, dan sertifikasi pariwisata.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Nama Dokumen / Sertifikat')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                ->placeholder('Contoh: Nomor Induk Berusaha (NIB)'),
                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('issuer')
                                ->label('Instansi / Lembaga Penerbit')
                                ->placeholder('Contoh: Kementerian Investasi / BKPM RI'),
                            TextInput::make('certificate_number')
                                ->label('Nomor Dokumen / SK')
                                ->placeholder('Contoh: KBLI 79120, TDUP/556/012/BPW/2016'),
                            TextInput::make('badge')
                                ->label('Label Status')
                                ->placeholder('Contoh: OSS BKPM, Pemda Aktif'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('icon')
                                ->label('FontAwesome Icon Class')
                                ->default('fa-solid fa-certificate')
                                ->datalist([
                                    'fa-solid fa-id-card-clip',
                                    'fa-solid fa-file-contract',
                                    'fa-solid fa-users-gear',
                                    'fa-solid fa-bus',
                                    'fa-solid fa-shield-virus',
                                    'fa-solid fa-file-invoice-dollar',
                                    'fa-solid fa-certificate',
                                    'fa-solid fa-award',
                                    'fa-solid fa-stamp',
                                    'fa-solid fa-shield-halved',
                                ])
                                ->helperText('Contoh: fa-solid fa-id-card-clip, fa-solid fa-award'),
                            TextInput::make('order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(0)
                                ->helperText('Angka lebih kecil tampil lebih awal'),
                        ]),
                        Textarea::make('description')
                            ->label('Deskripsi & Penjelasan Dokumen')
                            ->rows(3)
                            ->placeholder('Jelaskan dasar hukum, cakupan izin, atau jaminan bagi wisatawan...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Unggah Berkas & Pratinjau Dokumen')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('image')
                                ->label('Foto / Scan Pratinjau Sertifikat')
                                ->image()
                                ->directory('certificates/images')
                                ->imageEditor()
                                ->maxSize(51200)
                                ->helperText('Maksimal 50 MB. Gambar otomatis dikompresi tanpa mengurangi ketajaman.')
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
                            FileUpload::make('file')
                                ->label('Berkas Dokumen Asli (PDF / Dokumen Unduhan)')
                                ->directory('certificates/documents')
                                ->maxSize(51200)
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->helperText('Unggah berkas PDF atau scan resmi dokumen untuk diunduh calon klien/instansi.'),
                        ]),
                        Toggle::make('is_active')
                            ->label('Status Dokumen Aktif (Tampilkan di Website)')
                            ->helperText('Jika aktif maka dokumen ini ditampilkan di rute /sertifikasi.')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Scan')
                    ->circular()
                    ->defaultImageUrl(fn () => asset('assets/logo/Logo-Nirwana.png')),
                TextColumn::make('title')
                    ->label('Nama Sertifikat / Dokumen')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Certificate $record): ?string => $record->certificate_number ? 'No: ' . $record->certificate_number : null),
                TextColumn::make('issuer')
                    ->label('Instansi Penerbit')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('badge')
                    ->label('Status')
                    ->badge()
                    ->color('success'),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Dokumen')
                    ->trueLabel('Hanya yang Aktif')
                    ->falseLabel('Hanya yang Dinonaktifkan'),
            ])
            ->actions([
                Action::make('view_on_web')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(route('certificates'))
                    ->openUrlInNewTab(),
                Action::make('download_file')
                    ->label('Unduh Berkas')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (Certificate $record): bool => !empty($record->file))
                    ->url(fn (Certificate $record): string => asset('storage/' . $record->file))
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
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
