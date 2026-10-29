<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Identitas & Profil';

    protected static ?string $navigationLabel = 'Mitra & Klien Rekanan';

    protected static ?string $modelLabel = 'Mitra';

    protected static ?string $pluralModelLabel = 'Mitra Rekanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Mitra Rekanan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Instansi / Perusahaan')
                                ->required(),
                            TextInput::make('category')
                                ->label('Kategori')
                                ->placeholder('Contoh: BUMN, Universitas, Sekolah, Pemprov'),
                        ]),
                        Grid::make(2)->schema([
                            FileUpload::make('logo')
                                ->label('Logo Instansi (PNG/SVG)')
                                ->image()
                                ->directory('partners'),
                            Grid::make(1)->schema([
                                TextInput::make('order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('Tampilkan di Ticker Beranda')
                                    ->default(true),
                            ]),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo'),
                TextColumn::make('name')
                    ->label('Nama Instansi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge(),
                IconColumn::make('is_active')
                    ->label('Tampil')
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
