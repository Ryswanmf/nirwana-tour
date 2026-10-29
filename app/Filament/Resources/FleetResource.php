<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FleetResource\Pages;
use App\Models\Fleet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class FleetResource extends Resource
{
    protected static ?string $model = Fleet::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Manajemen Wisata';

    protected static ?string $navigationLabel = 'Armada Transportasi';

    protected static ?string $modelLabel = 'Armada';

    protected static ?string $pluralModelLabel = 'Armada Transportasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Armada')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Armada Bus / Kendaraan')
                                ->placeholder('Contoh: Big Bus SHD Mercedes-Benz')
                                ->required(),
                            TextInput::make('type')
                                ->label('Tipe Kendaraan')
                                ->placeholder('Contoh: Big Bus SHD, Medium Bus, HiAce')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('capacity')
                                ->label('Kapasitas Penumpang')
                                ->placeholder('Contoh: 48 - 50 Kursi')
                                ->required(),
                            TextInput::make('order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ]),
                        TagsInput::make('facilities')
                            ->label('Fasilitas Armada')
                            ->placeholder('Ketik dan tekan Enter (contoh: AC Dingin, Reclining Seat, Audio Karaoke, USB Charger)')
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('Foto Armada')
                            ->image()
                            ->directory('fleets')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nama Kendaraan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                TextColumn::make('capacity')
                    ->label('Kapasitas'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            'index' => Pages\ListFleets::route('/'),
            'create' => Pages\CreateFleet::route('/create'),
            'edit' => Pages\EditFleet::route('/{record}/edit'),
        ];
    }
}
