<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Konten & Informasi';

    protected static ?string $navigationLabel = 'Galeri Dokumentasi';

    protected static ?string $modelLabel = 'Galeri';

    protected static ?string $pluralModelLabel = 'Galeri Dokumentasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Media Galeri')
                    ->description('Kelola dokumentasi video Instagram Reels, video lokal pariwisata, atau foto kegiatan.')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('title')
                                ->label('Judul Foto / Video')
                                ->placeholder('Contoh: Keseruan Snorkeling di Pulau Pahawang')
                                ->required(),
                            Select::make('media_type')
                                ->label('Tipe Media')
                                ->options([
                                    'reel' => 'Instagram Reel (Rekomendasi Hemat Storage)',
                                    'video' => 'Video Lokal (MP4)',
                                    'image' => 'Foto / Gambar (JPG, PNG, WebP)',
                                ])
                                ->default('reel')
                                ->live()
                                ->required(),
                            TextInput::make('order')
                                ->label('Urutan Prioritas')
                                ->numeric()
                                ->default(0)
                                ->helperText('Angka lebih kecil tampil lebih awal'),
                        ]),
                        Toggle::make('is_featured')
                            ->label('Unggulan Beranda (Tampil di Home)')
                            ->helperText('Jika diaktifkan, video/media ini akan tampil di bagian carousel Galeri Beranda (maksimal 5 video unggulan). Jika dinonaktifkan, akan tampil di halaman Galeri reguler.')
                            ->default(false),
                        TextInput::make('file_path')
                            ->label('Link URL Instagram Reel')
                            ->placeholder('https://www.instagram.com/reel/C...')
                            ->helperText('Tempelkan link video Reels Instagram resmi Nirwana Tour (@nirwana_tourlampung).')
                            ->visible(fn (Forms\Get $get) => $get('media_type') === 'reel')
                            ->required(fn (Forms\Get $get) => $get('media_type') === 'reel')
                            ->columnSpanFull(),
                        FileUpload::make('file_path')
                            ->label('Unggah File Media (Foto / Video)')
                            ->directory('gallery')
                            ->maxSize(153600)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/gif',
                                'video/mp4',
                                'video/quicktime',
                                'video/x-msvideo',
                                'video/webm',
                            ])
                            ->helperText('Mendukung file foto (JPG, PNG, WebP otomatis dikompresi) atau video (MP4, MOV).')
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
                            ->visible(fn (Forms\Get $get) => in_array($get('media_type'), ['image', 'video']))
                            ->required(fn (Forms\Get $get) => in_array($get('media_type'), ['image', 'video']))
                            ->columnSpanFull(),
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail / Poster Cover Video (Opsional)')
                            ->directory('gallery/thumbnails')
                            ->image()
                            ->imageEditor()
                            ->helperText('Unggah foto cover poster video agar tampilan gambar kartu di beranda sama persis seperti cover di Instagram. Jika dikosongkan, akan memakai poster default.')
                            ->visible(fn (Forms\Get $get) => in_array($get('media_type'), ['reel', 'video']))
                            ->columnSpanFull(),
                        Textarea::make('caption')
                            ->label('Keterangan / Caption Singkat')
                            ->rows(2)
                            ->placeholder('Deskripsikan momen seru, lokasi destinasi, atau kegiatan rombongan...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Media')
                    ->state(function (GalleryItem $record) {
                        if ($record->media_type === 'image') {
                            return storage_or_asset($record->file_path);
                        }
                        if (!empty($record->thumbnail)) {
                            return storage_or_asset($record->thumbnail);
                        }
                        return asset('assets/images/galeri/video1-poster.jpg');
                    })
                    ->circular()
                    ->height(40)
                    ->width(40),
                TextColumn::make('title')
                    ->label('Judul Dokumentasi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (GalleryItem $record): ?string => Str::limit($record->caption, 60)),
                TextColumn::make('media_type')
                    ->label('Tipe Media')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'reel' => 'danger',
                        'video' => 'info',
                        'image' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'reel' => 'Instagram Reel',
                        'video' => 'Video MP4',
                        'image' => 'Foto Dokumentasi',
                        default => ucfirst($state),
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'reel' => 'heroicon-m-camera',
                        'video' => 'heroicon-m-video-camera',
                        'image' => 'heroicon-m-photo',
                        default => 'heroicon-m-document',
                    }),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                SelectFilter::make('media_type')
                    ->label('Tipe Media')
                    ->options([
                        'reel' => 'Instagram Reel',
                        'video' => 'Video Lokal',
                        'image' => 'Foto Dokumentasi',
                    ]),
                TernaryFilter::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->trueLabel('Hanya Unggulan Beranda')
                    ->falseLabel('Hanya Galeri Reguler'),
            ])
            ->actions([
                Action::make('view_on_web')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (GalleryItem $record) => $record->is_featured ? route('home') . '#galeri' : route('gallery.index'))
                    ->openUrlInNewTab(),
                Action::make('open_media')
                    ->label('Buka Media')
                    ->icon('heroicon-o-arrow-up-right')
                    ->color('info')
                    ->url(fn (GalleryItem $record): string => $record->file_url)
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('set_featured')
                        ->label('Jadikan Unggulan Beranda')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('unset_featured')
                        ->label('Hapus dari Unggulan Beranda')
                        ->icon('heroicon-o-x-mark')
                        ->color('gray')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => false]))
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
