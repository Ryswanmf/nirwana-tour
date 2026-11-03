<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Manajemen Wisata & Reservasi';

    protected static ?string $navigationLabel = 'Layanan Perjalanan';

    protected static ?string $modelLabel = 'Layanan';

    protected static ?string $pluralModelLabel = 'Layanan Perjalanan';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi & Rincian Layanan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Nama Layanan')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('URL Slug')
                                ->required()
                                ->unique(ignoreRecord: true),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('icon')
                                ->label('FontAwesome Icon Class')
                                ->placeholder('Pilih dari saran atau ketik class FontAwesome')
                                ->datalist([
                                    'fa-solid fa-map-location-dot',
                                    'fa-solid fa-bus',
                                    'fa-solid fa-van-shuttle',
                                    'fa-solid fa-hotel',
                                    'fa-solid fa-graduation-cap',
                                    'fa-solid fa-users',
                                    'fa-solid fa-plane-departure',
                                    'fa-solid fa-umbrella-beach',
                                    'fa-solid fa-car',
                                    'fa-solid fa-route',
                                    'fa-solid fa-handshake',
                                    'fa-solid fa-camera',
                                    'fa-solid fa-briefcase',
                                    'fa-solid fa-award',
                                ])
                                ->helperText('Contoh: fa-solid fa-bus, fa-solid fa-umbrella-beach, fa-solid fa-graduation-cap')
                                ->default('fa-solid fa-map-location-dot')
                                ->required(),
                            TextInput::make('order')
                                ->label('Urutan Tampilan')
                                ->numeric()
                                ->default(0)
                                ->helperText('Urutan tampil di katalog & menu (angka lebih kecil tampil lebih awal)'),
                        ]),
                        Textarea::make('short_description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->required()
                            ->maxLength(500)
                            ->helperText('Ringkasan layanan yang ditampilkan pada kartu di halaman utama dan katalog.')
                            ->columnSpanFull(),
                        RichEditor::make('full_description')
                            ->label('Deskripsi Lengkap Layanan')
                            ->helperText('Rincian detail, fasilitas include, ketentuan umum, serta SOP pelaksanaan kegiatan.')
                            ->columnSpanFull(),
                        TagsInput::make('features')
                            ->label('Poin Keunggulan / Fasilitas Layanan')
                            ->placeholder('Ketik keunggulan dan tekan Enter (contoh: Bus Pariwisata AC, Konsumsi & Snack, Tour Leader)')
                            ->helperText('Tekan tombol Enter setelah mengetik tiap poin keunggulan.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Foto Banner & Status Publikasi')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Banner Layanan')
                            ->image()
                            ->directory('services')
                            ->maxSize(51200)
                            ->helperText('Maksimal ukuran berkas hingga 50 MB. Gambar otomatis dikompresi tanpa mengurangi kualitas visual.')
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
                            })
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Jika aktif, layanan akan ditampilkan di katalog publik, menu footer, dan beranda.')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Banner')
                    ->circular()
                    ->defaultImageUrl(asset('assets/images/destinasi/pahawang.jpg')),
                TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('icon')
                    ->label('Ikon')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('short_description')
                    ->label('Deskripsi')
                    ->limit(45)
                    ->toggleable(),
                TextColumn::make('features_count')
                    ->label('Keunggulan')
                    ->state(fn ($record) => count($record->features ?? []))
                    ->badge()
                    ->color('info'),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->trueLabel('Hanya Layanan Aktif')
                    ->falseLabel('Hanya Layanan Nonaktif'),
            ])
            ->actions([
                Action::make('view_on_web')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (Service $record): string => route('services.show', $record->slug))
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
