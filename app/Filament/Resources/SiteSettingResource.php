<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static ?string $modelLabel = 'Pengaturan';

    protected static ?string $pluralModelLabel = 'Pengaturan Website';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(function (?SiteSetting $record, Forms\Get $get): array {
                $isPhoto = ($record?->key ?? $get('key') ?? '') === 'owner_photo';

                return [
                    Section::make('Parameter Pengaturan')
                        ->description('Kelola teks, angka statistik, atau foto profil perusahaan.')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('key')
                                ->label('Kunci Konfigurasi (Key)')
                                ->disabled()
                                ->required(),
                                TextInput::make('label')
                                    ->label('Nama Pengaturan')
                                    ->required(),
                            ]),
                            TextInput::make('group')
                                ->label('Kelompok Pengaturan')
                                ->disabled()
                                ->visible(filled($record?->group)),
                            $isPhoto
                                ? FileUpload::make('value')
                                    ->label('Foto Pemilik Nirwana Tour (Profil Perusahaan Beranda)')
                                    ->disk('public')
                                    ->directory('settings')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorMode(1)
                                    ->imageEditorEmptyFillColor('#ffffff')
                                    ->imageCropAspectRatio('1:1')
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        null,
                                        '4:3',
                                        '3:4',
                                        '16:9',
                                        '4:5',
                                    ])
                                    ->maxSize(51200)
                                    ->helperText('Format foto beranda menggunakan rasio 1:1 (Persegi/Square). Gunakan tombol pensil/crop pada pratinjau foto untuk memotong (crop) foto dengan rasio 1:1 agar pas dengan frame beranda. Maksimal 50 MB, otomatis dikompresi tanpa mengurangi resolusi aslinya.')
                                    ->columnSpanFull()
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
                                : Textarea::make('value')
                                    ->label('Nilai Pengaturan (Value)')
                                    ->rows(in_array($record?->key, ['owner_quote', 'about_description', 'about_company', 'hero_subtitle']) ? 5 : 2)
                                    ->helperText(match ($record?->key) {
                                        'stat_years_count', 'stat_trips_count', 'stat_satisfaction_count', 'stat_legal_count' => 'Masukkan angka target saja tanpa simbol (contoh: 8, 1500, 99, 100).',
                                        'whatsapp_number' => 'Gunakan format angka internasional tanpa simbol + atau spasi (contoh: 6282269616188). Nomor ini otomatis terhubung ke tombol "Rencanakan Perjalanan" di navbar, widget floating chat, dan formulir booking.',
                                        default => null,
                                    })
                                    ->columnSpanFull(),
                        ]),
                ];
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Nama Pengaturan')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('group')
                    ->label('Kelompok')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'about' => 'Profil Perusahaan',
                        'marketing' => 'Marketing',
                        'social_proof' => 'Social Proof',
                        default => ucfirst($state ?? 'Umum'),
                    })
                    ->color(fn (?string $state): string => match ($state) {
                        'about' => 'info',
                        'marketing' => 'success',
                        'social_proof' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Kunci (Key)')
                    ->badge()
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Nilai Saat Ini')
                    ->limit(60)
                    ->formatStateUsing(function ($state, SiteSetting $record): string {
                        if ($record->key === 'owner_photo') {
                            return filled($state) ? '🖼️ ' . basename($state) : '📷 Default (Aset Statis)';
                        }
                        return (string) ($state ?? '-');
                    }),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->label('Filter Kelompok')
                    ->options([
                        'about' => 'Profil Perusahaan (About)',
                        'marketing' => 'Marketing & Hero',
                        'social_proof' => 'Social Proof',
                        'general' => 'Umum (Kontak & Medsos)',
                    ]),
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
