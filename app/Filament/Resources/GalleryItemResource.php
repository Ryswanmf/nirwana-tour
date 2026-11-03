<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

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
                Section::make('Item Galeri')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('title')
                                ->label('Judul Foto / Video')
                                ->required(),
                            Select::make('media_type')
                                ->label('Tipe Media')
                                ->options([
                                    'reel' => 'Instagram Reel (Rekomendasi Hemat Storage)',
                                    'video' => 'Video Lokal (MP4)',
                                    'image' => 'Foto / Gambar',
                                ])
                                ->default('reel')
                                ->live()
                                ->required(),
                            TextInput::make('order')
                                ->label('Urutan Prioritas')
                                ->numeric()
                                ->default(0),
                        ]),
                        Toggle::make('is_featured')
                            ->label('Video Unggulan Beranda (Tampil di Home)')
                            ->helperText('Jika diaktifkan, video ini akan tampil di bagian Galeri Video Beranda (maksimal 5 video unggulan). Jika tidak diaktifkan, video akan tampil di halaman Galeri.')
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
                            ->helperText('Mendukung file foto (JPG, PNG, WebP) atau video (MP4, MOV).')
                            ->visible(fn (Forms\Get $get) => in_array($get('media_type'), ['image', 'video']))
                            ->required(fn (Forms\Get $get) => in_array($get('media_type'), ['image', 'video']))
                            ->columnSpanFull(),
                        Textarea::make('caption')
                            ->label('Keterangan / Caption Singkat')
                            ->rows(2)
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
                    ->defaultImageUrl(fn () => asset('assets/images/galeri/video1-poster.jpg')),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('media_type')
                    ->label('Tipe')
                    ->badge(),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda'),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                TernaryFilter::make('is_featured')
                    ->label('Unggulan Beranda'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
