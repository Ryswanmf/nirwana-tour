<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Models\Inquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Manajemen Wisata & Reservasi';

    protected static ?string $navigationLabel = 'Pesan & Booking Masuk';

    protected static ?string $modelLabel = 'Lead / Konsultasi';

    protected static ?string $pluralModelLabel = 'Pesan & Booking Masuk';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return \Illuminate\Support\Facades\Cache::remember('inquiry_pending_badge_count', 60, function () {
            $pending = Inquiry::where('status', 'pending')->count();
            return $pending > 0 ? (string) $pending : null;
        });
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Calon Wisatawan')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required(),
                            TextInput::make('phone')
                                ->label('Nomor WhatsApp')
                                ->tel()
                                ->required(),
                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email(),
                        ]),
                    ]),

                Section::make('Detail Permintaan Wisata')
                    ->schema([
                        Grid::make(3)->schema([
                            Select::make('tour_package_id')
                                ->label('Paket Terpilih')
                                ->relationship('tourPackage', 'title')
                                ->searchable()
                                ->preload(),
                            TextInput::make('participants')
                                ->label('Jumlah Peserta')
                                ->numeric()
                                ->default(1),
                            TextInput::make('fleet_type')
                                ->label('Pilihan Armada Transportasi'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('estimated_price')
                                ->label('Estimasi Biaya (Rp)')
                                ->numeric()
                                ->prefix('Rp'),
                            Select::make('status')
                                ->label('Status Follow-up')
                                ->options([
                                    'pending' => 'Pending (Belum Dihubungi)',
                                    'contacted' => 'Sudah Dihubungi',
                                    'deal' => 'Deal / Booking Berhasil',
                                    'cancelled' => 'Batal / Tidak Jadi',
                                ])
                                ->required()
                                ->default('pending'),
                        ]),
                        Textarea::make('message')
                            ->label('Pesan / Catatan Tambahan')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('phone')
                    ->label('WhatsApp')
                    ->searchable(),
                TextColumn::make('tourPackage.title')
                    ->label('Paket')
                    ->default(fn ($record) => $record->package_name ?? 'Konsultasi Umum')
                    ->searchable(),
                TextColumn::make('participants')
                    ->label('Peserta')
                    ->suffix(' Orang')
                    ->sortable(),
                TextColumn::make('estimated_price')
                    ->label('Estimasi')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('source')
                    ->label('Sumber')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'contact_page' => 'Form Kontak',
                        'budget_estimator' => 'Kalkulator',
                        default => $state ?? 'Website',
                    })
                    ->color(fn ($state) => match ($state) {
                        'contact_page' => 'info',
                        'budget_estimator' => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'contacted' => 'Dihubungi',
                        'deal' => 'Deal',
                        'cancelled' => 'Batal',
                    ])
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'contacted' => 'Dihubungi',
                        'deal' => 'Deal',
                        'cancelled' => 'Batal',
                    ]),
                SelectFilter::make('source')
                    ->label('Asal Pesan')
                    ->options([
                        'contact_page' => 'Formulir Halaman Kontak',
                        'budget_estimator' => 'Simulasi Budget Estimator',
                    ]),
            ])
            ->actions([
                Action::make('chat_wa')
                    ->label('Chat WA')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->color('success')
                    ->url(function ($record) {
                        $phone = preg_replace('/[^0-9]/', '', $record->phone);
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $msg = rawurlencode("Halo {$record->name}, terima kasih telah menghubungi Nirwana Tour Lampung. Saya admin ingin menindaklanjuti konsultasi wisata Anda.");
                        return "https://wa.me/{$phone}?text={$msg}";
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export_selected')
                        ->label('Ekspor Pilihan ke CSV/Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            return response()->streamDownload(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
                                fputcsv($handle, ['Waktu Masuk', 'Nama', 'WhatsApp', 'Email', 'Paket Terpilih', 'Peserta', 'Armada', 'Estimasi Biaya', 'Status', 'Catatan / Pesan']);
                                foreach ($records as $inquiry) {
                                    fputcsv($handle, [
                                        $inquiry->created_at ? $inquiry->created_at->format('Y-m-d H:i:s') : '-',
                                        $inquiry->name,
                                        $inquiry->phone,
                                        $inquiry->email ?? '-',
                                        $inquiry->tourPackage?->title ?? $inquiry->package_name ?? 'Konsultasi Umum',
                                        $inquiry->participants,
                                        $inquiry->fleet_type ?? '-',
                                        $inquiry->estimated_price ?? 0,
                                        ucfirst($inquiry->status),
                                        $inquiry->message ?? '-',
                                    ]);
                                }
                                fclose($handle);
                            }, 'rekap-leads-terpilih-' . date('Ymd-His') . '.csv', [
                                'Content-Type' => 'text/csv; charset=UTF-8',
                            ]);
                        }),
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
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
