<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
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
use Filament\Tables\Columns\IconColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Layanan Pelanggan';

    protected static ?string $navigationLabel = 'Testimoni & Review';

    protected static ?string $modelLabel = 'Testimoni';

    protected static ?string $pluralModelLabel = 'Testimoni & Review';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ulasan Klien / Pelanggan')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('client_name')
                                ->label('Nama Klien')
                                ->required(),
                            TextInput::make('organization')
                                ->label('Instansi / Perusahaan')
                                ->placeholder('Contoh: SMA 2 Bandar Lampung / Bank Mandiri'),
                            TextInput::make('role')
                                ->label('Jabatan / Status')
                                ->placeholder('Contoh: Guru Pendamping, Wisatawan'),
                        ]),
                        Grid::make(3)->schema([
                            Select::make('rating')
                                ->label('Rating Bintang')
                                ->options([
                                    5 => '⭐⭐⭐⭐⭐ (5 Bintang)',
                                    4 => '⭐⭐⭐⭐ (4 Bintang)',
                                    3 => '⭐⭐⭐ (3 Bintang)',
                                ])
                                ->default(5)
                                ->required(),
                            TextInput::make('trip_name')
                                ->label('Nama Kegiatan / Trip')
                                ->placeholder('Contoh: Study Tour Jogja 2025'),
                            TextInput::make('order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ]),
                        Textarea::make('comment')
                            ->label('Isi Ulasan / Testimoni')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('avatar')
                            ->label('Foto Profil Klien')
                            ->image()
                            ->directory('testimonials')
                            ->avatar(),
                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('client_name')
                    ->label('Nama Klien')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('organization')
                    ->label('Instansi')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),
                TextColumn::make('trip_name')
                    ->label('Trip'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
