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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Manajemen & Tim';

    protected static ?string $modelLabel = 'Anggota Tim';

    protected static ?string $pluralModelLabel = 'Tim Manajemen & Pemandu';

    protected static ?int $navigationSort = 2;

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
                                ->placeholder('Contoh: Pimpinan & Founder / Senior Tour Leader'),
                            TextInput::make('division')
                                ->label('Divisi Kerja')
                                ->placeholder('Pilih dari saran atau ketik divisi baru')
                                ->datalist([
                                    'Direksi & Pimpinan',
                                    'Operasional & Lapangan',
                                    'Tour Leader & Pemandu Wisata',
                                    'Customer Service & Reservasi',
                                    'Transportasi & Logistik',
                                    'Dokumentasi & Media',
                                ])
                                ->helperText('Contoh: Direksi / Operasional / Tour Leader'),
                            TextInput::make('order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(0)
                                ->helperText('Urutan tampil di halaman manajemen (angka lebih kecil tampil lebih awal)'),
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
                            ->helperText('Jika aktif maka profil anggota tim ini ditampilkan di rute /manajemen.')
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
                    ->color('info')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->filters([
                SelectFilter::make('division')
                    ->label('Filter Divisi')
                    ->options(fn () => TeamMember::whereNotNull('division')->where('division', '!=', '')->distinct()->pluck('division', 'division')->toArray()),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->trueLabel('Hanya Anggota Aktif')
                    ->falseLabel('Hanya yang Disembunyikan'),
            ])
            ->actions([
                Action::make('view_on_web')
                    ->label('Lihat di Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(route('management'))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Aktifkan yang Dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('deactivate')
                        ->label('Nonaktifkan yang Dipilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(fn (Collection $records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),
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
