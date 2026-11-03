<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Konten & Informasi';

    protected static ?string $navigationLabel = 'Kontak & Kantor';

    protected static ?string $modelLabel = 'Kontak Kantor';

    protected static ?string $pluralModelLabel = 'Kontak & Kantor';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Kantor & Layanan')
                    ->description('Tentukan nama kantor, tipe cabang, dan wilayah operasional.')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('name')
                                ->label('Nama Kantor / Unit Layanan')
                                ->placeholder('Contoh: Kantor Pusat Nirwana Tour Lampung')
                                ->required()
                                ->columnSpan(2),
                            Select::make('type')
                                ->label('Tipe Kontak / Layanan')
                                ->options([
                                    'Kantor Pusat' => 'Kantor Pusat',
                                    'Kantor Cabang' => 'Kantor Cabang',
                                    'Customer Service 24 Jam' => 'Customer Service 24 Jam',
                                    'Hotline Darurat' => 'Hotline Darurat',
                                    'Helpdesk Reservasi' => 'Helpdesk Reservasi',
                                ])
                                ->default('Kantor Pusat')
                                ->required(),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('city')
                                ->label('Kota / Wilayah')
                                ->placeholder('Contoh: Bandar Lampung / Jakarta Selatan')
                                ->default('Bandar Lampung')
                                ->required(),
                            TextInput::make('order')
                                ->label('Urutan Prioritas')
                                ->numeric()
                                ->default(0)
                                ->helperText('Semakin kecil angka, semakin awal muncul di daftar kontak.'),
                        ]),
                    ]),

                Section::make('Saluran Komunikasi Resmi')
                    ->description('Nomor telepon, WhatsApp, email, dan jam operasional yang bisa dihubungi.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('whatsapp')
                                ->label('Nomor WhatsApp')
                                ->placeholder('6282269616188')
                                ->tel()
                                ->helperText('Format internasional tanpa simbol (contoh: 6282269616188).'),
                            TextInput::make('phone')
                                ->label('Nomor Telepon Kantor')
                                ->placeholder('0822-6961-6188')
                                ->tel()
                                ->helperText('Bisa nomor seluler atau telepon kabel kantor.'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('email')
                                ->label('Alamat Email Resmi')
                                ->placeholder('info@nirwanatourlampung.com')
                                ->email(),
                            TextInput::make('operating_hours')
                                ->label('Jam Operasional')
                                ->placeholder('Senin - Sabtu: 08:00 - 17:00 WIB')
                                ->default('Senin - Sabtu: 08:00 - 17:00 WIB'),
                        ]),
                    ]),

                Section::make('Lokasi Fisik & Google Maps')
                    ->description('Alamat lengkap kantor dan integrasi peta Google Maps.')
                    ->schema([
                        Textarea::make('address')
                            ->label('Alamat Kantor Lengkap')
                            ->placeholder('Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122')
                            ->rows(2)
                            ->required()
                            ->columnSpanFull(),
                        Grid::make(2)->schema([
                            TextInput::make('google_maps_url')
                                ->label('Link Tombol Buka Google Maps')
                                ->placeholder('https://maps.google.com/?q=...')
                                ->url()
                                ->helperText('Link langsung saat tombol "Buka Google Maps" diklik.'),
                            Textarea::make('google_maps_embed')
                                ->label('URL / Kode Embed Iframe Peta Google Maps')
                                ->placeholder('https://www.google.com/maps/embed?pb=...')
                                ->rows(2)
                                ->helperText('Bisa berupa URL embed atau seluruh kode <iframe> dari Google Maps.'),
                        ]),
                        Textarea::make('description')
                            ->label('Catatan / Keterangan Fasilitas')
                            ->placeholder('Contoh: Area parkir bus luas, melayani konsultasi langsung dan pembuatan itinerary custom.')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Status Publikasi')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('is_primary')
                                ->label('Kantor Utama (Paling Utama)')
                                ->helperText('Jika diaktifkan, kantor ini menjadi pilihan utama yang tampil di beranda dan header peta.')
                                ->default(false),
                            Toggle::make('is_active')
                                ->label('Tampilkan di Halaman Kontak')
                                ->helperText('Jika non-aktif, kantor ini tidak akan tampil ke pengunjung website.')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kantor / Unit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Kantor Pusat' => 'primary',
                        'Kantor Cabang' => 'success',
                        'Customer Service 24 Jam' => 'warning',
                        default => 'info',
                    })
                    ->sortable(),
                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city')
                    ->label('Kota / Wilayah')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_primary')
                    ->label('Utama'),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                TernaryFilter::make('is_primary')
                    ->label('Kantor Utama'),
            ])
            ->actions([
                Action::make('chat_wa')
                    ->label('Tes Chat')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('success')
                    ->url(fn (Contact $record) => "https://wa.me/{$record->clean_whatsapp}")
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record) => filled($record->whatsapp)),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
