<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
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
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Manajemen Wisata';

    protected static ?string $navigationLabel = 'Layanan Perjalanan';

    protected static ?string $modelLabel = 'Layanan';

    protected static ?string $pluralModelLabel = 'Layanan Perjalanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Layanan')
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
                                ->placeholder('Contoh: fa-solid fa-umbrella-beach, fa-solid fa-graduation-cap')
                                ->default('fa-solid fa-map-location-dot'),
                            TextInput::make('order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ]),
                        Textarea::make('short_description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('full_description')
                            ->label('Deskripsi Lengkap Layanan')
                            ->columnSpanFull(),
                        TagsInput::make('features')
                            ->label('Poin Keunggulan / Fitur Layanan')
                            ->placeholder('Ketik dan tekan Enter')
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('Foto Banner Layanan')
                            ->image()
                            ->directory('services')
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
                TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('icon')
                    ->label('Ikon'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
