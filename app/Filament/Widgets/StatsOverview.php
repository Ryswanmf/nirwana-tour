<?php

namespace App\Filament\Widgets;

use App\Models\Fleet;
use App\Models\Inquiry;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $packageCount = TourPackage::where('is_active', true)->count();
        $inquiryCount = Inquiry::count();
        $pendingInquiries = Inquiry::where('status', 'pending')->count();
        $fleetCount = Fleet::where('is_active', true)->count();
        $avgRating = Testimonial::where('is_active', true)->avg('rating') ?: 5.0;
        $reviewCount = Testimonial::where('is_active', true)->count();

        return [
            Stat::make('Pesanan Masuk (Leads)', $inquiryCount . ' Permintaan')
                ->description($pendingInquiries > 0 ? "{$pendingInquiries} menunggu dihubungi" : 'Semua lead sudah dihubungi')
                ->descriptionIcon($pendingInquiries > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->chart([3, 6, 5, 9, 12, 10, 15])
                ->color($pendingInquiries > 0 ? 'warning' : 'success'),

            Stat::make('Paket Wisata Aktif', $packageCount . ' Paket')
                ->description('Katalog tour siap dipesan')
                ->descriptionIcon('heroicon-m-map-pin')
                ->chart([2, 3, 4, 4, 6, 6, 7])
                ->color('primary'),

            Stat::make('Kepuasan Wisatawan', number_format($avgRating, 1) . ' / 5.0 ⭐')
                ->description("Berdasarkan {$reviewCount} ulasan diverifikasi")
                ->descriptionIcon('heroicon-m-star')
                ->chart([5, 4, 5, 5, 4, 5, 5])
                ->color('success'),

            Stat::make('Armada Transportasi', $fleetCount . ' Kendaraan')
                ->description('Bus & HiAce siap disewa')
                ->descriptionIcon('heroicon-m-truck')
                ->chart([1, 2, 2, 3, 3, 4, 4])
                ->color('info'),
        ];
    }
}
