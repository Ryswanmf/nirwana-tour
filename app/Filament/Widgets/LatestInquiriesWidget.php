<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\InquiryResource;
use App\Models\Inquiry;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestInquiriesWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Pesanan & Permintaan Konsultasi Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inquiry::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->since()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Klien / Instansi')
                    ->weight('bold')
                    ->description(fn (Inquiry $record): string => $record->organization ?? 'Wisatawan Umum'),
                TextColumn::make('phone')
                    ->label('Kontak')
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Nomor WhatsApp berhasil disalin!'),
                TextColumn::make('package_name')
                    ->label('Paket / Destinasi')
                    ->default(fn (Inquiry $record) => $record->tourPackage?->title ?? 'Konsultasi Perjalanan')
                    ->limit(35),
                TextColumn::make('participants')
                    ->label('Jumlah')
                    ->suffix(' Pax')
                    ->alignCenter(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'contacted' => 'info',
                        'deal' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Perlu Dihubungi',
                        'contacted' => 'Sudah Dihubungi',
                        'deal' => 'Deal / Sukses',
                        'cancelled' => 'Batal',
                        default => ucfirst($state),
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('whatsapp')
                    ->label('Chat WA')
                    ->icon('heroicon-m-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->button()
                    ->size('xs')
                    ->url(function (Inquiry $record) {
                        $clean = preg_replace('/[^0-9]/', '', $record->phone);
                        if (str_starts_with($clean, '0')) {
                            $clean = '62' . substr($clean, 1);
                        }
                        $msg = rawurlencode("Halo {$record->name}, salam hangat dari Nirwana Tour Lampung. Terima kasih telah menghubungi kami, kami ingin mengonfirmasi rencana liburan Anda...");
                        return "https://wa.me/{$clean}?text={$msg}";
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('detail')
                    ->label('Buka')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('gray')
                    ->size('xs')
                    ->url(fn (Inquiry $record): string => InquiryResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
