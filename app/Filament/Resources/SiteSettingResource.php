<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Identitas & Profil';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Pengaturan';

    protected static ?string $pluralModelLabel = 'Pengaturan Website';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Parameter Pengaturan')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('key')
                                ->label('Kunci Konfigurasi')
                                ->disabled()
                                ->required(),
                            TextInput::make('label')
                                ->label('Nama Pengaturan')
                                ->required(),
                        ]),
                        Textarea::make('value')
                            ->label('Nilai Pengaturan (Value)')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Nama Pengaturan')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('key')
                    ->label('Kunci (Key)')
                    ->badge()
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Nilai Saat Ini')
                    ->limit(60),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
