<?php

namespace App\Filament\Resources\InquiryResource\Pages;

use App\Filament\Resources\InquiryResource;
use App\Models\Inquiry;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInquiries extends ListRecords
{
    protected static string $resource = InquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_csv')
                ->label('Ekspor Data (CSV)')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return response()->streamDownload(function () {
                        $handle = fopen('php://output', 'w');
                        // Add UTF-8 BOM for Excel
                        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
                        fputcsv($handle, ['Waktu Masuk', 'Nama', 'WhatsApp', 'Email', 'Paket Terpilih', 'Peserta', 'Armada', 'Estimasi Biaya', 'Status', 'Catatan / Pesan']);
                        foreach (Inquiry::with('tourPackage')->latest()->cursor() as $inquiry) {
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
                    }, 'rekap-leads-nirwana-' . date('Ymd-His') . '.csv', [
                        'Content-Type' => 'text/csv; charset=UTF-8',
                    ]);
                }),
            Actions\CreateAction::make(),
        ];
    }
}
