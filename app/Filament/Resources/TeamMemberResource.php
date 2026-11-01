<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Tim & Manajemen';

    protected static ?string $modelLabel = 'Anggota Tim';

    protected static ?string $pluralModelLabel = 'Tim Manajemen & Pemandu';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Anggota Tim')
                    ->description('Kelola profil pimpinan, pemandu wisata (tour leader), dan staf operasional.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required()
                                ->placeholder('Contoh: Kiki M Alfin'),
                            TextInput::make('role')
                                ->label('Jabatan / Posisi')
                                ->required()
                                ->placeholder('Contoh: Pimpinan & Founder @ Nirwana Tour'),
                            TextInput::make('division')
                                ->label('Divisi Kerja')
                                ->placeholder('Contoh: Direksi / Operasional / Tour Leader'),
                            TextInput::make('order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(0),
                        ]),
                        FileUpload::make('photo')
                            ->label('Foto Anggota Tim')
                            ->image()
                            ->directory('team')
                            ->imageEditor()
                            ->imageEditorMode(1)
                            ->imageEditorEmptyFillColor('#ffffff')
                            ->imageCropAspectRatio('1:1')
                            ->imageEditorAspectRatios([
                                null,
                                '1:1',
                                '4:3',
                                '3:4',
                                '16:9',
                                '4:5',
                            ])
                            ->maxSize(51200)
                            ->helperText('Maksimal 50 MB. Gunakan tombol pensil/crop untuk crop/potong foto (Bebas, Kotak 1:1, 4:3, dll). Foto otomatis dikompresi tanpa mengurangi resolusi aslinya.')
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
                            }),
                        Grid::make(2)->schema([
                            TextInput::make('linkedin_url')
                                ->label('Tautan LinkedIn')
                                ->placeholder('https://linkedin.com/in/...'),
                            TextInput::make('facebook_url')
                                ->label('Tautan Facebook')
                                ->placeholder('https://facebook.com/...'),
                            TextInput::make('tiktok_url')
                                ->label('Tautan TikTok')
                                ->placeholder('https://tiktok.com/@...'),
                            TextInput::make('twitter_url')
                                ->label('Tautan X / Twitter')
                                ->placeholder('https://x.com/...'),
                        ]),
                        Toggle::make('is_active')
                            ->label('Aktif / Tampilkan di Halaman Manajemen')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn () => asset('assets/images/owner.png')),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('role')
                    ->label('Jabatan')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('division')
                    ->label('Divisi')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
