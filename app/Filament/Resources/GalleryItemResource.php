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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Publikasi & Konten';

    protected static ?string $navigationLabel = 'Galeri Dokumentasi';

    protected static ?string $modelLabel = 'Galeri';

    protected static ?string $pluralModelLabel = 'Galeri Dokumentasi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Item Galeri')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->label('Judul Foto / Video')
                                ->required(),
                            Select::make('media_type')
                                ->label('Tipe Media')
                                ->options([
                                    'image' => 'Foto / Gambar',
                                    'video' => 'Video Perjalanan (MP4)',
                                ])
                                ->default('image')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('category_id')
                                ->label('Kategori Album')
                                ->relationship('category', 'name', fn ($q) => $q->where('type', 'gallery'))
                                ->searchable()
                                ->preload(),
                            TextInput::make('order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ]),
                        FileUpload::make('file_path')
                            ->label('Unggah File Media')
                            ->directory('gallery')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('thumbnail')
                            ->label('Poster / Cover Thumbnail (Jika Video)')
                            ->image()
                            ->directory('gallery/thumbnails')
                            ->columnSpanFull(),
                        Textarea::make('caption')
                            ->label('Keterangan / Caption Foto')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->defaultImageUrl(fn ($record) => $record->file_path),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('media_type')
                    ->label('Tipe')
                    ->badge(),
                TextColumn::make('category.name')
                    ->label('Album'),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
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
